<?php
if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();
	$idcompra =  (str_replace(' ', '',$_REQUEST["id"]));
	$resultados=$controlador->sp_consultaGastoModif($idcompra);
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	echo json_encode($Conf);


}


?>
