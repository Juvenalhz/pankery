<?php

	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();
	$estatus = $_REQUEST['estatus'];
	$resultados=$controlador->sp_consultaPedidos($estatus);
	while($registros = pg_fetch_assoc($resultados)){
		$list["data"][] = $registros;
	}
	
	if (empty($list)) {
		$arreglo["data"] = array(

			"id_pedidos" => "",
			"cliente" => "",
			"descr" => "",
			"cantidad" => "",
			"total" => "",
			"monto" => "",
			"estatus" => ""
		);
		echo json_encode($arreglo);
	} else echo json_encode($list);





?>
