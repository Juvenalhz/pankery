<?php
if (isset($_REQUEST["nombrerecetaproducto"]) && !empty($_REQUEST["nombrerecetaproducto"])) {
	require("../../controller/recetarioControlador.php");
	$controlador =new ControladorRecetario();

	$nombre =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["nombrerecetaproducto"]) ));
	$id_producto =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["id_producto"]) ));
	$cantidadtanda =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["cantidadtanda"]) ));
    //echo $nombre;
	$resultados=$controlador->sp_cambiarnombreReceta($nombre,$id_producto,$cantidadtanda);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_cambiarnombrereceta'];
    

}


?>
