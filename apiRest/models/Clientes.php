<?php

class Clientes extends Conectar{
    private $id_cliente;
    private $nombre;
    private $ubicacion;
    private $telefono;
    private $email;
 
    public function __construct($id_cliente=0, $nombre='', $ubicacion='', $telefono='', $email=''){
        $this->id_cliente = $id_cliente;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    //todo ----------------id_cliente----------------

    function setId_cliente($id_cliente){
        $this->id_cliente=$id_cliente;
    }

    function getId_cliente(){
        return $this->id_cliente;
    }

    //todo ----------------nombre----------------

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getNombre(){
        return $this->nombre;
    }

    //todo ----------------ubicacion----------------

    function setUbicacion($ubicacion){
        $this->ubicacion = $ubicacion;
    }

    function getUbicaion(){
        return $this->ubicacion;
    }

    //todo ----------------telefono----------------

    function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    function getTelefono(){
        return $this->telefono;
    }

    //todo ----------------email----------------

    function setEmail($email){
        $this->email=$email;
    }

    function getEmail(){
        return $this->email;
    }

    //todo --------------FUNCIONES ESPECIALES--------------

    public function get_cliente(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM clientes");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cliente_id($id_cliente){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM clientes WHERE id_cliente=?");
        $stm -> bindvalue(1,$id_cliente);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /* public function get_id_nombre_cliente($id_cliente){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("SELECT id_cliente, nombre FROM clientes");
        $stm -> execute();
        $clientes = $stm -> fetchAll(PDO::FETCH_ASSOC);
    } */

    public function insert_cliente($nombre, $ubicacion , $telefono, $email){
        $conectar=parent::conexion();
        parent::set_name();
        $stm="INSERT INTO clientes (nombre,ubicacion,telefono,email) VALUES(?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$nombre);
        $stm->bindValue(2,$ubicacion);
        $stm->bindValue(3,$telefono);
        $stm->bindValue(4,$email);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cliente_by_email($email){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("SELECT * FROM clientes WHERE email = :email");
        $stm -> bindParam(':email', $email);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_cliente($id_cliente){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("DELETE FROM clientes WHERE id_cliente = ?");
        $stm -> bindValue(1, $id_cliente);
        return $stm -> execute();
    }

    public function update_cliente($id_cliente, $nombre, $ubicacion, $telefono, $email){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("UPDATE clientes SET nombre = :nombre, ubicacion = :ubicacion, telefono = :telefono, email = :email WHERE id_cliente = :id_cliente");
        $stm -> bindParam(':id_cliente', $id_cliente);
        $stm -> bindParam(':nombre', $nombre);
        $stm -> bindParam(':ubicacion', $ubicacion);
        $stm -> bindParam(':telefono', $telefono);
        $stm -> bindParam(':email', $email);
        return $stm -> execute();
    }
}
?>