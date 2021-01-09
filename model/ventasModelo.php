<?php
include_once('Conexion.php');
class Ventas
{
    private $producto;
    private $precio;
    private $cantidad;
    private $costo;
    private $pago;
    private $cliente;
    private $estatuspedido;
    private $pedido;
    private $id;
    private $deuda;
    
    
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

	public function sp_nuevoPedido()
	{
		$sql = "select * from sp_nuevoPedido('{$this->producto}','{$this->precio}','{$this->cantidad}','{$this->costo}','{$this->pago}','{$this->cliente}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_modifPedido()
	{
		$sql = "select * from sp_modifPedido('{$this->producto}','{$this->precio}','{$this->cantidad}','{$this->costo}','{$this->pago}','{$this->cliente}','{$this->id}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_eliminarPedido()
	{
		$sql = "select * from sp_eliminarPedido('{$this->id}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaProductos()
	{
		$sql = "select * from sp_consultaproductosVentas()";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_consultaPedidos()
	{
		$sql = "select * from sp_consultaPedidos('{$this->estatus}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	
	public function sp_cambioEstatusPedido()
	{
		$sql = "select * from sp_cambioEstatusPedido('{$this->estatuspedido}','{$this->pedido}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_busquedaPedido()
	{
		$sql = "select * from sp_busquedaPedido('{$this->id}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	public function sp_nuevopago()
	{
		$sql = "select * from sp_nuevopago('{$this->id}','{$this->pago}','{$this->deuda}')";
		//echo $sql;
		$resultado = $this->con->consultaRetorno($sql);
		return $resultado;
	}
	
	
}
