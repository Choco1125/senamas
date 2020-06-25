<?php
    class DoctorController extends BaseController{
        public function __construct(){
            parent::__construct('medico');
        }

        public function index(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            $medico = new Medico();
            $medicos = $medico->get_all();
            
            $active = 'doctor';
            $current_view = 'doctor/index.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function crear(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            require 'models/especialidad.class.php';

            $active = 'doctor';
            $current_view = 'doctor/crear.php';
            $especialidad = new Especialidad();
            $especialidades = $especialidad->get_all();
            require_once 'views/layout/admin_layout.php';
        }

        public function editar(){

            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin','medico'])){
                $this->go_to_home();
            }
            $codigo = isset($_GET['medico'])?$_GET['medico']:'';

            if($_SESSION['rol'] == 'medico'){
                if($codigo != $_SESSION['id']){
                    $this->go_to_home();
                }
            }
            if(!empty($codigo)){
                $medico = new Medico();
                $medico->set_codigo($codigo);

                $medico->mis_datos();
                if(!is_null($medico->get_nombre())){
                    require 'models/especialidad.class.php';
                    $especialidad = new Especialidad();
                    $especialidades = $especialidad->get_all();
                    $mis_especialidades = $medico->get_especialidades();
                    $active = 'doctor';
                    $current_view = 'doctor/editar.php';
    
                    require_once 'views/layout/admin_layout.php';
                }else{
                    header('location:index.php?controller=doctor');
                }
            }else{
                header('location:index.php?controller=doctor');
            }
            
        }

        public function new(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            if(isset($_POST)){

                $nombre = trim($_POST['nombre']);
                $documento = trim($_POST['documento']);
                $fecha_naciemiento = trim($_POST['fecha_naciemiento']);
                $genero = trim($_POST['genero']);
                $email = trim($_POST['email']);
                $perfil_profesional = trim($_POST['perfil_profesional']);
                $fecha_ingreso = trim($_POST['fecha_ingreso']);
                $anos_experiencia = trim($_POST['anos_experiencia']);        
                $especialidades = explode(',',$_POST['especialidades']);
                $errores = [];
    
                if(!$this->is_valid_number($documento)){
                    array_push($errores,['input' => 'documento']);
                }
    
                if(!$this->is_valid_number($anos_experiencia)){
                    array_push($errores,['input' => 'anos_experiencia']);
                }
                if(!$this->is_valid_email($email)){
                    array_push($errores,['input' => 'email']);
                }
    
                if(count($errores) == 0){
                
                    $medico = new Medico($documento,ucwords($nombre),$documento,$genero,$email,$perfil_profesional,$fecha_ingreso,$anos_experiencia,$fecha_naciemiento);                   
                    $respuesta = $medico->crear();
                    if(count($respuesta)==0){
                        if(count($especialidades)>0){
                            foreach($especialidades as $especialidad){
                                $medico->set_especialidad($especialidad);
                            }
                        }
                        $this->res(201,[]);
                    }else{
                        $this->res(500,$respuesta);
                    }
                }else{
                    $this->res(400,$errores);
                }
    
            }
        }
        public function delete(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            $id = isset($_POST['documento'])?$_POST['documento']:'';
            if(!empty($id)){
                $medico = new Medico();
                $medico->set_codigo($id);
                
                $res = $medico->eliminar();

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
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin','medico'])){
                $this->go_to_home();
            }
            if(isset($_POST)){

                $codigo = $_POST['codigo'];
                $nombre = trim($_POST['nombre']);
                $documento = trim($_POST['documento']);
                $fecha_naciemiento = trim($_POST['fecha_naciemiento']);
                $genero = trim($_POST['genero']);
                $email = trim($_POST['email']);
                $perfil_profesional = trim($_POST['perfil_profesional']);
                $fecha_ingreso = trim($_POST['fecha_ingreso']);
                $anos_experiencia = trim($_POST['anos_experiencia']);        
                $especialidades = explode(',',$_POST['especialidades']);
                $errores = [];
    
                if(!$this->is_valid_number($documento)){
                    array_push($errores,['input' => 'documento']);
                }
    
                if(!$this->is_valid_number($anos_experiencia)){
                    array_push($errores,['input' => 'anos_experiencia']);
                }
                if(!$this->is_valid_email($email)){
                    array_push($errores,['input' => 'email']);
                }
    
                if(count($errores) == 0){
                
                    $medico = new Medico($codigo,ucwords($nombre),$documento,$genero,$email,$perfil_profesional,$fecha_ingreso,$anos_experiencia,$fecha_naciemiento);
                    $respuesta = $medico->actualizar();
                    
                    if(count($respuesta)==0){
                        $medico->remove_especialidad();
                        if(count($especialidades)>0){
                            foreach($especialidades as $especialidad){
                                $medico->set_especialidad($especialidad);
                            }
                        }
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