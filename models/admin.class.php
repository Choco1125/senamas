<?php
    class Admin extends BaseModel{

        private $documento;
        private $email;
        private $password;

        public function __construct($documento=null,$email=null,$password=null)
        {
            parent::__construct(); 
            $this->table = 'admin';  
            $this->documento = $documento;
            $this->email = $email;
            $this->password = $password;
        }

        public function set_documento($documento)
        {
            $this->documento = $documento;
        }

        public function get_documento()
        {
            return $this->documento;
        }

        public function set_email($email)
        {
            $this->email = $email;
        }

        public function get_email()
        {
            return $this->email;
        }

        public function set_password($password)
        {
            $this->password = $password;
        }

        public function get_password()
        {
            return $this->password;
        }

        public function insert()
        {
            try {
                $consulta = "INSERT INTO admin (documento,email,password) VALUES (:documento,:email,:password)";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    'documento' => $this->documento,
                    'email' => $this->email,
                    'password' => $this->password
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function delete()
        {
            try {
                $consulta = "DELETE FROM admin WHERE documento = :documento";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    'documento' => $this->documento
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function mis_datos()
        {
            try {

                $consulta = "SELECT * FROM admin WHERE documento = :documento";
                $slq = $this->db_connection->prepare($consulta);
                $slq->execute([
                    'documento' => $this->documento
                ]);
                while($row  = $slq->fetch(PDO::FETCH_OBJ)){
                    $this->email = $row->email;
                }
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function save($documento_old)
        {
            try {
                $consulta = "UPDATE admin SET documento = :documento,email = :email WHERE documento = :documento_old";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    'documento' => $this->documento,
                    'email' => $this->email,
                    'documento_old' => $documento_old
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }
    }