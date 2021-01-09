<?php

	require("../../controller/finanzasControlador.php");
	$controlador =new ControladorFinanzas();
	$resultados=$controlador->sp_consultahistfinanza();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
