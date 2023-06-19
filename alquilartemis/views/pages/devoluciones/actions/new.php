<?php 

ini_set("display_errors" , 1);
ini_set("display_startup_errors" , 1);

error_reporting(E_ALL); 

if (isset($_POST['enviar'])) {
    $url = "http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/devoluciones.php?op=insert";

    $data = array(
        'id_cliente' => $_POST['id_cliente'],
        'id_empleado' => $_POST['id_empleado'],
        'objeto_devolver' => $_POST['objeto_devolver'],
        'cantidad_devuelta' => $_POST['cantidad_devuelta'],
        'dia_devolucion' => $_POST['dia_devolucion'],
        'hora_devolucion' => $_POST['hora_devolucion']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);

    echo "<pre>";
    print_r($response);
    print_r($data);
    echo "</pre>";

    echo "<script>alert('Datos Guardados correctamente'); document.location='devoluciones'</script>";
}

?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nueva Devolucion
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Devolucion</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-4 row">
                    <label for="id_cliente" class="col-sm-2 col-form-label col-16">Selecciona Cliente</label>
                    <select class="form-select" aria-label="Disabled select example" name="id_cliente" id="id_cliente">
                        <option selected>Selecciona Cliente</option>
                        <option value="1">cliente1</option>
                        <option value="2">cliente2</option>
                        <option value="3">cliente3</option>
                        <option value="4">cliente4</option>
                    </select>
                    </div>
                    <div class="mb-4 row">
                    <label for="id_empleado" class="col-sm-2 col-form-label col-16">Selecciona Empleado</label>
                    <select class="form-select" aria-label="Disabled select example" name="id_empleado" id="id_empleado">
                        <option selected>Selecciona Cliente</option>
                        <option value="1">empleado1</option>
                        <option value="2">empleado2</option>
                        <option value="3">empleado3</option>
                        <option value="4">empleado4</option>
                    </select>
                    </div>
                    <div class="mb-4 row">
                    <label for="objeto_devolver" class="col-sm-2 col-form-label col-16">Selecciona Objeto</label>
                    <select class="form-select" aria-label="Disabled select example" name="objeto_devolver" id="objeto_devolver">
                        <option selected>Selecciona Cliente</option>
                        <option value="1">objeto1</option>
                        <option value="2">objeto2</option>
                        <option value="3">objeto3</option>
                        <option value="4">objeto4</option>
                    </select>
                    </div>
                  <div class="mb-4 row">
                  <label for="cantidad_devuelta" class="col-sm-2 col-form-label">Cantidad Devuelta</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="cantidad_devuelta" name="cantidad_devuelta">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="dia_devolucion" class="col-sm-2 col-form-label">Dia Devolucion</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dia_devolucion" name="dia_devolucion">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="hora_devolucion" class="col-sm-2 col-form-label">Hora devolucion</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="hora_devolucion" name="hora_devolucion">
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