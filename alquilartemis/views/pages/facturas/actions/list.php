<!-- /.card -->
<?php
// Obtener datos de la tabla facturas
$url = "http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/facturas.php?op=GetAll";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl));
/* echo "<pre>";
print_r($output); 
echo "</pre>"; */
// Obtener datos de los clientes
$clientes = array();
$urlClientes = "http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/clientes.php?op=GetAll";
$curlClientes = curl_init();
curl_setopt($curlClientes, CURLOPT_URL, $urlClientes);
curl_setopt($curlClientes, CURLOPT_RETURNTRANSFER, 1);
$outputClientes = json_decode(curl_exec($curlClientes));
curl_close($curlClientes);
foreach ($outputClientes as $index => $cliente) {
  $clientes[$cliente->id_cliente] = $cliente->nombre;
}

// Obtener datos de los empleados
$empleados = array();
$urlEmpleados = "http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/empleados.php?op=GetAll";
$curlEmpleados = curl_init();
curl_setopt($curlEmpleados, CURLOPT_URL, $urlEmpleados);
curl_setopt($curlEmpleados, CURLOPT_RETURNTRANSFER, 1);
$outputEmpleados = json_decode(curl_exec($curlEmpleados));
curl_close($curlEmpleados);
foreach ($outputEmpleados as $index => $empleado) {
  $empleados[$empleado->id_empleado] = $empleado->nombre;
}
?>


<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID FACTURA</th>
          <th>CLIENTE</th>
          <th>EMPLEADO</th>
          <th>FECHA SALIDA</th>
          <th>SUBTOTAL</th>
          <th>PLACA VEHICULO</th>
          <th>OBSERVACIONES</th>
          <th>DETALLE</th>
          <th>ACTUALIZAR</th>
          <th>BORRAR</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($output as $index => $out) { 

          $clienteNombre = isset($clientes[$out->id_cliente]) ? $clientes[$out->id_cliente] : 'Desconocido';
          $empleadoNombre = isset($empleados[$out->id_empleado]) ? $empleados[$out->id_empleado] : 'Desconocido';

          echo "<pre>";
          print_r($clienteNombre);
          echo "</pre>";


          echo "<pre>";
          print_r($empleadoNombre);
          echo "</pre>";

          echo "----------------";
          
        ?>
        <tr>
          <td><?php echo $out->id_salida; ?></td>
          <td> <?php echo $clienteNombre; ?></td>
          <td> <?php echo $empleadoNombre; ?></td>
          <td><?php echo $out->fecha_salida; ?></td>
          <td><?php echo $out->subtotal_peso; ?></td>
          <td><?php echo $out->placa_transporte; ?></td>
          <td><?php echo $out->observaciones; ?></td>
          <td><button type="button" class="btn btn-info">DETAIL</button></td>
          <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal4_<?php echo $out->id_salida; ?>">UPDATE</button>
          </td>
          <td><a href="http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/facturas.php?op=delete&id_salida=<?php echo $out -> id_salida; ?>" onclick="return confirm('¿Desea eliminar esta factura?')" class="btn btn-danger">DELETE</a></td>
        </tr>
        <!-- Modal for update -->
        <div class="modal fade" id="exampleModal4_<?php echo $out->id_salida; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Bill <?php echo $out -> id_salida; ?></h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
        <form action="http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/facturas.php?op=update&id_salida=<?php echo $out -> id_salida; ?>" method="post">
          <div class="mb-3">
              <label for="id_cliente" class="form-label">Cliente</label>
             <select class="form-select" name="id_cliente" id="id_cliente" aria-label="Default select example">
                <option>Selecciona el cliente</option>
                <?php
                    $conectar = new PDO('mysql:host=localhost;dbname=alquilartemis', 'campus', 'campus2023');
                    $stm = $conectar->prepare("SELECT id_cliente, nombre FROM clientes");
                    $stm->execute();
                    $clientes = $stm->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($clientes as $index => $cliente) {
                      echo '<option value="'.$cliente['id_cliente'].'">'.$cliente['nombre'].'</option>';
                    }
                  ?>
              </select>
              </div>
              <div class="mb-3">
                <label for="fecha_salida" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $out -> fecha_salida; ?>">
              </div>
              <div class="mb-3">
                <label for="hora_salida" class="form-label">Hora salida</label>
                <input type="time" class="form-control" id="hora_salida" name="hora_salida" value="<?php echo $out -> hora_salida; ?>">
              </div>
              <div class="mb-3">
                <label for="subtotal_peso" class="form-label">Subtotal</label>
                <input type="number" class="form-control" id="subtotal_peso" name="subtotal_peso" value="<?php echo $out -> subtotal_peso; ?>">
              </div>
              <div class="mb-3">
                <label for="placa_transporte" class="form-label">Placa del vehículo que transporta</label>
                <input type="text" class="form-control" id="placa_transporte" name="placa_transporte" value="<?php echo $out -> placa_transporte; ?>">
              </div>
              <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $out -> observaciones; ?>">
              </div>
              <div class="mb-3">
                <label label for="id_empleado" class="form-label">Empleado</label>
                <select class="form-select" name="id_empleado" id="id_empleado" aria-label="Default select example">
                  <option>Seleccione empleado</option>
                  <?php
                    $conectar = new PDO('mysql:host=localhost;dbname=alquilartemis', 'campus', 'campus2023');
                    $stm = $conectar->prepare("SELECT id_empleado, nombre FROM empleados");
                    $stm->execute();
                    $empleados = $stm->fetchAll(PDO::FETCH_ASSOC);
                    foreach($empleados as $index => $empleado){
                      echo '<option value="'.$empleado['id_empleado'].'">'.$empleado['nombre'].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="mb-4 row">
                <input type="submit" class="btn btn-primary" value="Actualizar" name="actualizar">
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php include "new.php"; ?>
</div>
</div>
</div>
