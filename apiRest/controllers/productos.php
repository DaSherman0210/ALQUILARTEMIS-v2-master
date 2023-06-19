<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require_once("../config/Conectar.php");
require_once("../models/Productos.php");

$producto = new Productos();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $producto->get_producto();
        echo json_encode($datos);
        break;
        case 'insert':
            // Verificar si las claves del array existen
            if (isset($body['nombre'], $body['stock_inicial'], $body['cantidad_ingresos'], $body['cantidad_salidas'], $body['fecha_inventario'], $body['tipo_operacion'])) {
                $nombre = $body['nombre'];
                $stock_inicial = $body['stock_inicial'];
                $cantidad_ingresos = $body['cantidad_ingresos'];
                $cantidad_salidas = $body['cantidad_salidas'];
                $fecha_inventario = $body['fecha_inventario'];
                $tipo_operacion = $body['tipo_operacion'];
        
                // Verificar si el producto ya existe en la base de datos
                $existingProducto = $producto->get_producto_by_name($nombre);
        
                if ($existingProducto) {
                    // El producto ya existe, mostrar mensaje de error
                    echo "<script>alert('El producto ya existe y no se permite la actualización. Diríjase a la sección UPDATE al final de la fila del producto que quiere actualizar.');</script>";
                } else {
                    // El producto no existe, insertarlo como nuevo
                    $producto->insert_producto($nombre, $stock_inicial, $cantidad_ingresos, $cantidad_salidas, $fecha_inventario, $tipo_operacion);
                    echo "<script>alert('El producto fue agregado correctamente.'); document.location='producto'</script>";
                }
                header("Location: http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/alquilartemis/producto");
            } else {
                echo "Faltan datos en el formulario.";
            }
            break;    
        case 'delete':
            if(isset($_GET['id_producto'])){
                $id_producto = $_GET['id_producto'];

                // Verificar que el producto existe en la base de datos
                $existingProducto = $producto -> get_producto_by_id($id_producto);

                if($existingProducto){
                    // El producto existe, eliminarlo
                    $producto -> delete_producto($id_producto);
                    echo "<script>alert('El producto fue eliminado correctamente.');</script>";
                    header("Location: http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/alquilartemis/producto");
                }else{
                    // El producto no existe, mostrar mensaje de error
                    echo "<script>alert('El producto no existe.');</script>";
                }
            }
            break;   
        case 'GetIdManual';
            if(isset($_GET['id_producto'])){
                $id_producto = $_GET['id_producto'];
                $datos = $producto -> get_producto_by_id($id_producto);
                echo json_encode($datos);
            }else{
                echo "Error: No se proporcionó el parámetro id_cliente en la URL.";
            }
        break; 
        case 'update':
            if(isset($_GET['id_producto'])){
                $id_producto = $_GET['id_producto'];
                $nombre = $_POST['nombre'];
                $stock_inicial = $_POST['stock_inicial'];
                $cantidad_ingresos = $_POST['cantidad_ingresos'];
                $cantidad_salidas = $_POST['cantidad_salidas'];
                $fecha_inventario = $_POST['fecha_inventario'];
                $tipo_operacion = $_POST['tipo_operacion'];

                // Verificar si el producto existe
                $existingProducto = $producto -> get_producto_by_id($id_producto);
                if($existingProducto){
                    $updated = $producto -> update_producto($id_producto, $nombre, $stock_inicial, $cantidad_ingresos, $cantidad_salidas, $fecha_inventario, $tipo_operacion);
                    if($updated){
                        echo json_encode(array("message" => "Producto actualizado correctamente."));
                        header("Location: http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/alquilartemis/producto");
                    }else{
                        echo json_encode(array("error" => "Error al actualizar cliente."));
                    }
                }else{
                    echo json_encode(array("error" => "El producto con ID $id_producto no existe."));
                }
            }else{
                echo json_encode(array("error" => "No se proporcionó el parámetro id_producto en la solicitud"));
            }
            break;
    default:
        echo "Error";
        break;
}
?>