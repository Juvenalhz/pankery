<?php
// if (isset($_REQUEST["productoRec"]) && !empty($_REQUEST["productoRec"])) {
require("../../controller/recetarioControlador.php");
$controlador = new ControladorRecetario();
$idproducto     =  $_REQUEST['id_producto'];

$controlador->sp_borrarReceta($idproducto);

for ($i = 1; $i <= $_REQUEST['index']; $i++) {
    $mp     = "materiaprimaAct" . $i;
    $cnt    = "CantidadMPAct" . $i;
    if (empty($_REQUEST[$mp]) || empty($_REQUEST[$cnt])) continue; //Si alguna de las variables esta vacia saltar index
    $materiaprima =  $_REQUEST[$mp];
    $cantidad     =  $_REQUEST[$cnt];
    $resultados = $controlador->sp_nuevaReceta($idproducto,$materiaprima, $cantidad, $i);
  //  if ($i != $_REQUEST['index']) continue;
}
$resultados2 = $controlador->sp_ActPrecioCosto($idproducto);
$row = pg_fetch_assoc($resultados2);
echo $row['sp_actpreciocosto'];





	

//}
