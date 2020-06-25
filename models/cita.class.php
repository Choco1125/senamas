<?php
    class Cita extends BaseModel{
        private $codCita;
        private $lugar;
        private $consultorio;
        private $doctor;
        private $fecha;
        private $hora;
        private $fecha_registro;
        private $paciente;

        public function __construct($codCita = null,$lugar=null,$consultorio=null,$doctor=null,$fecha=null,$hora=null,$fecha_registro=null,$paciente=null){
            $this->table = 'cita';
            $this->codCita = $codCita;
            $this->lugar = $lugar;
            $this->consultorio = $consultorio;
            $this->doctor = $doctor;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->fecha_registro = $fecha_registro;
            $this->paciente = $paciente;
            parent::__construct();
        }

        public function set_codCita($codCita){
            $this->codCita = $codCita;
        }

        public function get_codCita(){
            return $this->codCita;
        }

        public function set_lugar($lugar){
            $this->lugar = $lugar;
        }

        public function get_lugar(){
            return $this->lugar;
        }

        public function set_consultorio($consultorio){
            $this->consultorio = $consultorio;
        }

        public function get_consultorio(){
            return $this->consultorio;
        }

        public function set_doctor($doctor){
            $this->doctor = $doctor;
        }

        public function get_doctor(){
            return $this->doctor;
        }

        public function set_fecha($fecha){
            $this->fecha = $fecha;
        }

        public function get_fecha(){
            return $this->fecha;
        }

        public function set_hora($hora){
            $this->hora = $hora;
        }

        public function get_hora(){
            return $this->hora;
        }

        public function set_fecha_registro($fecha_registro){
            $this->fecha_registro = $fecha_registro;
        }

        public function get_fecha_registro(){
            return $this->fecha_registro;
        }

        public function set_paciente($paciente){
            $this->paciente = $paciente;
        }

        public function get_paciente(){
            return $this->paciente;
        }

        public function seleccionar_todos(){
            try {
                $slq = $this->db_connection->query("SELECT cita.codCita, cita.lugar,cita.consultorio,medico.nombre AS doctor ,cita.fecha,cita.hora,paciente.nombre AS paciente FROM cita INNER JOIN medico ON cita.doctor = medico.codigo INNER JOIN paciente ON paciente.documento = cita.paciente");

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

        public function crear(){
            try{
                $consulta = "INSERT INTO cita (codCita,lugar,consultorio,doctor,fecha,hora,fecha_registro,paciente) VALUES (:codCita,:lugar,:consultorio,:doctor,:fecha,:hora,:fecha_registro,:paciente)";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codCita' => $this->codCita,
                    ':lugar' => $this->lugar,
                    ':consultorio' => $this->consultorio,
                    ':doctor' => $this->doctor,
                    ':fecha' => $this->fecha,
                    ':hora' => $this->hora,
                    ':fecha_registro' => $this->fecha_registro,
                    ':paciente' => $this->paciente
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function eliminar(){
            try {
                $consulta = "DELETE FROM cita WHERE codCita = :codCita";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':codCita' => $this->codCita
                ]);
                return [];
            } catch (PDOException $ex) {
                return $ex->errorInfo;
            }
        }

        public function mis_datos(){
            try {
                $sql = $this->db_connection->prepare("SELECT * FROM cita WHERE codCita = :codCita");
                $sql->execute([
                    ':codCita' => $this->codCita
                ]);

                while($row  = $sql->fetch(PDO::FETCH_OBJ)){
                    $this->set_lugar($row->lugar);
                    $this->set_consultorio($row->consultorio);
                    $this->set_doctor($row->doctor);
                    $this->set_fecha($row->fecha);
                    $this->set_hora($row->hora);
                    $this->set_fecha_registro($row->fecha_registro);
                    $this->set_paciente($row->paciente);
                }
                return [];
            } catch (PDOException $ex) {
                return [
                    'error' => $ex->getMessage()
                ];
            }
        }

        public function actualizar($codCita){
            try{
                $consulta = "UPDATE cita SET codCita = :codCita,lugar = :lugar,consultorio = :consultorio,doctor = :doctor,fecha = :fecha,hora = :hora,paciente = :paciente WHERE codCita = :id";
                $sql = $this->db_connection->prepare($consulta);
                $sql->execute([
                    ':id' => $codCita,
                    ':codCita' => $this->codCita,
                    ':lugar' => $this->lugar,
                    ':consultorio' => $this->consultorio,
                    ':doctor' => $this->doctor,
                    ':fecha' => $this->fecha,
                    ':hora' => $this->hora,
                    ':paciente' => $this->paciente
                ]);
                return [];
            }catch(PDOException $ex){
                return $ex->errorInfo;
            }
        }

        public function seleccionar_todos_por_paciente(){
            try {
                $slq = $this->db_connection->prepare("SELECT cita.codCita, cita.lugar,cita.consultorio,medico.nombre AS doctor ,cita.fecha,cita.hora,paciente.nombre AS paciente FROM cita INNER JOIN medico ON cita.doctor = medico.codigo INNER JOIN paciente ON paciente.documento = cita.paciente AND cita.paciente = :paciente");
                $slq->execute([
                    'paciente' => $this->paciente
                ]);
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

        public function seleccionar_todos_por_medico($fecha = ""){
            try {
                if(empty($fecha)){
                    $consulta = "SELECT cita.codCita, cita.lugar,cita.consultorio,medico.nombre AS doctor ,cita.fecha,cita.hora,paciente.nombre AS paciente FROM cita INNER JOIN medico ON cita.doctor = medico.codigo INNER JOIN paciente ON paciente.documento = cita.paciente AND cita.doctor = :doctor";
                }else{
                    $consulta = "SELECT cita.codCita, cita.lugar,cita.consultorio,medico.nombre AS doctor ,cita.fecha,cita.hora,paciente.nombre AS paciente FROM cita INNER JOIN medico ON cita.doctor = medico.codigo INNER JOIN paciente ON paciente.documento = cita.paciente AND cita.doctor = :doctor AND cita.fecha = :fecha";
                }   
                $slq = $this->db_connection->prepare($consulta);
                if(!empty($fecha)){
                    $slq->execute([
                        'doctor' => $this->doctor,
                        'fecha' => $fecha
                    ]);
                }else{
                    $slq->execute([
                        'doctor' => $this->doctor
                    ]);
                }
                
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

        public function seleccionar_todos_por_fecha($fecha){
            try {
                $consulta = "SELECT cita.codCita, cita.lugar,cita.consultorio,medico.nombre AS doctor ,cita.fecha,cita.hora,paciente.nombre AS paciente FROM cita INNER JOIN medico ON cita.doctor = medico.codigo INNER JOIN paciente ON paciente.documento = cita.paciente AND cita.fecha = :fecha";
                
                $slq = $this->db_connection->prepare($consulta);
                
                $slq->execute([
                    'fecha' => $fecha
                ]);

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