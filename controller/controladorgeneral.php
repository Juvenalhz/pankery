<?php
include_once("model/finanzasModelo.php");

		class ControladorGeneral{
		
			private $finanzas;
			 
			public function __construct(){
				$this->finanzas= new Finanzas();
			}

			public function sp_consultafinanza(){
                
				$resultado=$this->finanzas->sp_consultafinanza();
			    return $resultado;
			
			}

			public function sp_consultanumpedidos(){
                
				$resultado=$this->finanzas->sp_consultanumpedidos();
			    return $resultado;
			
			}

			public function sp_consultaCajachica(){
                
				$resultado=$this->finanzas->sp_consultaCajachica();
			    return $resultado;
			
			}
			public function sp_consultarecetas(){
                
				$resultado=$this->finanzas->sp_consultarecetas();
			    return $resultado;
			
			}
			
		
	}
		
?>