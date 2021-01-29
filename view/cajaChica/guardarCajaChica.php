<?php
if (isset($_REQUEST["MontoIngreso"]) && !empty($_REQUEST["MontoIngreso"])) {
	require("../../controller/cajaChicaControlador.php");
	$controlador =new ControladorCajaChica();



	$MontoIngreso = $_REQUEST["MontoIngreso"];
	$resultados=$controlador->sp_GuardarCajaChica($MontoIngreso);

	echo 1;

}


?>