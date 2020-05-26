<?php
    class EspecialidadController extends BaseController{
        public function __construct(){
            parent::__construct('especialidad');
        }

        public function index(){
            $especialiad = new Especialidad();
            $especialiadades = $especialiad->get_all();

            $active = 'especialidad';
            $current_view = 'especialidad/index.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function crear(){
            $active = 'especialidad';
            $current_view = 'especialidad/crear.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function editar(){
            $active = 'especialidad';
            $current_view = 'especialidad/editar.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function new(){

            if(isset($_POST)){

                $codigo = trim($_POST['codigo']);
                $nombre = trim($_POST['nombre']);
                $descripcion = trim($_POST['descripcion']);

    
                $errores = [];
    
                if(!$this->is_valid_number($codigo)){
                    array_push($errores,['input' => 'codigo']);
                }
    
                if(count($errores) == 0){
                
                    $especialiad = new Especialidad($codigo,$nombre,$descripcion);
                    $respuesta = $especialiad->crear();

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
            $codigo = isset($_POST['codigo'])?$_POST['codigo']:'';
            if(!empty($codigo)){
                $especialiad = new Especialidad();
                $especialiad->set_codigo($codigo);
                
                $res = $especialiad->eliminar();

                if(count($res) == 0){
                    $this->res(200,'Especialiadad eliminada.');
                }else{
                    $this->res(500,'Error al intentar eliminar la especialidad, por favor intentalo más tarde.');
                }
                
            }else{
                $this->res(400,'No se seleccionó una especialidad válida');
            }
        }
    }