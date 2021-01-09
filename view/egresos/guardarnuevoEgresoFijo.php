<?php
if (isset($_REQUEST["nombreEgresoFijo"]) && !empty($_REQUEST["nombreEgresoFijo"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();

	$nombreEgresoFijo =  $_REQUEST["nombreEgresoFijo"];
	$GastoEF =  (str_replace(' ', '',$_REQUEST["GastoEF"]));
	$resultados=$controlador->sp_nuevoEgresoFijo($nombreEgresoFijo,$GastoEF);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevoegresofijo'];

}


?>
