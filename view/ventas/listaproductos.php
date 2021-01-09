<?php

	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();
	$resultados=$controlador->sp_consultaProductos();
	while($registros = pg_fetch_assoc($resultados)){
		$list[] = $registros;
	}
	
	echo json_encode($list,JSON_NUMERIC_CHECK);





?>
