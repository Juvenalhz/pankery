<?php
if (isset($_REQUEST["ModifProducto"]) && !empty($_REQUEST["ModifProducto"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();

	$producto =  (str_replace(' ', '',$_REQUEST["ModifProducto"]));
	$fechacompra =  (str_replace(' ', '',$_REQUEST["modiffechacompra"]));
	$Cantidad =  (str_replace(' ', '',$_REQUEST["modifCantidad"]));
	$Precio =  (str_replace(' ', '',$_REQUEST["modifPrecio"]));
	$Peso =  (str_replace(' ', '',$_REQUEST["modifPeso"]));
	$Numcompra =  (str_replace(' ', '',$_REQUEST["modifcompra"]));
	$idcompra =  (str_replace(' ', '',$_REQUEST["idcompra"]));
	$resultados=$controlador->sp_nuevoModifGastoMP($producto,$fechacompra,$Cantidad,$Precio,$Peso,$Numcompra,$idcompra);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevomodifgastomp'];

}


?>
