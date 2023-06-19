<?php 

ini_set("display_errors" , 1);
ini_set("display_startup_errors" , 1);

error_reporting(E_ALL);

if (isset($_POST['enviar'])) {
    $url = "http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/clientes.php?op=insert";

    $data = array(
        'nombre' => $_POST['nombre'],
        'ubicacion' => $_POST['ubicacion'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);

    echo "<pre>";
    print_r($response);
    print_r($data);
    echo "</pre>";

    echo "<script>alert('Cliente registrado correctamenete.'); document.location='clientes'</script>";
}

?>

    <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nuevo Cliente
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                  <div class="mb-4 row">
                      <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="nombre" name="nombre">
                      </div>
                      </div>
                      <div class="mb-4 row">
                      <label for="ubicacion" class="col-sm-2 col-form-label">Ubicacion</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                      </div>
                      </div>
                      <div class="mb-4 row">
                      <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                      <div class="col-sm-10">
                          <input type="number" class="form-control" id="telefono" name="telefono">
                      </div>
                      </div>
                      <div class="mb-4 row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email">
                      </div>
                      </div>
                      <div class="mb-4 row">
                          <input type="submit" class="btn btn-primary" name="enviar" value="enviar">
                      </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>