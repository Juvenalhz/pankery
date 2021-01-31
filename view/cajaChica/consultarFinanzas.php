<?php

	require("../../controller/cajaChicaControlador.php");
	$controlador =new ControladorCajaChica();
	$resultados=$controlador->sp_consultafinanza();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf[] = $registros;
	}
	
	
		echo json_encode($Conf);

?>
