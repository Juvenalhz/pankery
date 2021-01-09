<?php
if (isset($_REQUEST["egresofijo"]) && !empty($_REQUEST["egresofijo"])) {
	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();

	$egresofijo =  (str_replace(' ', '',$_REQUEST["egresofijo"]));
	$Gasto =  (str_replace(' ', '',$_REQUEST["Gasto"]));
	$Fecha =  (str_replace(' ', '',$_REQUEST["Fecha"]));
	$resultados=$controlador->sp_nuevoGastoEF($egresofijo,$Fecha,$Gasto);

	$row = pg_fetch_assoc($resultados);
	echo $row['sp_nuevogastoef'];

}


?>