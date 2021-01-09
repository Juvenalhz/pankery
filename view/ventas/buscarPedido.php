<?php

	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();
	$id = $_POST['id'];
	$resultados=$controlador->sp_busquedaPedido($id);
	while($registros = pg_fetch_assoc($resultados)){
		$list["data"][] = $registros;
	}
	
	echo json_encode($list);





?>