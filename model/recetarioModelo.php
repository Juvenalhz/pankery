<?php
include_once('Conexion.php');
class Recetario
{
    private $producto;
    private $precio;
    
    
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

	public function sp_nuevoProducto()
	{
		$sql = "select * from sp_nuevoProducto('{$this->producto}','{$this->precio}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_cambiarGanancia()
	{
		$sql = "select * from sp_cambiarGanancia('{$this->monto}','{$this->id_producto}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_nuevaReceta()
	{
		$sql = "select * from sp_nuevaReceta('{$this->idproducto}','{$this->materiaprima}','{$this->cantidad}','{$this->indexmp}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_ActPrecioCosto()
	{
		$sql = "select * from sp_ActPrecioCosto('{$this->idproducto}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_borrarReceta()
	{
		$sql = "select * from sp_borrarReceta('{$this->idproducto}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaProductos()
	{
		$sql = "select * from sp_consultaProductos()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaReceta()
	{
		$sql = "select * from sp_consultaReceta('{$this->idproducto}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_receta()
	{
		$sql = "select * from sp_receta('{$this->idproducto}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}

	
}
