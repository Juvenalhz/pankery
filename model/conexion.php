<?php
class Conexion
{
//variables
	private $host;
	private $user;
	private $password;
	private $dbname;
	private $port;
	public $sql;


	public function __construct(){

		$this->host='127.0.0.1';
        //$this->host='192.168.1.6';
		$this->user='postgres';
		$this->password="123456";
		//$this->password="Int3l1punt0.VEN";
		//$this->password="Int3l1g3nsa";
		$this->port='5432';
		$this->dbname='ControlPankery';

		$con=pg_connect("user= $this->user password = $this->password port= $this->port dbname=$this->dbname host=$this->host") or die('NO HAY CONEXION: ' . pg_last_error());
	}

	public function consultaSimple($sql){
		pg_query($sql);
	}

	public function consultaRetorno($sql){
		$consulta=pg_query($sql);
		return $consulta;
	}

   //Para el Modulo Inventario por J.AGUILAR
	public function EJECUTAR(){
		// $this->$con();
		$resultado = pg_query($this->sql) or die ("ERROR AL EJECUTAR CONSULTA PGSQL: [".$this->sql."] -> ".pg_last_error());
		return $resultado;
		// pg_close($this->$con());
	}
	
}
?>