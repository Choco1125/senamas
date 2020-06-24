<?php
    class LoginController extends BaseController{
        public function __construct(){
            parent::__construct('login');
        }

        public function index(){
            if($this->is_login()){
                header('location: '.URL.'?controller=cita');
            }
            require 'views/login/index.php';
        }

        public function validate_login()
        {
            $email = trim($_POST['email']);
            $contrasena = trim($_POST['contrasena']);

            $errores = [];

            if(!$this->is_valid_email($email)){
                array_push($errores,['input'=>'correo']);
            }

            if(count($errores) > 0){
                $this->res(400,$errores);
            }else{
                $login = new Login($email,$contrasena);
                $id = $login->is_paciente();
                if (is_null($id)) {
                    $id = $login->is_doctor();
                    if(is_null($id)){
                        $id = $login->is_admin();
                        if(is_null($id)){
                            $this->res(404,['Usuario no encontrado']);
                        }else{
                            $this->validate_data($contrasena,$login,$id);
                        }
                    }else{
                        $this->validate_data($contrasena,$login,$id);
                    }
                }else{
                    $this->validate_data($contrasena,$login,$id);
                }
            }
        }

        public function is_same_password($contrasena,$password)
        {
            return $contrasena === $password;
        }

        public function validate_data($contrasena,$login,$id)
        {
            if($this->is_same_password($contrasena,$login->get_password())){
                $_SESSION['rol'] = $login->get_rol();
                $_SESSION['id'] = $id;
                $this->res(200,[]);

            }else{
                $this->res(406,['input'=>'contrasena']);
            }
        }

        public function log_out()
        {
            unset($_SESSION['rol'], $_SESSION['id']);
            header('location: '.URL);
        }

    }