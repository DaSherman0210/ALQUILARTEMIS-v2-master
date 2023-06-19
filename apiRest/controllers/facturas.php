    <?php
header('Content-Type: application/json');
require_once("../config/Conectar.php");
require_once("../models/Facturas.php");

$salida = new Salida();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $salida -> get_salida();
        echo json_encode($datos); 
        break;
    /* case 'GetId':
        $datos = $salida->get_id_salida($body['id']);
        echo json_encode($datos);
        break; */
    case 'insert':
        $datos = $salida->insert_salida(
            $body['id_cliente'], 
            $body['fecha_salida'], 
            $body['hora_salida'], 
            $body['subtotal_peso'], 
            $body['placa_transporte'], 
            $body['observaciones'],
            $body['id_empleado']);
        echo json_encode("Insertado correctamente");
        break;
        case 'delete':
            if(isset($_GET['id_salida'])){
                $id_salida = $_GET['id_salida'];

                // Verificar que la factura exista en la base de datos
                $existingSalida = $salida -> get_salida_by_id($id_salida);
                
                if( $existingSalida){
                    $salida -> delete_salida($id_salida);
                    echo "<script>alert('La factura fue eliminada correctamente.');</script>";
                    header("Location: http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/alquilartemis/facturas");
                }else{
                    echo "<script>alert('La factura no existe.');</script>";
                }
            }
            break;
        case 'update':
            if(isset($_GET['id_salida'])){
                $id_salida = $_GET['id_salida'];
                $id_cliente = $_POST['id_cliente'];
                $id_empleado = $_POST['id_empleado'];
                $fecha_salida = $_POST['fecha_salida'];
                $hora_salida = $_POST['hora_salida'];
                $subtotal_peso = $_POST['subtotal_peso'];
                $placa_transporte = $_POST['placa_transporte'];
                $observaciones = $_POST['observaciones'];

                // Verificar si la factura existe
                $existingSalida = $salida -> get_salida_by_id($id_salida);
                if($existingSalida){
                    $updated = $salida -> update_salida($id_salida, $id_cliente, $id_empleado, $fecha_salida, $hora_salida, $subtotal_peso, $placa_transporte, $observaciones);
                    if($updated){
                        echo json_encode(array("message" => "Factura actualizada correctamente."));
                        header("Location: http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/alquilartemis/facturas");
                    }else{
                        echo json_encode(array("error" => "Error al actualizar factura."));
                    }
                }else{
                    echo json_encode(array("error" => "La factura con ID $id_salida no existe."));
                }
            }else{
                echo json_encode(array("error" => "No se proporcionó el parámtetro id_salida en la solicitud."));
            }
            break;
    default:
        echo "Error";
        break;
}
?>