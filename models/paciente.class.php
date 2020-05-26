<?php   
    class Paciente extends BaseModel{
        private $documento;
        private $nombre;
        private $direccion;
        private $telefono;
        private $fecha_naciemiento;
        private $estado;
        private $genero;
        private $eps;
        private $email;
        private $password;
        
        public function __construct(
            $documento = null,$nombre = null,$direccion = null,
            $telefono = null,$fecha_naciemiento = null,
            $estado = null,$genero = null,$eps = null,
            $email = null,$password = null
        ){
            $this->table = "paciente";
            $this->documento = $documento;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->fecha_naciemiento = $fecha_naciemiento;
            $this->estado = $estado;
            $this->genero = $genero;
            $this->eps = $eps;
            $this->email = $email;
            $this->password = $password;
            parent::__construct();  
        }

        public function get_documento(){
            return $this->documento;
        }

        public function set_documento($documento){
            $this->documento = $documento;
        }

        public function get_nombre(){
            return $this->nombre;
        }

        public function set_nombre($nombre){
            $this->nombre = $nombre;
        }

        public function get_direccion(){
            return $this->direccion;
        }

        public function set_direccion($direccion){
            $this->direccion = $direccion;
        }

        public function get_telefono(){
            return $this->telefono;
        }

        public function set_telefono($telefono){
            $this->telefono = $telefono;
        }

        public function get_fecha_naciemiento(){
            return $this->fecha_naciemiento;
        }

        public function set_fecha_naciemiento($fecha_naciemiento){
            $this->fecha_naciemiento = $fecha_naciemiento;
        }

        public function get_estado(){
            return $this->estado;
        }

        public function set_estado($estado){
            $this->estado = $estado;
        }

        public function get_genero(){
            return $this->genero;
        }

        public function set_genero($genero){
            $this->genero = $genero;
        }

        public function get_eps(){
            return $this->eps;
        }

        public function set_eps($eps){
            $this->eps = $eps;
        }

        public function get_email(){
            return $this->email;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function get_password(){
            return $this->password;
        }

        public function set_password($password){
            $this->password = $password;
        }


        public function save(){
            try{
                $consulta = "INSERT INTO paciente 
                            (documento,nombre,direccion,telefono,fecha_naciemiento,
                             estado,genero,eps,email,password)
                            VALUES (:documento,:nombre,:direccion,:telefono,:fecha_naciemiento,
                             :estado,:genero,:eps,:email,:password)";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':documento' => $this->documento,
                    ':nombre' => $this->nombre,
                    ':direccion' => $this->direccion,
                    ':telefono' => $this->telefono,
                    ':fecha_naciemiento' => $this->fecha_naciemiento,
                    ':estado' => $this->estado,
                    ':genero' => $this->genero,
                    ':eps' => $this->eps,
                    ':email' => $this->email,
                    ':password' => $this->password
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function delete(){
            try {
                $consulta = "DELETE FROM paciente WHERE documento = :documento";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':documento' => $this->get_documento()
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function find_data(){
            try{
                $consulta = "SELECT * FROM paciente WHERE documento = :documento LIMIT 1";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':documento' => $this->documento,
                ]);


                while($row  = $sql->fetch(PDO::FETCH_OBJ)){
                    $this->set_nombre($row->nombre);
                    $this->set_direccion($row->direccion);
                    $this->set_telefono($row->telefono);
                    $this->set_fecha_naciemiento($row->fecha_naciemiento);
                    $this->set_estado($row->estado);
                    $this->set_genero($row->genero);
                    $this->set_eps($row->eps);
                    $this->set_email($row->email);
                }
                
            }catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }

        public function update($documento_old){
            try{
                $consulta = "UPDATE paciente 
                             SET documento = :documento,
                             nombre = :nombre,
                             direccion = :direccion,
                             telefono = :telefono,
                             fecha_naciemiento = :fecha_naciemiento,
                             estado = :estado,
                             genero = :genero, 
                             eps = :eps,
                             email = :email
                             WHERE documento = :documento_old
                            ";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':documento' => $this->documento,
                    ':nombre' => $this->nombre,
                    ':direccion' => $this->direccion,
                    ':telefono' => $this->telefono,
                    ':fecha_naciemiento' => $this->fecha_naciemiento,
                    ':estado' => $this->estado,
                    ':genero' => $this->genero,
                    ':eps' => $this->eps,
                    ':email' => $this->email,
                    ':documento_old' => $documento_old
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }
    }