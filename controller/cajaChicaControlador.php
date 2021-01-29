<?php
include_once("../../model/CajaChicaModelo.php");

class ControladorCajaChica{
	
	private $CajaChica;
	 
	public function __construct(){
		$this->CajaChica= new CajaChica();
	}

	public function sp_consultaTotal(){
		$resultado=$this->CajaChica->sp_consultaTotal();
	    return $resultado;
	}

	public function sp_MovimientosCajaChica(){
		$resultado=$this->CajaChica->sp_MovimientosCajaChica();
	    return $resultado;
	}

	public function sp_consultafinanza(){
		$resultado=$this->CajaChica->sp_consultafinanza();
	    return $resultado;
	}

	public function sp_GuardarCajaChica($MontoIngreso){
		$this->CajaChica->set("MontoIngreso",$MontoIngreso);
		$resultado=$this->CajaChica->sp_GuardarCajaChica();
	    return $resultado;
	}

	public function sp_EgresoCajaChica($egreso){
		$this->CajaChica->set("egreso",$egreso);
		$resultado=$this->CajaChica->sp_EgresoCajaChica();
	    return $resultado;
	}

	
}
		
?>