<?php
//if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require("../../controller/recetarioControlador.php");
    $controlador = new ControladorRecetario();
    $idproducto     =  $_POST['id'];
    //echo $idproducto;
    $resultados = $controlador->sp_receta($idproducto);
    while($registros = pg_fetch_assoc($resultados)){
		$list[] = $registros;
    }
    echo json_encode($list);
//}
