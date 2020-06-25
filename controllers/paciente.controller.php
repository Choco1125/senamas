<?php
 class PacienteController extends BaseController{
    public function __construct(){
        parent::__construct('paciente');
        
    }

    public function index(){
        if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
            $this->go_to_home();
        }
        $obj_paciente =  new Paciente();
        $all_pacientes = $obj_paciente->get_all();
        $active = 'paciente';
        $current_view = 'pacientes/index.php';
        require_once 'views/layout/admin_layout.php';

    }

    public function crear(){
        if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
            $this->go_to_home();
        }
        $active = 'paciente';
        $current_view = 'pacientes/crear.php';
        require_once 'views/layout/admin_layout.php';
    }

    public function editar(){
        if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin','paciente'])){
            $this->go_to_home();
        }
        $documento = isset($_GET['paciente'])?$_GET['paciente']:'';
       
        if($_SESSION['rol'] == 'paciente'){
            if($documento != $_SESSION['id']){
                $this->go_to_home();
            }
        }
        if(!empty($documento)){
            $obj_paciente = new Paciente();
            $obj_paciente->set_documento($documento);

            $obj_paciente->find_data();
            $active = 'paciente';
            $current_view = 'pacientes/editar.php';
            require_once 'views/layout/admin_layout.php';
        }else{
            header('location:index.php?controller=paciente');
        }
    }

    public function create(){
        if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
            $this->go_to_home();
        }
        if(isset($_POST)){

            $documento = trim($_POST['documento']);
            $nombre = trim($_POST['nombre']);
            $direccion = trim($_POST['direccion']);
            $telefono = trim($_POST['telefono']);
            $fecha_naciemiento = trim($_POST['fecha_naciemiento']);
            $estado = trim($_POST['estado']);
            $genero = trim($_POST['genero']);
            $eps = trim($_POST['eps']);
            $email = trim($_POST['email']);
            $password = trim($_POST['documento']);

            $errores = [];

            if(!$this->is_valid_number($documento)){
                array_push($errores,['input' => 'documento']);
            }

            if(!$this->is_valid_number($telefono)){
                array_push($errores,['input' => 'telefono']);
            }
            if(!$this->is_valid_email($email)){
                array_push($errores,['input' => 'email']);
            }

            if(count($errores) == 0){
                $obj_paciente = new Paciente($documento,ucwords($nombre),$direccion,$telefono,$fecha_naciemiento,$estado,$genero,$eps,$email,password_hash($password,PASSWORD_DEFAULT));
                $respuesta = $obj_paciente->save();

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
    
    public function borrar(){
        if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
            $this->go_to_home();
        }
        $id = isset($_POST['documento'])?$_POST['documento']:'';
        if(!empty($id)){
            $obj_paciente = new Paciente();
            $obj_paciente->set_documento($id);
            
            $res = $obj_paciente->delete();

            if(count($res) == 0){
                $this->res(200,'Usuario eliminado.');
            }else{
                $this->res(500,'Error al intentar eliminar paciente, por favor intentalo más tarde.');
            }
            
        }else{
            $this->res(400,'No se seleccionó un usuario válido');
        }

    }
    
    public function update(){
        if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin','paciente'])){
            $this->go_to_home();
        }
        $documento_old = isset($_POST['documento_old'])?$_POST['documento_old']:'';

        if(!empty($documento_old)){
            $documento = trim($_POST['documento']);
            $nombre = trim($_POST['nombre']);
            $direccion = trim($_POST['direccion']);
            $telefono = trim($_POST['telefono']);
            $fecha_naciemiento = trim($_POST['fecha_naciemiento']);
            $estado = trim($_POST['estado']);
            $genero = trim($_POST['genero']);
            $eps = trim($_POST['eps']);
            $email = trim($_POST['email']);
            $password = trim($_POST['documento']);


            $errores = [];

            if(!$this->is_valid_number($documento)){
                array_push($errores,['input' => 'documento']);
            }

            if(!$this->is_valid_number($telefono)){
                array_push($errores,['input' => 'telefono']);
            }
            if(!$this->is_valid_email($email)){
                array_push($errores,['input' => 'email']);
            }

            if(count($errores) == 0){
                $obj_paciente = new Paciente($documento,ucwords($nombre),$direccion,$telefono,$fecha_naciemiento,$estado,$genero,$eps,$email,$password);
                $respuesta = $obj_paciente->update($documento_old);

                if(count($respuesta)==0){
                    $this->res(200,['paciente'=>$obj_paciente]);
                }else{
                    $this->res(500,$respuesta);
                }
            }else{
                $this->res(400,$errores);
            }
        }else{
            $this->res(404,'La información ingresada es errónea.');
        }
    }
 }