<?php
    class Medico extends BaseModel{
        private $codigo;
        private $nombre;
        private $documento;
        private $fecha_nacimiento;
        private $genero;
        private $email;
        private $perfil_profesional;
        private $fecha_ingreso;
        private $anos_experiencia;

        public function __construct($codigo=null,$nombre=null,$documento=null,$genero=null,$email=null,$perfil_profesional=null,$fecha_ingreso=null,$anos_experiencia=null,$fecha_nacimiento=null){
            $this->table = 'medico';
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->documento = $documento;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->genero = $genero;
            $this->email = $email;
            $this->perfil_profesional = $perfil_profesional;
            $this->fecha_ingreso = $fecha_ingreso;
            $this->anos_experiencia = $anos_experiencia;
            parent::__construct();
        }
        
        public function set_codigo($codigo){
            $this->codigo = $codigo;
        }
        public function get_codigo(){
            return $this->codigo;
        }
        public function set_nombre($nombre){
            $this->nombre = $nombre;
        }
        public function get_nombre(){
            return $this->nombre;
        }
        public function set_documento($documento){
            $this->documento = $documento;
        }
        public function get_documento(){
            return $this->documento;
        }
        public function set_fecha_nacimiento($fecha_nacimiento){
            $this->fecha_nacimiento = $fecha_nacimiento;
        }
        public function get_fecha_nacimiento(){
            return $this->fecha_nacimiento;
        }
        public function set_genero($genero){
            $this->genero = $genero;
        }
        public function get_genero(){
            return $this->genero;
        }
        public function set_email($email){
            $this->email = $email;
        }
        public function get_email(){
            return $this->email;
        }
        public function set_perfil_profesional($perfil_profesional){
            $this->perfil_profesional = $perfil_profesional;
        }
        public function get_perfil_profesional(){
            return $this->perfil_profesional;
        }
        public function set_fecha_ingreso($fecha_ingreso){
            $this->fecha_ingreso = $fecha_ingreso;
        }
        public function get_fecha_ingreso(){
            return $this->fecha_ingreso;
        }
        public function set_anos_experiencia($anos_experiencia){
            $this->anos_experiencia = $anos_experiencia;
        }
        public function get_anos_experiencia(){
            return $this->anos_experiencia;
        }

        public function crear(){
            try{
                $consulta = "INSERT INTO medico (codigo,nombre,documento,fecha_nacimiento,genero,email,perfil_profesional,fecha_ingreso,anos_experiencia) VALUES (:codigo,:nombre,:documento,:fecha_nacimiento,:genero,:email,:perfil_profesional,:fecha_ingreso,:anos_experiencia)";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codigo' => $this->codigo,
                    ':documento' => $this->documento,
                    ':nombre' => $this->nombre,
                    ':fecha_nacimiento' => $this->fecha_nacimiento,
                    ':genero' => $this->genero,
                    ':email' => $this->email,
                    ':perfil_profesional' => $this->perfil_profesional,
                    ':fecha_ingreso' => $this->fecha_ingreso,
                    ':anos_experiencia' => $this->anos_experiencia
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function eliminar(){
            try {
                $consulta = "DELETE FROM medico WHERE codigo = :codigo";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codigo' => $this->get_codigo()
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function actualizar(){
            try{
                $consulta = "UPDATE medico 
                            SET nombre=:nombre,documento=:documento,fecha_nacimiento=:fecha_nacimiento,genero=:genero,email=:email,perfil_profesional=:perfil_profesional,fecha_ingreso=:fecha_ingreso,anos_experiencia=:anos_experiencia
                            WHERE codigo = :codigo";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codigo' => $this->codigo,
                    ':documento' => $this->documento,
                    ':nombre' => $this->nombre,
                    ':fecha_nacimiento' => $this->fecha_nacimiento,
                    ':genero' => $this->genero,
                    ':email' => $this->email,
                    ':perfil_profesional' => $this->perfil_profesional,
                    ':fecha_ingreso' => $this->fecha_ingreso,
                    ':anos_experiencia' => $this->anos_experiencia
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function mis_datos(){
            try{
                $consulta = "SELECT * FROM medico WHERE codigo = :codigo LIMIT 1";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codigo' => $this->codigo,
                ]);


                while($row  = $sql->fetch(PDO::FETCH_OBJ)){
                    $this->set_nombre($row->nombre);
                    $this->set_documento($row->documento);
                    $this->set_fecha_nacimiento($row->fecha_nacimiento);
                    $this->set_genero($row->genero);
                    $this->set_email($row->email);
                    $this->set_perfil_profesional($row->perfil_profesional);
                    $this->set_fecha_ingreso($row->fecha_ingreso);
                    $this->set_anos_experiencia($row->anos_experiencia);
                }
                
            }catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }

        public function set_especialidad($id){
            try{
                $consulta = "INSERT INTO medico_especialidad (especialidad,medico) VALUES (:especialidad,:medico)";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':medico' => $this->codigo,
                    ':especialidad' => $id
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function get_especialidades(){
            try{
                $consulta = "SELECT medico_especialidad.especialidad, especialidad.nombre FROM medico_especialidad INNER JOIN especialidad ON medico_especialidad.especialidad = especialidad.codigo WHERE medico_especialidad.medico = :medico";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':medico' => $this->codigo
                ]);
                $resulset = [];
                while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                    $resulset[] = $row->especialidad;
                }
                return $resulset;
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function remove_especialidad(){
            try{
                $consulta = "DELETE FROM medico_especialidad WHERE medico = :medico";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':medico' => $this->codigo
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }
        
    }