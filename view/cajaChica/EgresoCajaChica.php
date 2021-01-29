<?php

if (isset($_REQUEST["egreso"]) && !empty($_REQUEST["egreso"])) {
	require("../../controller/cajaChicaControlador.php");
	$controlador =new ControladorCajaChica();



	$egreso = $_REQUEST["egreso"];
	$resultados=$controlador->sp_EgresoCajaChica($egreso);

	echo 1;
}


?>