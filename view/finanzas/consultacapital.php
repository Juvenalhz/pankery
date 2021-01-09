<?php 
	include_once("../../controller/finanzasControlador.php");
	$controlador =new ControladorFinanzas();
    $resultados=$controlador->sp_consultafinanza();
    $data = pg_fetch_assoc($resultados);
    ?>