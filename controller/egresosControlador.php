<?php
include_once("../../model/egresosModelo.php");

		class ControladorEgresos{
		
			private $egreso;
			 
			public function __construct(){
				$this->egreso= new Egresos();
			}

			public function sp_nuevoGastoMP($producto,$fechacompra,$Cantidad,$Precio,$Peso,$Numcompra){
				$this->egreso->set("producto",$producto);
				$this->egreso->set("fechacompra",$fechacompra);
				$this->egreso->set("Cantidad",$Cantidad);
				$this->egreso->set("Precio",$Precio);
				$this->egreso->set("Peso",$Peso);
				$this->egreso->set("Numcompra",$Numcompra);
				$resultado=$this->egreso->sp_nuevoGastoMP();
			    return $resultado;
			
			}
			public function sp_nuevoGastoEF($egresofijo,$Fecha,$Gasto){
				$this->egreso->set("egresofijo",$egresofijo);
				$this->egreso->set("Fecha",$Fecha);
				$this->egreso->set("Gasto",$Gasto);
				$resultado=$this->egreso->sp_nuevoGastoEF();
			    return $resultado;
			
			}
			public function sp_modifGastoEF($egresofijo,$Fecha,$Gasto,$idcompra){
				$this->egreso->set("egresofijo",$egresofijo);
				$this->egreso->set("Fecha",$Fecha);
				$this->egreso->set("Gasto",$Gasto);
				$this->egreso->set("idcompra",$idcompra);
				$resultado=$this->egreso->sp_modifGastoEF();
			    return $resultado;
			
			}
			public function sp_nuevoEgresoFijo($nombreEgresoFijo,$GastoEF){
				$this->egreso->set("nombreEgresoFijo",$nombreEgresoFijo);
				$this->egreso->set("GastoEF",$GastoEF);
				$resultado=$this->egreso->sp_nuevoEgresoFijo();
			    return $resultado;
			
			}
			public function sp_modificarEgresoFijo($nombreEgresoFijo,$GastoEF,$id_egresofijo){
				$this->egreso->set("nombreEgresoFijo",$nombreEgresoFijo);
				$this->egreso->set("GastoEF",$GastoEF);
				$this->egreso->set("id_egresofijo",$id_egresofijo);
				$resultado=$this->egreso->sp_modificarEgresoFijo();
			    return $resultado;
			
			}

			public function sp_nuevoModifGastoMP($producto,$fechacompra,$Cantidad,$Precio,$Peso,$Numcompra,$idcompra){
				$this->egreso->set("producto",$producto);
				$this->egreso->set("fechacompra",$fechacompra);
				$this->egreso->set("Cantidad",$Cantidad);
				$this->egreso->set("Precio",$Precio);
				$this->egreso->set("Peso",$Peso);
				$this->egreso->set("Numcompra",$Numcompra);
				$this->egreso->set("idcompra",$idcompra);
				$resultado=$this->egreso->sp_nuevoModifGastoMP();
			    return $resultado;
			
			}

			public function sp_consultaGastos(){
				$resultado=$this->egreso->sp_consultaGastos();
			    return $resultado;
			}
			public function sp_consultaEgresosFijos(){
				$resultado=$this->egreso->sp_consultaEgresosFijos();
			    return $resultado;
			}
			public function sp_consultaEgresosFijosmodif($id){
				$this->egreso->set("id",$id);
				$resultado=$this->egreso->sp_consultaEgresosFijosmodif();
			    return $resultado;
			}
			public function sp_consultaGastoModif($id){
				$this->egreso->set("id",$id);
				$resultado=$this->egreso->sp_consultaGastoModif();
			    return $resultado;
			}
		
	}
		
?>