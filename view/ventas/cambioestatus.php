<?php
if (isset($_REQUEST["estatuspedido"]) && !empty($_REQUEST["estatuspedido"])) {
	$estatuspedido =  (str_replace(' ', '', $_REQUEST["estatuspedido"]));
	$pedido =  (str_replace(' ', '', $_REQUEST["pedido"]));
	if ($_REQUEST["estatusActual"] == 'PENDIENTE') {
		$validacion = false;
		$mpreceta = '';
		require("../../controller/inventarioControlador.php");
		$controladorInventario = new ControladorInventario();
		$resultadosInventario = $controladorInventario->sp_consultaMP();
		while ($registros1 = pg_fetch_assoc($resultadosInventario)) {
			$rowInventario[] = $registros1;
		};
		$rowJson = json_encode($rowInventario);

		require("../../controller/ventasControlador.php");
		$controlador = new ControladorVentas();
		$resultadosPedido = $controlador->sp_busquedaPedido($pedido);
		$registrosPedido = pg_fetch_assoc($resultadosPedido);
		$pedidoJson = json_encode($registrosPedido);

		require("../../controller/recetarioControlador.php");
		$controladorRecetario = new ControladorRecetario();
		$resultadosRecetario = $controladorRecetario->sp_receta($registrosPedido['id_product']);
		while ($registros2 = pg_fetch_assoc($resultadosRecetario)) {
			$receta[] = $registros2;
		};
		$recetaJson = json_encode($receta);



		foreach ($receta as $materiaprima) {

			$clave = array_search($materiaprima['materiaprima'], array_column($rowInventario, 'descp'), true);
			if (intval($rowInventario[$clave]['cant']) < (intval($materiaprima['cantidad']) * intval($registrosPedido['cantidad']))) {
				$validacion = false;
				$mpreceta = $materiaprima['materiaprima'];
				break;
			}
			$validacion = true;
		}

		if ($validacion) {
			foreach ($receta as $materiaprima) {

				$resultadosActualizarInv = $controladorInventario->sp_actualizarMP($materiaprima['idmp'], (intval($materiaprima['cantidad']) * intval($registrosPedido['cantidad'])), 'res');
				$resultado = pg_fetch_assoc($resultadosActualizarInv);
			}

			$resultados = $controlador->sp_cambioEstatusPedido($estatuspedido, $pedido);

			$row = pg_fetch_assoc($resultados);
			echo $row['sp_cambioestatuspedido'];
		} else {
			echo json_encode($mpreceta);
		}
	} else {
		require("../../controller/ventasControlador.php");
		$controlador = new ControladorVentas();
		$resultados = $controlador->sp_cambioEstatusPedido($estatuspedido, $pedido);
		$row = pg_fetch_assoc($resultados);
		echo $row['sp_cambioestatuspedido'];
	};
}
