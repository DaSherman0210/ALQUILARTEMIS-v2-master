<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$url = "http://localhost/SkylAb-142/ALQUILARTEMIS-v2-master/apiRest/controllers/empleados.php?op=GetAll";
// Curl es como el fetch() en Javascript (para consumir APIs)
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl)); 

?>

<?php include ("new.php"); ?>

<div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>UBICACIÓN</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th>ACTUALIZAR</th>
                    <th>BORRAR</th>
                  </tr>
                  </thead>
                  <tbody>
          <?php 
            foreach($output as $out)
            { 
          ?>
        <tr>
        <td><?php echo $out -> id_empleado; ?></td>
        <td><?php echo $out -> nombre; ?></td>
        <td><?php echo $out -> direccion; ?></td>
        <td><?php echo $out -> telefono; ?></td>
        <td><?php echo $out -> email; ?></td>
        <td>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2_<?php echo $out->id_empleado; ?>">UPDATE</button>
        </td>
        <td><a href="http://localhost/ALQUILARTEMIS-v2-master/apiRest/controllers/empleados.php?op=delete&id_empleado=<?php echo $out -> id_empleado; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">DELETE</a></td>
        </tr>
                <!-- Modal for Update -->
                <div class="modal fade" id="exampleModal2_<?php echo $out->id_empleado; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Employee <?php echo $out -> id_empleado; ?></h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <form action="http://localhost/ALQUILARTEMIS-v2-master/apiRest/controllers/empleados.php?op=update&id_empleado=<?php echo $out->id_empleado; ?>" method="post">
                                    <div class="mb-4 row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $out->nombre; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $out->direccion; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $out->telefono; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $out->email; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <input type="submit" class="btn btn-primary" name="actualizar" value="Actualizar">
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
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
      
