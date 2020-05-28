<?php
    require_once 'config/global.php';
    require_once 'core/base.controller.php';

    $controller = isset($_GET['controller'])?$_GET['controller']:'';
    $action = isset($_GET['action'])?$_GET['action']:'';

    switch(strtolower($controller)){
        case 'paciente':
            $controlador = 'paciente';
            break;
        case 'doctor':
            $controlador = 'doctor';
            break;
        case 'especialidad':
            $controlador = 'especialidad';
            break;
        case 'cita':
            $controlador = 'cita';
            break;
        default:
            $controlador = CONTROLLADOR_DEFECTO;
            break;
    }

    $srtFileController = 'controllers/'.$controlador.'.controller.php';

    if(is_file($srtFileController)){
        require_once $srtFileController;
        $controlador = ucfirst($controlador).'Controller';
        $controllerObj = new $controlador();
        
        if(empty($action)){
            $action = ACCION_DEFECTO;
        }

        if(method_exists($controllerObj,$action)){
            $controllerObj->$action();
        }else{
            echo 'No existe el método';
        }
    }