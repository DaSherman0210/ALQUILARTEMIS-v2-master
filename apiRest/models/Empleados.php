<?php
class Empleados extends Conectar{
    private $id_empleado;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
 
    public function __construct($id_empleado=0, $nombre='', $direccion='', $telefono='', $email=''){
        $this->id_empleado = $id_empleado;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    //todo ----------------id_empleado----------------

    function setId_empleado($id_empleado){
        $this->id_empleado=$id_empleado;
    }

    function getId_empleado(){
        return $this->id_empleado;
    }

    //todo ----------------nombre----------------

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getNombre(){
        return $this->nombre;
    }

    //todo ----------------direccion----------------

    function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    function getDireccion(){
        return $this->direccion;
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

    public function get_empleado(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM empleados");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_empleado($nombre, $direccion , $telefono , $email){
        $conectar = parent:: conexion();
        parent::set_name();
        $stm = $conectar -> prepare("INSERT INTO empleados (nombre , direccion , telefono , email) VALUES (?,?,?,?)");
        $stm ->bindValue(1 , $nombre);
        $stm ->bindValue(2 , $direccion);
        $stm ->bindValue(3 , $telefono);
        $stm ->bindValue(4 , $email);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_empleado_by_email($email){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("SELECT * FROM empleados WHERE email = :email");
        $stm -> bindParam(':email', $email);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_empleado_by_id($id_empleado){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("SELECT * FROM empleados WHERE id_empleado = ?");
        $stm -> bindValue(1, $id_empleado);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_empleado($id_empleado){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("DELETE FROM empleados WHERE id_empleado = ?");
        $stm -> bindValue(1, $id_empleado);
        return $stm -> execute();
    }

    public function update_empleado($id_empleado, $nombre, $direccion, $telefono, $email){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("UPDATE empleados SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id_empleado = :id_empleado");
        $stm -> bindParam(':id_empleado', $id_empleado);
        $stm -> bindParam(':nombre', $nombre);
        $stm -> bindParam(':direccion', $direccion);
        $stm -> bindParam(':telefono', $telefono);
        $stm -> bindParam(':email', $email);
        return $stm -> execute();
    }
}
?>