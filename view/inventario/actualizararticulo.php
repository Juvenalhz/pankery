<?php
if (isset($_REQUEST["materiaprimaAct"]) && !empty($_REQUEST["materiaprimaAct"])) {
	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();

	$materiaprima =  $_REQUEST["materiaprimaAct"];
	$accionCant =  $_REQUEST["accionCant"];
	$CantidadMP = isset($_REQUEST["CantidadMPAct"]) ? $_REQUEST["CantidadMPAct"] : 0 ;
	$resultados=$controlador->sp_actualizarMP($materiaprima,$CantidadMP,$accionCant);
	$resultado=pg_fetch_assoc($resultados);

		echo $resultado['sp_actualizarmp'];

	


}


?>