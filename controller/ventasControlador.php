<?php
include_once("../../model/ventasModelo.php");

		class ControladorVentas{
		
			private $pedidos;
			 
			public function __construct(){
				$this->pedidos= new Ventas();
			}

		
            public function sp_consultaProductos(){
				$resultado=$this->pedidos->sp_consultaProductos();
			    return $resultado;
			
			}

			public function sp_nuevoPedido($producto,$Precio,$Cantidad,$Costo,$Pago,$Cliente){
				$this->pedidos->set("producto",$producto);
				$this->pedidos->set("precio",$Precio);
				$this->pedidos->set("cantidad",$Cantidad);
				$this->pedidos->set("costo",$Costo);
				$this->pedidos->set("pago",$Pago);
				$this->pedidos->set("cliente",$Cliente);
				$resultado=$this->pedidos->sp_nuevoPedido();
			    return $resultado;
			
			}
			public function sp_modifPedido($producto,$Precio,$Cantidad,$Costo,$Pago,$Cliente,$id){
				$this->pedidos->set("producto",$producto);
				$this->pedidos->set("precio",$Precio);
				$this->pedidos->set("cantidad",$Cantidad);
				$this->pedidos->set("costo",$Costo);
				$this->pedidos->set("pago",$Pago);
				$this->pedidos->set("cliente",$Cliente);
				$this->pedidos->set("id",$id);
				$resultado=$this->pedidos->sp_modifPedido();
			    return $resultado;
			
			}
			public function sp_eliminarPedido($id){
				$this->pedidos->set("id",$id);
				$resultado=$this->pedidos->sp_eliminarPedido();
			    return $resultado;
			
			}
			public function sp_cambioEstatusPedido($estatuspedido,$pedido){
				$this->pedidos->set("estatuspedido",$estatuspedido);
				$this->pedidos->set("pedido",$pedido);
				$resultado=$this->pedidos->sp_cambioEstatusPedido();
			    return $resultado;
			
			}
			public function sp_consultaPedidos($estatus){
				$this->pedidos->set("estatus",$estatus);
				$resultado=$this->pedidos->sp_consultaPedidos();
			    return $resultado;
			
			}
			public function sp_busquedaPedido($id){
				$this->pedidos->set("id",$id);
				$resultado=$this->pedidos->sp_busquedaPedido();
			    return $resultado;
			
			}
			public function sp_nuevopago($id,$pago,$deuda){
				$this->pedidos->set("id",$id);
				$this->pedidos->set("pago",$pago);
				$this->pedidos->set("deuda",$deuda);
				$resultado=$this->pedidos->sp_nuevopago();
			    return $resultado;
			
			}
	}
		
?>