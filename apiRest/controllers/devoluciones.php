<?php
ini_set("display_errors" , 1);
ini_set("display_startup_errors" , 1);

error_reporting(E_ALL); 

header('Content-Type: application/json');
require_once("../config/Conectar.php");
require_once("../models/Devoluciones.php");

$empleado = new Devoluciones();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $empleado -> get_devolucion();
        echo json_encode($datos); 
        break;
    /* case 'GetId':
        $datos = $empleado->get_id_devoluciones($body['id']);
        echo json_encode($datos);
        break; */
    case 'insert':
        $datos = $empleado->insert_devolucion(
            $body['id_cliente'], 
            $body['id_empleado'], 
            $body['objeto_devolver'], 
            $body['cantidad_devuelta'], 
            $body['dia_devolucion'], 
            $body['hora_devolucion']);
        echo json_encode("Insertado correctamente");
        break;
    default:
        echo "No entra";
        break;
}

?>