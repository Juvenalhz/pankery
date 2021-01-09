<?php
if (isset($_REQUEST["Producto"]) && !empty($_REQUEST["Producto"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();

	$producto =  (str_replace(' ', '',$_REQUEST["Producto"]));
	$fechacompra =  (str_replace(' ', '',$_REQUEST["fechacompra"]));
	$Cantidad =  (str_replace(' ', '',$_REQUEST["Cantidad"]));
	$Precio =  (str_replace(' ', '',$_REQUEST["Precio"]));
	$Peso =  (str_replace(' ', '',$_REQUEST["Peso"]));
	$Numcompra =  (str_replace(' ', '',$_REQUEST["Numcompra"]));
	$resultados=$controlador->sp_nuevoGastoMP($producto,$fechacompra,$Cantidad,$Precio,$Peso,$Numcompra);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevogastomp'];

}


?>
