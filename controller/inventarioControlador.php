<?php
include_once("../../model/inventarioModelo.php");

		class ControladorInventario{
		
			private $inventario;
			 
			public function __construct(){
				$this->inventario= new Inventario();
			}

			public function sp_nuevoArticulo($materiaprima){
				$this->inventario->set("materiaprima",$materiaprima);
				$resultado=$this->inventario->sp_nuevoArticulo();
			    return $resultado;
			
			}
			public function sp_modificarArticulo($materiaprimamodif, $id){
				$this->inventario->set("materiaprimamodif",$materiaprimamodif);
				$this->inventario->set("id",$id);
				$resultado=$this->inventario->sp_modificarArticulo();
			    return $resultado;
			
			}
			public function sp_eliminarArticulo( $id){
				$this->inventario->set("id",$id);
				$resultado=$this->inventario->sp_eliminarArticulo();
			    return $resultado;
			
			}
			
			public function sp_consultaMP(){
				$resultado=$this->inventario->sp_consultaMP();
			    return $resultado;
			
			}	
			public function sp_listamp(){
				$resultado=$this->inventario->sp_listamp();
			    return $resultado;
			
			}	
			public function sp_actualizarMP($materiaprima,$CantidadMP,$accionCant){
				$this->inventario->set("materiaprima",$materiaprima);
				$this->inventario->set("CantidadMP",$CantidadMP);
				$this->inventario->set("accionCant",$accionCant);
				$resultado=$this->inventario->sp_actualizarMP();
			    return $resultado;
			
			}	
			
		
	}
		
?>