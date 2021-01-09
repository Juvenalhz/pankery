<?php

require("../../controller/recetarioControlador.php");
$controlador = new ControladorRecetario();
$idproducto     =  $_POST['id'];

	$resultados=$controlador->sp_consultaReceta($idproducto);
	while($registros = pg_fetch_assoc($resultados)){
		$list[] = $registros;
	}
	if ($list == null) {
		echo 0;
	}else{

		echo json_encode($list);
	}
