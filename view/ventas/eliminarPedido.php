<?php
if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
	require("../../controller/ventasControlador.php");
	$controlador =new ControladorVentas();

	$id =  (str_replace(' ', '',$_REQUEST["id"]));
	$resultados=$controlador->sp_eliminarPedido($id);

	$row = pg_fetch_assoc($resultados);
    echo $row['sp_eliminarPedido'];
    

}


?>
