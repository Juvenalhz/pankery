<?php
include_once('Conexion.php');
class Finanzas
{
    private $producto;
    private $Precio;
    private $Cantidad;
    private $Peso;
    private $fechacompra;
    private $Numcompra;
    private $idcompra;
    private $id;
    private $nombreEgresoFijo;
    private $GastoEF;
    private $id_egresofijo;
    private $egresofijo;
    private $Fecha;
    private $Gasto;
    
    
    
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

	public function sp_nuevoGastoMP()
	{
		$sql = "select * from sp_nuevoGastoMP('{$this->producto}','{$this->fechacompra}','{$this->Cantidad}','{$this->Precio}','{$this->Peso}','{$this->Numcompra}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultahistfinanza()
	{
		$sql = "select * from sp_consultahistfinanza()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_aggCapital()
	{
		$sql = "select * from sp_aggCapital('{$this->MontoIngreso}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultafinanza()
	{
		$sql = "select * from sp_consultafinanza()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	

	
}
