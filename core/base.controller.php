<?php
    class BaseController{
        public function __construct($model){
            require_once 'connection.php';
            require_once 'base.model.php';
            require_once 'models/'.$model.'.class.php';

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
    }