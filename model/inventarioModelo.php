<?php
include_once('Conexion.php');
class Inventario
{
    private $materiaprima;
    private $materiaprimamodif;
    private $CantidadMP;
    private $accionCant;
    private $id;
    
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

	public function sp_nuevoArticulo()
	{
		$sql = "select * from sp_nuevoArticulo('{$this->materiaprima}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_modificarArticulo()
	{
		$sql = "select * from sp_modificarArticulo('{$this->materiaprimamodif}','{$this->id}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_eliminarArticulo()
	{
		$sql = "select * from sp_eliminarArticulo('{$this->id}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_actualizarMP()
	{
		$sql = "select * from sp_actualizarMP('{$this->materiaprima}','{$this->CantidadMP}','{$this->accionCant}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaMP()
	{
		$sql = "select * from sp_consultaMP()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_listamp()
	{
		$sql = "select * from sp_listamp()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	
}
