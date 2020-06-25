<?php
    class AdminsController extends BaseController{

        public function __construct()
        {
            parent::__construct('admin');
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }   
        }
        
        public function index()
        {
            $admin = new Admin();
            $admins = $admin->get_all();
            $active = 'admins';
            $current_view = 'admins/index.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function crear()
        {
            $active = 'admins';
            $current_view = 'admins/crear.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function storage()
        {
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            if(isset($_POST)){

                $documento = trim($_POST['documento']);
                $email = trim($_POST['email']);
                
                $errores = [];
    
                if(!$this->is_valid_number($documento)){
                    array_push($errores,['input' => 'documento']);
                }
    
                if(!$this->is_valid_email($email)){
                    array_push($errores,['input' => 'email']);
                }
    
                if(count($errores) == 0){
                    $admin = new Admin($documento, $email, password_hash($documento,PASSWORD_DEFAULT));
                    $respuesta = $admin->insert();
                    if(count($respuesta)==0){
                        $this->res(201,[]);
                    }else{
                        $this->res(500,$respuesta);
                    }
                }else{
                    $this->res(400,$errores);
                }
    
            }
        }

        public function delete()
        {
            $documento = isset($_POST['documento'])?$_POST['documento']:'';
            if(!empty($documento)){
                $admin = new Admin();
                $admin->set_documento($documento);                
                $res = $admin->delete();                

                if(count($res) == 0){
                    $this->res(200,'Administrador eliminado.');
                }else{
                    $this->res(500,'Error al intentar eliminar el adminstrador, por favor intentalo más tarde.');
                }
                
            }else{
                $this->res(400,'No se seleccionó un administrador válido');
            }
        }

        public function editar()
        {
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            $documento = isset($_GET['admin'])?$_GET['admin']:'';
            if(!empty($documento)){
                $admin = new Admin();
                $admin->set_documento($documento);
                $test = $admin->mis_datos();
                if(!is_null($admin->get_email())){
                    $active = 'admins';
                    $current_view = 'admins/editar.php';
                    require_once 'views/layout/admin_layout.php';
                }else{
                    header('location:index.php?controller=admins');
                }
                
            }else{
                header('location:index.php?controller=admins');
            }
        }

        public function update()
        {
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            if(isset($_POST['documento_old'])){

                $documento_old = trim($_POST['documento_old']);
                $documento = trim($_POST['documento']);
                $email = trim($_POST['email']);
                
                $errores = [];
    
                if(!$this->is_valid_number($documento)){
                    array_push($errores,['input' => 'documento']);
                }
    
                if(!$this->is_valid_email($email)){
                    array_push($errores,['input' => 'email']);
                }
    
                if(count($errores) == 0){
                    $admin = new Admin($documento, $email);
                    $respuesta = $admin->save($documento_old);
                    if(count($respuesta)==0){
                        $this->res(200,[]);
                    }else{
                        $this->res(500,$respuesta);
                    }
                }else{
                    $this->res(400,$errores);
                }
    
            }   
        }
    }