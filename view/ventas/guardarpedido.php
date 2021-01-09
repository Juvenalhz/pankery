<?php
if (isset($_REQUEST["Producto"]) && !empty($_REQUEST["Producto"])) {
	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();

	$producto =  (str_replace(' ', '',$_REQUEST["Producto"]));
	$Precio =  (str_replace(' ', '',$_REQUEST["Precio"]));
	$Cantidad =  (str_replace(' ', '',$_REQUEST["Cantidad"]));
	$Costo =  (str_replace(' ', '',$_REQUEST["Costo"]));
	$Pago =  (str_replace(' ', '',$_REQUEST["Pago"]));
	$Cliente =  (str_replace(' ', '',$_REQUEST["Cliente"]));
	$resultados=$controlador->sp_nuevoPedido($producto,$Precio,$Cantidad,$Costo,$Pago,$Cliente);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevopedido'];

}


?>
