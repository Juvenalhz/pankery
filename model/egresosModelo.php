<?php
include_once('Conexion.php');
class Egresos
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
	public function sp_nuevoGastoEF()
	{
		$sql = "select * from sp_nuevoGastoEF('{$this->egresofijo}','{$this->Fecha}','{$this->Gasto}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_modifGastoEF()
	{
		$sql = "select * from sp_modifGastoEF('{$this->egresofijo}','{$this->Fecha}','{$this->Gasto}','{$this->idcompra}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_nuevoEgresoFijo()
	{
		$sql = "select * from sp_nuevoEgresoFijo('{$this->nombreEgresoFijo}','{$this->GastoEF}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_modificarEgresoFijo()
	{
		$sql = "select * from sp_modificarEgresoFijo('{$this->nombreEgresoFijo}','{$this->GastoEF}','{$this->id_egresofijo}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	public function sp_nuevoModifGastoMP()
	{
		$sql = "select * from sp_nuevoModifGastoMP('{$this->producto}','{$this->fechacompra}','{$this->Cantidad}','{$this->Precio}','{$this->Peso}','{$this->Numcompra}','{$this->idcompra}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}	
	public function sp_consultaGastos()
	{
		$sql = "select * from sp_consultaGastos()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaEgresosFijos()
	{
		$sql = "select * from sp_consultaEgresosFijos()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaEgresosFijosmodif()
	{
		$sql = "select * from sp_consultaEgresosFijos() where id_egresofijo = '{$this->id}'";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaGastoModif()
	{
		$sql = "select * from sp_consultaGastoModif('{$this->id}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	
}
