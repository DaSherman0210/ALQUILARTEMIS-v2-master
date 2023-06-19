<?php 

class Salida extends Conectar {
    private $id_salida;
    private $id_cliente;
    private $fecha_salida;
    private $hora_salida;
    private $subtotal_peso;
    private $placa_transporte;
    private $observaciones;
    private $id_empleado;

    public function __construct($id_salida = 0 , $id_cliente = "" , $fecha_salida = "" , $hora_salida = "" , $subtotal_peso = "" , $placa_transporte = "" , $observaciones = "" , $id_empleado = ""){
        $this-> id_salida = $id_salida;
        $this-> id_cliente = $id_cliente;
        $this-> fecha_salida = $fecha_salida;
        $this-> hora_salida = $hora_salida;
        $this-> subtotal_peso = $subtotal_peso;
        $this-> placa_transporte = $placa_transporte;
        $this-> observaciones = $observaciones;
        $this-> id_empleado = $id_empleado;
    }

    //todo ----------------id_salida---------------- 

    function set_id_salida($id_salida){
        $this->id_salida=$id_salida;
    }

    function get_id_salida(){
        return $this -> id_salida;
    }

    //todo ----------------id_cliente---------------- 

    function set_id_cliente($id_cliente){
        $this->id_cliente=$id_cliente;
    }

    function get_id_cliente(){
        return $this -> id_cliente;
    }

    //todo ----------------fecha_salida---------------- 

    function set_fecha_salida($fecha_salida){
        $this->fecha_salida=$fecha_salida;
    }

    function get_fecha_salida(){
        return $this -> fecha_salida;
    }

    //todo ----------------hora_salida---------------- 

    function set_hora_salida($hora_salida){
        $this->hora_salida=$hora_salida;
    }

    function get_hora_salida(){
        return $this -> hora_salida;
    }

    //todo ----------------subtotal_peso---------------- 

    function set_subtotal_peso($subtotal_peso){
        $this->subtotal_peso=$subtotal_peso;
    }

    function get_subtotal_peso(){
        return $this -> subtotal_peso;
    }

    //todo ----------------placa_transporte---------------- 

    function set_placa_transporte($placa_transporte){
        $this->placa_transporte=$placa_transporte;
    }

    function get_placa_transporte(){
        return $this -> placa_transporte;
    }

    //todo ----------------observaciones---------------- 

    function set_observaciones($observaciones){
        $this->observaciones=$observaciones;
    }

    function get_observaciones(){
        return $this -> observaciones;
    }

    //todo ----------------id_empleado---------------- 

    function set_id_empleado($id_empleado){
        $this->id_empleado=$id_empleado;
    }

    function get_id_empleado(){
        return $this -> id_empleado;
    }
    
    //todo --------------FUNCIONES ESPECIALES--------------

    public function get_salida(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM salida");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insert_salida($id_cliente, $fecha_salida , $hora_salida , $subtotal_peso , $placa_transporte , $observaciones , $id_empleado ){
        $conectar = parent:: conexion();
        parent::set_name();
        $stm = $conectar -> prepare("INSERT INTO salida (id_cliente , fecha_salida , hora_salida , subtotal_peso , placa_transporte , observaciones , id_empleado) VALUES (?,?,?,?,?,?,?)");
        $stm ->bindValue(1 , $id_cliente);
        $stm ->bindValue(2 , $fecha_salida);
        $stm ->bindValue(3 , $hora_salida);
        $stm ->bindValue(4 , $subtotal_peso);
        $stm ->bindValue(5 , $placa_transporte);
        $stm ->bindValue(6 , $observaciones);
        $stm ->bindValue(7 , $id_empleado);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_salida_by_id($id_salida){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("SELECT * FROM salida WHERE id_salida = ?");
        $stm -> bindValue(1, $id_salida);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_salida($id_salida){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar -> prepare("DELETE FROM salida WHERE id_salida = ?");
        $stm -> bindValue(1, $id_salida);
        $stm -> execute();
    }

    public function update_salida($id_salida, $id_cliente, $id_empleado, $fecha_salida, $hora_salida, $subtotal_peso, $placa_transporte, $observaciones){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE salida SET id_cliente = :id_cliente, id_empleado = :id_empleado, fecha_salida = :fecha_salida, hora_salida = :hora_salida, subtotal_peso = :subtotal_peso, placa_transporte = :placa_transporte, observaciones = :observaciones WHERE id_salida = :id_salida");
        $stm->bindParam(':id_salida', $id_salida);
        $stm->bindParam(':id_cliente', $id_cliente);
        $stm->bindParam(':id_empleado', $id_empleado);
        $stm->bindParam(':fecha_salida', $fecha_salida);
        $stm->bindParam(':hora_salida', $hora_salida);
        $stm->bindParam(':subtotal_peso', $subtotal_peso);
        $stm->bindParam(':placa_transporte', $placa_transporte);
        $stm->bindParam(':observaciones', $observaciones);
        return $stm->execute();
    }
    
}

?>