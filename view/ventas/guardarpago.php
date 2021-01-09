<?php
if (isset($_REQUEST["pedidoCobranza"]) && !empty($_REQUEST["pedidoCobranza"])) {
	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();
	$deuda = $_POST['Deuda'];
	$pago = $_POST['pago'];
	$id = $_POST['pedidoCobranza'];
	$resultados=$controlador->sp_nuevopago($id,$pago,$deuda);
	$registros = pg_fetch_assoc($resultados);
		
    echo $registros['sp_nuevopago'];



}

?>