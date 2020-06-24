<?php
    class Login extends BaseModel
    {
        private $email;
        private $contrasena;
        private $password;
        private $rol;

        public function __construct($email=null,$contrasena=null)
        {   
            parent::__construct();
            $this->email = $email;
            $this->contrasena = $contrasena;
        }

        public function set_email($email)
        {
            $this->email = $email;
        }

        public function get_email()
        {
            return $this->email;
        }

        public function set_contrasena($contrasena)
        {
            $this->contrasena = $contrasena;
        }

        public function get_contrasena()
        {
            return $this->contrasena;
        }

        public function set_password($password)
        {
            $this->password = $password;
        }

        public function get_password()
        {
            return $this->password;
        }

        public function set_rol($rol)
        {
            $this->rol = $rol;
        }

        public function get_rol()
        {
            return $this->rol;
        }
        
        public function is_paciente()
        {
            try {
                $consulta = "SELECT password, documento FROM paciente WHERE email = :email LIMIT 1";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    'email' => $this->email
                ]);
                
                $id = null;

                while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                    $this->password = $row->password;
                    $id = $row->documento;
                    $this->rol = 'paciente';
                }

                return $id;

            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function is_doctor()
        {
            try {
                $consulta = "SELECT password, documento FROM medico WHERE email = :email LIMIT 1";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    'email' => $this->email
                ]);
                
                $id = null;

                while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                    $this->password = $row->password;
                    $id = $row->documento;
                    $this->rol = 'medico';
                }

                return $id;

            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function is_admin()
        {
            try {
                $consulta = "SELECT password, documento FROM admin WHERE email = :email LIMIT 1";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    'email' => $this->email
                ]);
                
                $id = null;

                while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                    $this->password = $row->password;
                    $id = $row->documento;
                    $this->rol = 'admin';
                }

                return $id;

            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

    }
    