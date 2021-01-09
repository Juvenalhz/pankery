<?php
if (isset($_REQUEST["modifnombreEgresoFijo"]) && !empty($_REQUEST["modifnombreEgresoFijo"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();

	$nombreEgresoFijo =  $_REQUEST["modifnombreEgresoFijo"];
	$GastoEF =  (str_replace(' ', '',$_REQUEST["modifGastoEF"]));
	$id_egresofijo =  (str_replace(' ', '',$_REQUEST["id_egresofijo"]));
	$resultados=$controlador->sp_modificarEgresoFijo($nombreEgresoFijo,$GastoEF,$id_egresofijo);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_modificaregresofijo'];

}


?>
