<?php

	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();
	$resultados=$controlador->sp_consultaMP();
	while($registros = pg_fetch_assoc($resultados)){
		$list[] = $registros;
	}
	
	echo json_encode($list,JSON_NUMERIC_CHECK);





?>
