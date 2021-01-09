<?php
include_once("../../model/finanzasModelo.php");

		class ControladorFinanzas{
		
			private $finanzas;
			 
			public function __construct(){
				$this->finanzas= new Finanzas();
			}

			public function sp_nuevoArticulo($materiaprima){
				$this->finanzas->set("materiaprima",$materiaprima);
				$resultado=$this->finanzas->sp_consultahistfinanza();
			    return $resultado;
			
			}
			public function sp_consultahistfinanza(){
				$resultado=$this->finanzas->sp_consultahistfinanza();
			    return $resultado;
			
			}
			public function sp_consultafinanza(){
                
				$resultado=$this->finanzas->sp_consultafinanza();
			    return $resultado;
			
			}

		
	}
		
?>