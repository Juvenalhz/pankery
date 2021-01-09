<?php

	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();
	$resultados=$controlador->sp_consultaMP();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
