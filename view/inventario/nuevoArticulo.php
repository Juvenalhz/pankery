<?php
if (isset($_REQUEST["materiaprima"]) && !empty($_REQUEST["materiaprima"])) {
	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();

	$materiaprima =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["materiaprima"]) ));
	$resultados=$controlador->sp_nuevoArticulo($materiaprima);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevoarticulo'];

}


?>
