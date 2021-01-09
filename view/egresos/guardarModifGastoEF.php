<?php
if (isset($_REQUEST["egresofijomodif"]) && !empty($_REQUEST["egresofijomodif"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();

	$egresofijo =  (str_replace(' ', '',$_REQUEST["egresofijomodif"]));
	$Gasto =  (str_replace(' ', '',$_REQUEST["Gastomodif"]));
	$Fecha =  (str_replace(' ', '',$_REQUEST["Fechamodif"]));
    $idcompra =  (str_replace(' ', '',$_REQUEST["idcompramodif"]));
	$resultados=$controlador->sp_modifGastoEF($egresofijo,$Fecha,$Gasto,$idcompra);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_modifgastoef'];

}


?>