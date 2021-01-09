<?php

	require("../../controller/recetarioControlador.php");
	$controlador =new ControladorRecetario();
	$resultados=$controlador->sp_consultaProductos();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
