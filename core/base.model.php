<?php   
    class BaseModel extends Connection{
        protected $table;

        public function __construct(){
            parent::__construct();
        }

        public function get_all(){
            try {
                $slq = $this->db_connection->query('SELECT * FROM '.$this->table);

                $result_set = null;

                while($row  = $slq->fetch(PDO::FETCH_OBJ)){
                    $result_set[] = $row;
                }
                return $result_set;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                die();
            }
        }
    }