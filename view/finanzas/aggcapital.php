<?php
if (isset($_REQUEST["Cantidadagg"]) && !empty($_REQUEST["Cantidadagg"])) {
	require("../../controller/finanzasControlador.php");
	$controlador =new ControladorFinanzas();



	$MontoIngreso = $_REQUEST["Cantidadagg"];
	$resultados=$controlador->sp_aggCapital($MontoIngreso);

	echo 1;

}


?>