<?php
if (isset($_REQUEST["nombrerecetaproducto"]) && !empty($_REQUEST["nombrerecetaproducto"])) {
	require("../../controller/recetarioControlador.php");
	$controlador =new ControladorRecetario();

	$nombre =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["nombrerecetaproducto"]) ));
	$id_producto =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["id_producto"]) ));
    $cantidadtanda =  strtoupper(ltrim(str_replace(' ', '',$_REQUEST["cantidadtanda"]) ));

    
    $resultados=$controlador->sp_nuevoProductoDuplicado($nombre,0,$cantidadtanda);
    $ultimoID = pg_fetch_assoc($resultados);

    $id_productoFinal =  $ultimoID['sp_nuevoproductoduplicado'];
    //echo $id_productoFinal;
    if ($id_productoFinal != 0) {
    
        $resultadosreceta=$controlador->sp_consultaReceta($id_producto);
        while($registrosreceta = pg_fetch_assoc($resultadosreceta)){
            $list[] = $registrosreceta;
        }
        
    
        foreach ($list as $receta) {
            $id_mp = $receta['id_mp'];
            $cantidad = $receta['cantidad'];
            $controlador->sp_consultaReceta($id_producto);
            $controlador->sp_duplicarreceta($id_productoFinal,$id_mp,$cantidad);
        }
    
        $resultados2 = $controlador->sp_ActPrecioCosto($id_productoFinal);
    $row = pg_fetch_assoc($resultados2);
    echo $row['sp_actpreciocosto'];
    } else {
        echo 0;
    }


    // $resultados=$controlador->sp_cambiarnombreReceta($nombre,$id_producto);

	// $row = pg_fetch_assoc($resultados);
	// echo $row['sp_cambiarnombrereceta'];
    

}


?>
