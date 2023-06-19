<?php 

 class Devoluciones extends Conectar{
    private $id_devoluciones;
    private $id_cliente;
    private $id_empleado;
    private $objeto_devolver;
    private $cantidad_devuelta;
    private $dia_devolucion;
    private $hora_devolucion;

    public function __construct($id_devoluciones = 0 , $id_cliente = 0 , $id_empleado = 0, $objeto_devolver = "" , $cantidad_devuelta = "" , $dia_devolucion = "" , $hora_devolucion = "") {
        $this->id_devoluciones = $id_devoluciones;
        $this->id_cliente = $id_cliente;
        $this->id_empleado = $id_empleado;
        $this->objeto_devolver = $objeto_devolver;
        $this->cantidad_devuelta = $cantidad_devuelta;
        $this->dia_devolucion = $dia_devolucion;
        $this->hora_devolucion = $hora_devolucion;
    }

    //todo ----------------id_devoluciones----------------

    public function set_id_devoluciones($id_devoluciones){
        $this-> id_devoluciones = $id_devoluciones;
    }

    public function get_id_devoluciones(){
        return $this-> id_devoluciones;
    }

    //todo ----------------objeto_devolver----------------

    public function set_objeto_devolver($objeto_devolver){
        $this-> objeto_devolver = $objeto_devolver;
    }

    public function get_objeto_devolver(){
        return $this-> objeto_devolver;
    }

    //todo ----------------cantidad_devuelta----------------

    public function set_cantidad_devuelta($cantidad_devuelta){
        $this-> cantidad_devuelta = $cantidad_devuelta;
    }

    public function get_cantidad_devuelta(){
        return $this-> cantidad_devuelta;
    }

    //todo ----------------dia_devolucion----------------

    public function set_dia_devolucion($dia_devolucion){
        $this-> dia_devolucion = $dia_devolucion;
    }

    public function get_dia_devolucion(){
        return $this-> dia_devolucion;
    }

    //todo ----------------hora_devolucion----------------

    public function set_hora_devolucion($hora_devolucion){
        $this-> hora_devolucion = $hora_devolucion;
    }

    public function get_hora_devolucion(){
        return $this-> hora_devolucion;
    }
    
    //todo ----------------id_cliente----------------

    public function set_id_cliente($id_cliente){
        $this-> id_cliente = $id_cliente;
    }

    public function get_id_cliente(){
        return $this-> id_cliente;
    }

    //todo ----------------id_empleado----------------

    public function set_id_empleado($id_empleado){
        $this-> id_empleado = $id_empleado;
    }

    public function get_id_empleado(){
        return $this-> id_empleado;
    }

    //todo --------------FUNCIONES ESPECIALES--------------

    public function get_devolucion(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM devoluciones");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_devolucion($id_cliente, $id_empleado , $objeto_devolver , $cantidad_devuelta , $dia_devolucion , $hora_devolucion){
        $conectar = parent:: conexion();
        parent::set_name();
        $stm = $conectar -> prepare("INSERT INTO devoluciones (id_cliente , id_empleado , objeto_devolver , cantidad_devuelta ,dia_devolucion , hora_devolucion) VALUES (?,?,?,?,?,?)");
        $stm ->bindValue(1 , $id_cliente);
        $stm ->bindValue(2 , $id_empleado);
        $stm ->bindValue(3 , $objeto_devolver);
        $stm ->bindValue(4 , $cantidad_devuelta);
        $stm ->bindValue(5 , $dia_devolucion);
        $stm ->bindValue(6 , $hora_devolucion);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    //?-- SELECT POR LLAVES FORANEAS

    public function get_cliente(){
        $conectar = parent:: conexion();
        parent::set_name();
        $stm = $conectar-> prepare("SELECT id_cliente , nombre FROM clientes"); 
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }
}

?>