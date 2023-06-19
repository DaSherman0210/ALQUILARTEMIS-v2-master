<?php
class Conectar{
    protected $db;

    protected function conexion(){ 
        try {
            $conectar = $this->db = new PDO("mysql:host=localhost;dbname=alquilartemis", "campus", "campus2023");
 //Lo primero es el DCN
            return $conectar;
        } catch (Exception $e) {
            return $e->getMessage();
            die();
        }
    }

    public function set_name(){
        return $this -> db -> query("SET NAMES 'utf8'");
    }
}
?>