<?php
if (isset($_REQUEST["materiaprimamodif"]) && !empty($_REQUEST["materiaprimamodif"])) {
	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();

	$materiaprimamodif =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["materiaprimamodif"]) ));
	$id =  $_REQUEST["idmateriaprima"];
	$resultados=$controlador->sp_modificarArticulo($materiaprimamodif, $id);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_modificararticulo'];

}


?>
