<?php
if (isset($_REQUEST["montoganancia"]) && !empty($_REQUEST["montoganancia"])) {
	require("../../controller/recetarioControlador.php");
	$controlador =new ControladorRecetario();

	$monto =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["montoganancia"]) ));
	$id_producto =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["id_producto"]) ));
	$resultados=$controlador->sp_cambiarGanancia($monto,$id_producto);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_cambiarganancia'];

}


?>
