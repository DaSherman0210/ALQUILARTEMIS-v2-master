<?php 

ini_set("display_errors" , 1);
ini_set("display_startup_errors" , 1);

error_reporting(E_ALL);

if (isset($_POST['enviar'])) {
    $url = "http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/apiRest/controllers/empleados.php?op=insert";

    $data = array(
        'nombre' => $_POST['nombre'],
        'direccion' => $_POST['direccion'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec ($ch);
    curl_close($ch);

    echo "<pre>";
    print_r($response);
    echo "</pre>";

    echo "<script>alert('Empleado registrado correctamente.');document.location='empleados'</script>";
}

?>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Nuevo Empleados
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Empleado</h1>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
    <div class="modal-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" >
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-4 row">
                <input type="submit" class="btn btn-primary" name="enviar" value="enviar">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>