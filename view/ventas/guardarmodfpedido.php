<?php
if (isset($_REQUEST["Productomod"]) && !empty($_REQUEST["Productomod"])) {
	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();

	$producto =  (str_replace(' ', '',$_REQUEST["Productomod"]));
	$Precio =  (str_replace(' ', '',$_REQUEST["Preciomod"]));
	$Cantidad =  (str_replace(' ', '',$_REQUEST["Cantidadmod"]));
	$Costo =  (str_replace(' ', '',$_REQUEST["Costomod"]));
	$Pago =  (str_replace(' ', '',$_REQUEST["Pagomod"]));
	$Cliente =  (str_replace(' ', '',$_REQUEST["Clientemod"]));
	$id =  (str_replace(' ', '',$_REQUEST["id_pedido"]));
	$resultados=$controlador->sp_modifPedido($producto,$Precio,$Cantidad,$Costo,$Pago,$Cliente,$id);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_modifpedido'];

}


?>
