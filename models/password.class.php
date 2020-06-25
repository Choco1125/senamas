<?php   
    class Password extends BaseModel{
        private $documento;
        private $rol;
        private $password;
        
        public function __construct($documento = null,$password = null,$rol=null){
            $this->table = "";
            $this->documento = $documento;
            $this->rol = $rol;
            $this->password = $password;
            parent::__construct();  
        }

        public function get_documento(){
            return $this->documento;
        }

        public function set_documento($documento){
            $this->documento = $documento;
        }

        public function get_rol(){
            return $this->rol;
        }

        public function set_rol($rol){
            $this->rol = $rol;
        }

       
        public function get_password(){
            return $this->password;
        }

        public function set_password($password){
            $this->password = $password;
        }
     

        public function update(){
            try{
                $consulta = "UPDATE ".$this->rol." SET password = :password WHERE documento = :documento";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':documento' => $this->documento,
                    ':password' => $this->password,
                    // ':rol' => $this->rol
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }
    }