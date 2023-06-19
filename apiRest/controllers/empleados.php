<?php
header('Content-Type: application/json');
require_once("../config/Conectar.php");
require_once("../models/Empleados.php");

$empleado = new Empleados();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $empleado -> get_empleado();
        echo json_encode($datos); 
        break;
    case 'GetId':
        $datos = $empleado -> get_empleado_by_id($body['id_empleado']);
        echo json_encode($datos);
        break;
        case 'insert':
            $nombre = $body['nombre'];
            $direccion = $body['direccion'];
            $telefono = $body['telefono'];
            $email = $body['email'];
    
            // Verificar si el empleado ya existe
            $existingEmpleado = $empleado -> get_empleado_by_email($email);
            if($existingEmpleado){
                echo "<script>alert('El empleado con el email $email ya está registrado.' document.location='empleados');</script>";
                return;
            }
            $inserted = $empleado -> insert_empleado($nombre, $direccion, $telefono, $email);
            if ($inserted) {
                echo json_decode("Empleado registrado correctamente.");
            }
            else{
                echo json_decode("Error al registrar empleado.");
            }
            break;
        case 'delete':
            if(isset($_GET['id_empleado'])){
                $id_empleado = $_GET['id_empleado'];
                
                // Verificar que el empleado exista
                $existingEmpleado = $empleado -> get_empleado_by_id($id_empleado);

                if($existingEmpleado){
                    $empleado -> delete_empleado($id_empleado);
                    echo "<script>alert('El empleado fue eliminado correctamente.')</script>";
                    header("Location: http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/alquilartemis/empleados");
                }else{
                    echo "<script>alert('El empleado no existe.');document.location='empleados'</script>";
                }
            }
            break;
        case 'update':
            if(isset($_GET['id_empleado'])){
                $id_empleado = $_GET['id_empleado'];
                $nombre = $_POST['nombre'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $email = $_POST['email'];

                // Verificar si el empleado existe
                $existingEmpleado = $empleado -> get_empleado_by_id($id_empleado);
                if($existingEmpleado){
                    $updated = $empleado -> update_empleado($id_empleado, $nombre, $direccion, $telefono, $email);
                    if($updated){
                        echo json_encode(array("message" => "Empleado actualizado correctamente."));
                        header("Location: http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/alquilartemis/empleados");
                    }else{
                        echo json_encode(array("error" => "Error al actualizar empleado"));
                    }
                }else{
                    echo json_encode(array("error" => "El cliente con ID $id_empleado no existe."));
                }
            }else{
                echo json_encode(array("error" => "No se proporcionó el parámetro id_empleado en la solicitud."));
            }
            break;
    default:
        echo "Error";
        break;
}
?>