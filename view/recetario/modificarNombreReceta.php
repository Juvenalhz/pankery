<?php

require("../../controller/recetarioControlador.php");
$controlador = new ControladorRecetario();
$idproducto     =  $_POST['id'];

	$resultados=$controlador->sp_consultaproducto($idproducto);
	$list = pg_fetch_assoc($resultados);
	if ($list == null) {
		echo 0;
	}else{

		echo json_encode($list);
	}

    