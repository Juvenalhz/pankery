<?php
// if (isset($_REQUEST["productoRec"]) && !empty($_REQUEST["productoRec"])) {
require("../../controller/recetarioControlador.php");
$controlador = new ControladorRecetario();
$idproducto     =  $_REQUEST['id_producto'];
for ($i = 1; $i <= $_REQUEST['index']; $i++) {
    $mp     = "materiaprimaAct" . $i;
    $cnt    = "CantidadMPAct" . $i;
    $materiaprima =  $_REQUEST[$mp];
    $cantidad     =  $_REQUEST[$cnt];
    $resultados = $controlador->sp_nuevaReceta($idproducto,$materiaprima, $cantidad);
    if ($i != $_REQUEST['index']) continue;
    $resultados2 = $controlador->sp_ActPrecioCosto($idproducto);
    $row = pg_fetch_assoc($resultados2);
    echo $row['sp_actpreciocosto'];
    
}




	

//}
