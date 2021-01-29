<?php

print_r($_REQUEST[]); die();
if (isset($_REQUEST["egresofijo"]) && !empty($_REQUEST["egresofijo"])) {
	require("../../controller/cajaChicaControlador.php");
	$controlador =new ControladorCajaChica();



	$MontoIngreso = $_REQUEST["MontoIngreso"];
	//$resultados=$controlador->sp_GuardarCajaChica($MontoIngreso);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevogastoef'];

}


?>