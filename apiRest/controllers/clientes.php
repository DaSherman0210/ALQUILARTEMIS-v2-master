<?php
header('Content-Type: application/json');
require_once("../config/Conectar.php");
require_once("../models/Clientes.php");

$ruta = "http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/alquilartemis/clientes";

$cliente = new Clientes();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $cliente->get_cliente();
        echo json_encode($datos);
        break;
    case 'GetId':
        if (isset($_GET['id_cliente'])) {
            $id_cliente = $_GET['id_cliente'];
            $datos = $cliente->get_cliente_id($id_cliente);
            echo json_encode($datos);
        } else {
            echo json_encode(array("error" => "No se encuentra el parámetro id_cliente en la URL."));
        }
        break;
    case 'insert':
        $nombre = $body['nombre'];
        $ubicacion = $body['ubicacion'];
        $telefono = $body['telefono'];
        $email = $body['email'];

        // Verificar si el cliente ya existe
        $existingCliente = $cliente->get_cliente_by_email($email);
        if ($existingCliente) {
            echo json_encode(array("error" => "El cliente con el email $email ya está registrado."));
        } else {
            $inserted = $cliente->insert_cliente($nombre, $ubicacion, $telefono, $email);
            if ($inserted) {
                echo json_encode(array("message" => "Cliente registrado correctamente."));
            } else {
                echo json_encode(array("error" => "Error al registrar cliente."));
            }
        }
        break;
    case 'delete':
        if (isset($_GET['id_cliente'])) {
            $id_cliente = $_GET['id_cliente'];
            // Verificamos que el cliente exista en la base de datos
            $existingCliente = $cliente->get_cliente_id($id_cliente);

            if ($existingCliente) {
                $cliente->delete_cliente($id_cliente);
                echo json_encode(array("message" => "El cliente fue eliminado correctamente."));
                header("Location: http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/alquilartemis/clientes");
            } else {
                echo json_encode(array("error" => "El cliente no existe."));
            }
        } else {
            echo json_encode(array("error" => "No se proporcionó el parámetro id_cliente en la solicitud."));
        }
        break;
        case 'update':
            if (isset($_GET['id_cliente'])) {
                $id_cliente = $_GET['id_cliente'];
                $nombre = $_POST['nombre'];
                $ubicacion = $_POST['ubicacion'];
                $telefono = $_POST['telefono'];
                $email = $_POST['email'];

                // Verificar si el cliente existe
                $existingCliente = $cliente->get_cliente_id($id_cliente);
                if ($existingCliente) {
                    $updated = $cliente->update_cliente($id_cliente, $nombre, $ubicacion, $telefono, $email);
                    if ($updated) {
                        echo json_encode(array("message" => "Cliente actualizado correctamente."));
                        header("Location: http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/alquilartemis/clientes");
                    } else {
                        echo json_encode(array("error" => "Error al actualizar cliente."));
                    }
                } else {
                    echo json_encode(array("error" => "El cliente con ID $id_cliente no existe."));
                }
            } else {
                echo json_encode(array("error" => "No se proporcionó el parámetro id_cliente en la solicitud."));
            }
        break;
    default:
        echo json_encode(array("error" => "Error: Operación no válida."));
        break;
}
?>
