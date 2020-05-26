<?php
    class Especialidad extends BaseModel{
        
        private $codigo;
        private $nombre;
        private $descripcion;
        
        public function __construct($codigo = null,$nombre = null,$descripcion = null){
            $this->table = 'especialidad';
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
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

        public function set_descripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function get_descripcion(){
            return $this->descripcion;
        }

        public function crear(){
            try{
                $consulta = "INSERT INTO especialidad (codigo,nombre,descripcion) VALUES (:codigo,:nombre,:descripcion)";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codigo' => $this->codigo,
                    ':nombre' => $this->nombre,
                    ':descripcion' => $this->descripcion
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function eliminar(){
            try {
                $consulta = "DELETE FROM especialidad WHERE codigo = :codigo";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codigo' => $this->get_codigo()
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }
    }