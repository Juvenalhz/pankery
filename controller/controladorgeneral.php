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

		
	}
		
?>