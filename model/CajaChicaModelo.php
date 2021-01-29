<?php
include_once('Conexion.php');
class CajaChica{
    
    //metodos
	public function __construct()
	{
		$this->con = new Conexion();
	}

	public function set($atributo, $contenido)
	{
		$this->$atributo = $contenido;
	}

	public function get($atributo)
	{
		return $this->$atributo;
	}

	public function sp_consultaTotal(){
		$sql = "SELECT * FROM sp_total_caja_chica()";
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	public function sp_MovimientosCajaChica(){
		$sql = "SELECT * FROM sp_movimientos_caja_chica()";
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	public function sp_consultafinanza(){
		$sql = "SELECT * FROM sp_consultafinanza()";
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	public function sp_GuardarCajaChica(){
		$sql = "SELECT * FROM sp_GuardarCajaChica($this->MontoIngreso)";
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	
}
