<?php
    class BaseController{
        public function __construct($model=null){
            require_once 'connection.php';
            require_once 'base.model.php';
            if(!empty($model)){
                require_once 'models/'.$model.'.class.php';
            }

            if(session_status() !== 'PHP_SESSION_ACTIVE'){
				session_start();
			}
        }

        public function is_login()
        {
            return isset($_SESSION['rol']);
        }

        public function is_valid_number($value){
            return is_numeric($value);
        }

        public function is_valid_email($email){
            return preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $email);
        }

        public function res($status,$body){
            $res['status'] = $status;
            $res['body'] = $body;

            echo json_encode($res);
        }

        public function is_valid_rol($rol,$valids)
        {
            return in_array($rol,$valids);
        }

        public function go_to_home()
        {
            header('location: '.URL);
        }
    }