<?php
/* 
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    // URL de la API con el parámetro id_producto
    $url = "http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/apiRest/controllers/productos.php?op=delete&id_producto=" . $id_producto;

    // Realizar la solicitud DELETE utilizando cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($result !== false) {
        // La solicitud fue exitosa
        if ($httpCode === 200) {
            // El producto fue eliminado correctamente
            echo "<script>alert('El producto fue eliminado correctamente.'); window.location.href = 'producto';</script>";
        } else {
            // La API respondió con un estado de error
            echo "<script>alert('Error al eliminar el producto: " . $result . "'); window.location.href = 'producto';</script>";
        }
    } else {
        // Hubo un error en la solicitud cURL
        echo "<script>alert('Error al realizar la solicitud de eliminación.'); window.location.href = 'producto';</script>";
    }

    // Redireccionar al archivo "list.php" después de eliminar el producto
    header("Location: list.php");
    exit();
}
 */
?>
