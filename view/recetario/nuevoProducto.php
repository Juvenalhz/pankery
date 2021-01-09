<?php
if (isset($_REQUEST["productoRec"]) && !empty($_REQUEST["productoRec"])) {
	require("../../controller/recetarioControlador.php");
	$controlador =new ControladorRecetario();

	$producto =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["productoRec"]) ));
	$precio = ltrim(str_replace(' ', '',$_REQUEST["preciouni"]) );
	$resultados=$controlador->sp_nuevoProducto($producto,$precio);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevoproducto'];

}


?>
