<?php
    class EspecialidadController extends BaseController{
        public function __construct(){
            parent::__construct('especialidad');
        }

        public function index(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            $especialiad = new Especialidad();
            $especialiadades = $especialiad->get_all();

            $active = 'especialidad';
            $current_view = 'especialidad/index.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function crear(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            $active = 'especialidad';
            $current_view = 'especialidad/crear.php';
            require_once 'views/layout/admin_layout.php';
        }

        public function editar(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            $codigo = isset($_GET['especialiadad'])?$_GET['especialiadad']:'';
            if(!empty($codigo)){
                $especialiad = new Especialidad();
                $especialiad->set_codigo($codigo);
                $especialiad->mis_datos();
                if(!is_null($especialiad->get_nombre())){
                    $active = 'especialidad';
                    $current_view = 'especialidad/editar.php';
                    require_once 'views/layout/admin_layout.php';
                }else{
                    header('location:index.php?controller=especialidad');
                }
                
            }else{
                header('location:index.php?controller=especialidad');
            }
        }

        public function new(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }

            if(isset($_POST)){

                $codigo = trim($_POST['codigo']);
                $nombre = trim($_POST['nombre']);
                $descripcion = trim($_POST['descripcion']);

    
                $errores = [];
    
                if(!$this->is_valid_number($codigo)){
                    array_push($errores,['input' => 'codigo']);
                }
    
                if(count($errores) == 0){
                
                    $especialiad = new Especialidad($codigo,ucfirst($nombre),ucfirst($descripcion));
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

        public function update(){
            if(!$this->is_login() || !$this->is_valid_rol($_SESSION['rol'],['admin'])){
                $this->go_to_home();
            }
            if(isset($_POST)){

                $id = trim($_POST['id']);
                $codigo = trim($_POST['codigo']);
                $nombre = trim($_POST['nombre']);
                $descripcion = trim($_POST['descripcion']);

    
                $errores = [];
    
                if(!$this->is_valid_number($codigo)){
                    array_push($errores,['input' => 'codigo']);
                }
    
                if(count($errores) == 0){
                
                    $especialiad = new Especialidad($id,ucfirst($nombre),ucfirst($descripcion));
                    $respuesta = $especialiad->actualizar($codigo);

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