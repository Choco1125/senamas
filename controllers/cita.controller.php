<?php
    class CitaController extends BaseController{
        public function __construct(){
            parent::__construct('cita');
            if(!$this->is_login()){
                $this->go_to_home();
            }
        }

        public function index(){
            $cita = new Cita();
            switch ($_SESSION['rol']) {
                case 'admin':
                    $citas = $cita->seleccionar_todos();
                    break;
                case 'medico':
                    $cita->set_doctor($_SESSION['id']);
                    $citas = $cita->seleccionar_todos_por_medico();
                    break;
                case 'paciente':
                    $cita->set_paciente($_SESSION['id']);
                    $citas = $cita->seleccionar_todos_por_paciente();
                    break;
                default:
                    header('location: '.URL.'?controller=login&action=log_out');
                    break;
            }

            $active = 'cita';
            $current_view = 'cita/index.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function crear(){
            $active = 'cita';
            $current_view = 'cita/crear.php';
            require 'models/medico.class.php';
            $medico = new Medico();
            $medicos = $medico->get_all();
            require_once 'views/layout/admin_layout.php';
        }

        public function new(){
            if(isset($_POST)){

                $codigo = trim($_POST['codigo']);
                $lugar = trim($_POST['lugar']);
                $consultorio = trim($_POST['consultorio']);
                $fecha = trim($_POST['fecha']);
                $hora = trim($_POST['hora']);
                $doctor = trim($_POST['doctor']);
                $paciente = trim($_POST['paciente']);
                $errores = [];
    
                if(!$this->is_valid_number($codigo)){
                    array_push($errores,['input' => 'codigo']);
                }
    
                if(!$this->is_valid_number($paciente)){
                    array_push($errores,['input' => 'paciente']);
                }
    
                if(count($errores) == 0){
                    $cita = new Cita($codigo,ucfirst($lugar),$consultorio,$doctor,$fecha,$hora,date('Y-m-d'),$paciente);
                    $respuesta = $cita->crear();
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

        public function delete(){
            $codCita = isset($_POST['codCita'])?$_POST['codCita']:'';
            if(!empty($codCita)){
                $cita = new Cita();
                $cita->set_codCita($codCita);
                
                $res = $cita->eliminar();

                if(count($res) == 0){
                    $this->res(200,'Cita eliminada.');
                }else{
                    $this->res(500,'Error al intentar eliminar cita, por favor intentalo más tarde.');
                }
                
            }else{
                $this->res(400,'No se seleccionó una cita válida');
            }
        }

        public function editar(){
            
            $codigo = isset($_GET['cita'])?$_GET['cita']:'';
            if(!empty($codigo)){
                $cita = new Cita();
                $cita->set_codCita($codigo);
                $cita->mis_datos();
                
                if(!is_null($cita->get_lugar())){
                    $active = 'cita';
                    $current_view = 'cita/editar.php';
                    require 'models/medico.class.php';
                    $medico = new Medico();
                    $medicos = $medico->get_all();
                    require_once 'views/layout/admin_layout.php';
                }else{
                    header('location:index.php?controller=doctor');
                }
            }else{
                header('location:index.php?controller=doctor');
            }
        }

        public function update(){
            if(isset($_POST)){

                $id = $_POST['id'];
                $codigo = trim($_POST['codigo']);
                $lugar = trim($_POST['lugar']);
                $consultorio = trim($_POST['consultorio']);
                $fecha = trim($_POST['fecha']);
                $hora = trim($_POST['hora']);
                $doctor = trim($_POST['doctor']);
                $paciente = trim($_POST['paciente']);
                $errores = [];
    
                if(!$this->is_valid_number($codigo)){
                    array_push($errores,['input' => 'codigo']);
                }
    
                if(!$this->is_valid_number($paciente)){
                    array_push($errores,['input' => 'paciente']);
                }
    
                if(count($errores) == 0){
                    $cita = new Cita($codigo,ucfirst($lugar),$consultorio,$doctor,$fecha,$hora,date('Y-m-d'),$paciente);
                    $respuesta = $cita->actualizar($id);
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