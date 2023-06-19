<title>
    <?php if(!empty($getArray[4])){
    if($getArray[4]  == 'clientes' ||
    $getArray[4] == 'producto' ||
    $getArray[4] == 'empleados' ||
    $getArray[4] == 'clientes'  ||
    $getArray[4] == 'devoluciones' ||
    $getArray[4] == 'facturas'){
        echo strtoupper($getArray[4]);
    }
} ?>

</title>