<?php

	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();
	$estatus = $_REQUEST['estatus'];
	$resultados=$controlador->sp_consultaPedidos($estatus);
	while($registros = pg_fetch_assoc($resultados)){
		$list["data"][] = $registros;
	}
	
	echo json_encode($list);





?>
