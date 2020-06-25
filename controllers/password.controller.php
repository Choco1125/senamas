<?php
 class PasswordController extends BaseController{
    public function __construct(){
        parent::__construct('password');
        
    }

    public function index(){
        if(!$this->is_login()){
            $this->go_to_home();
        }
        $active = 'password';
        $current_view = 'password/index.php';
        require_once 'views/layout/admin_layout.php';

    }

    public function update(){



            $password = $_POST['password'];
            
            $errores = [];

            if(empty($password)){
                array_push($errores,['input' => 'documento']);
            }

            if(count($errores) == 0){
            
                $pass = new Password($_SESSION['id'],password_hash($password,PASSWORD_DEFAULT),$_SESSION['rol']);
                $respuesta = $pass->update();
                
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