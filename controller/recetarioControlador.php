<?php
include_once("../../model/recetarioModelo.php");

		class ControladorRecetario{
		
			private $recetario;
			 
			public function __construct(){
				$this->recetario= new Recetario();
			}

			public function sp_nuevoProducto($producto,$precio){
				$this->recetario->set("producto",$producto);
				$this->recetario->set("precio",$precio);
				$resultado=$this->recetario->sp_nuevoProducto();
			    return $resultado;
			
			}
			public function sp_cambiarGanancia($monto,$id_producto){
				$this->recetario->set("monto",$monto);
				$this->recetario->set("id_producto",$id_producto);
				$resultado=$this->recetario->sp_cambiarGanancia();
			    return $resultado;
			
			}
			public function sp_nuevaReceta($idproducto,$materiaprima,$cantidad,$indexmp){
				$this->recetario->set("idproducto",$idproducto);
				$this->recetario->set("materiaprima",$materiaprima);
				$this->recetario->set("cantidad",$cantidad);
				$this->recetario->set("indexmp",$indexmp);
				$resultado=$this->recetario->sp_nuevaReceta();
			    return $resultado;
				
			}
			public function sp_ActPrecioCosto($idproducto){
				$this->recetario->set("idproducto",$idproducto);
				$resultado=$this->recetario->sp_ActPrecioCosto();
			    return $resultado;
				
			}
			public function sp_consultaProductos(){
				$resultado=$this->recetario->sp_consultaProductos();
			    return $resultado;
				
			}
			public function sp_consultaReceta($idproducto){
				$this->recetario->set("idproducto",$idproducto);
				$resultado=$this->recetario->sp_consultaReceta();
			    return $resultado;
			
			}
			public function sp_receta($idproducto){
				$this->recetario->set("idproducto",$idproducto);
				$resultado=$this->recetario->sp_receta();
			    return $resultado;
			
			}
			
		
	}
		
?>