<?php
    class CitaController extends BaseController{
        public function __construct(){
            parent::__construct('cita');
        }

        public function index(){
            $cita = new Cita();
            $citas = $cita->seleccionar_todos();
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
    }