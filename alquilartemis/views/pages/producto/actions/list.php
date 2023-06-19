<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$url = "http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/apiRest/controllers/productos.php?op=GetAll";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl));

?>

<?php include("new.php");?>

<div class="card">
    <div class="card-header">
    <!-- /.card-header -->
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>STOCK INICIAL</th>
          <th>CANTIDAD DE INGRESOS</th>
          <th>CANTIDAD DE EGRESOS</th>
          <th>FECHA INVENTARIO</th>
          <th>TIPO DE OPERACIÓN</th>
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
        <td><?php echo $out->id_producto; ?></td>
        <td><?php echo $out->nombre; ?></td>
        <td><?php echo $out->stock_inicial; ?></td>
        <td><?php echo $out->cantidad_ingresos; ?></td>
        <td><?php echo $out->cantidad_salidas; ?></td>
        <td><?php echo $out->fecha_inventario; ?></td>
        <td><?php echo $out->tipo_operacion; ?></td>
        <td>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal3_<?php echo $out->id_producto; ?>">UPDATE</button>
        </td>
        <td><a href="http://localhost/ALQUILARTEMIS-v2-master/apiRest/controllers/productos.php?op=delete&id_producto=<?php echo $out->id_producto; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">DELETE</a></td>
        </tr>
        <!-- Modal for update -->
        <div class="modal fade" id="exampleModal3_<?php echo $out->id_producto; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product <?php echo $out->id_producto; ?></h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/ALQUILARTEMIS-v2-master/apiRest/controllers/productos.php?op=update&id_producto=<?php echo $out -> id_producto; ?>" method="post">
                  <div class="mb-4 row">
                  <label for="nombre" class="col-sm-2 col-form-label">Producto</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $out->nombre; ?>">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="stock_inicial" class="col-sm-2 col-form-label">Stock inicial</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock_inicial" name="stock_inicial" value="<?php echo $out -> stock_inicial; ?>">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="cantidad_ingresos" class="col-sm-2 col-form-label">Cantidad de ingresos</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="cantidad_ingresos" name="cantidad_ingresos" value="<?php echo $out -> cantidad_ingresos; ?>">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="cantidad_salidas" class="col-sm-2 col-form-label">Cantidad de salidas</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="cantidad_salidas" name="cantidad_salidas" value="<?php echo $out -> cantidad_salidas; ?>">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="fecha_inventario" class="col-sm-2 col-form-label">Fecha inventario</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="fecha_inventario" name="fecha_inventario" value="<?php echo $out -> fecha_inventario; ?>">
                    </div>
                  </div>
                  <div class="mb-4 row">
                  <label for="tipo_operacion" class="col-sm-2 col-form-label col-16">Tipo de operacion</label>
                  <select class="form-select" aria-label="Disabled select example" name="tipo_operacion" id="tipo_operacion">
                    <option selected>Selecciona tipo De operacion</option>
                    <option value="Compra">Compra</option>
                    <option value="Salida">Salida</option>
                    <option value="Devolución">Devolucion</option>
                    <option value="Daño">Daño</option>
                  </select>
                  </div>
                  <div class="mb-4 row">
                      <input type="submit" class="btn btn-primary" name="actualizar" value="Actualizar">
                  </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php 
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
