<?php
if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();
	$idegresofijo =  (str_replace(' ', '',$_REQUEST["id"]));
	$resultados=$controlador->sp_consultaEgresosFijosmodif($idegresofijo);
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	echo json_encode($Conf);


}


?>
