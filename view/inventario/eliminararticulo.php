<?php
if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();

	$id =  $_REQUEST["id"];
	$resultados=$controlador->sp_eliminarArticulo($id);

	$row = pg_fetch_assoc($resultados);
    echo $row['sp_eliminararticulo'];
    

}


?>
