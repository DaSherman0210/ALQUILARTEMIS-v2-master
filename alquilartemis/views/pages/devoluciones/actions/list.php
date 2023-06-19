<?php
$url = "http://localhost/SkylAb-108/ALQUILARTEMIS-v2-master/apiRest/controllers/devoluciones.php?op=GetAll";
// Curl es como el fetch() en Javascript (para consumir APIs)
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl));
/* echo "<pre>";
print_r($output);
echo "</pre>"; */

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
          <th>ID CLIENTE</th>
          <th>ID EMPLEADO</th>
          <th>OBJETO DEVUELTO</th>
          <th>CANTIDAD</th>
          <th>DIA DEVUELTO</th>
          <th>HORA</th>
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
        <td><?php echo $out -> id_devoluciones; ?></td>
        <td><?php echo $out -> id_cliente; ?></td>
        <td><?php echo $out -> id_empleado; ?></td>
        <td><?php echo $out -> objeto_devolver; ?></td>
        <td><?php echo $out -> cantidad_devuelta; ?></td>
        <td><?php echo $out -> dia_devolucion; ?></td>
        <td><?php echo $out -> hora_devolucion; ?></td>
        <td><button type="button" class="btn btn-primary">UPDATE</button></td>
        <td><button type="button" class="btn btn-danger">DELETE</button></td>
        </tr>
        <?php 
          }
        ?>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>


<!-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> -->