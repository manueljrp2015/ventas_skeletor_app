<?php


/**
* 
*/
class appTntModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/*
	|
	| ESTA FUNNCION CALCULA EN DESPCACHO EN TNT PERO CON LOS DATOS DE VOLUMEN Y PESO CALCULADOS SEGUN PEDIDO Y INFORMACION DEL PRODUCTO
	|
	*/
	public function calculateTnt($data){

		$dorder = $this->getOrder($data["order"]);
		$volume = $dorder->_volume;
		$weight = $dorder->_weight;
		$volume_weight = ($volume / PARAM_CALCULATE_VOLWEIGHT);
		$config_currier = $this->getColumCourrieTnt($dorder->_store_id);
		$unserialize = unserialize($config_currier->_values);


		$param = $this->getParameterStore($dorder->_store_id);



		if ($volume_weight >= $weight) {
			$real_weight = $volume_weight;
		} else {
			$real_weight = $weight;
		}

		$factor = $this->getRate($real_weight, $unserialize["_row"], $unserialize["_id_costo"])->factor;

		if($real_weight < PARAM_WEIGHT){
			if($param->_courier_factor == 0){
				
				$cost_courrier = (($factor) + PARAM_CUOTE_TNT);
			}
			else{
				
				$cost_courrier = ((($param->_courier_factor/100) * $factor) + PARAM_CUOTE_TNT);
			}
		}
		else{
			if ($param->_courier_factor == 0) {
				
				$cost_courrier = (($real_weight * $factor) + PARAM_CUOTE_TNT);
			} else {
				
				$cost_courrier = (($real_weight * ($param->_courier_factor/100)  * $factor) + PARAM_CUOTE_TNT);
			}		
		}
		
		return [
		"cost"        => $cost_courrier, 
		"real_weight" => $real_weight, 
		"factor"      => $factor, 
		"config_c"    => ($param->_courier_factor/100), 
		"store_id"    => $dorder->_store_id, 
		"order"       => $data["order"]
		];
	}


	/*
	|
	| ESTA FUNNCION CALCULA EN DESPCACHO EN TNT RECIBIENDO LOS DATOS DE PESO, Y VOLUMEN DE PEDIDO
	|
	*/

	public function calculateTntManual($width, $large, $height, $weight, $store){

		$volume = ($width * $large * $height); //CALCULA EL VOLUMEN

		$volume_weight = ($volume / PARAM_CALCULATE_VOLWEIGHT); // CALCULA EL PESO ENTRE PARAMTERO DEFINIDO EN ALS CONSTANTES

		/* REALIZA CALCULO PARA ESTABLECER EL PESO REAL  */
		if ($volume_weight >= $weight) {
			$real_weight = $volume_weight;
		} else {
			$real_weight = $weight;
		}

		$config_currier = $this->getColumCourrieTnt($store);// EXTRAE LOS PARAMETROS DE CALCULO DE ENVIO DEL CLIENTE
		$unserialize = unserialize($config_currier->_values); // USERIALIZA LOS DATOS DE PARAMTEROS

		$factor = $this->getRate($real_weight, $unserialize["_row"], $unserialize["_id_costo"])->factor; // SE OBTIENE EL FACTOR DE GANANCIA

		$param = $this->getParameterStore($store);

		if($real_weight < PARAM_WEIGHT){
			if($param->_courier_factor == 0){
				
				$cost_courrier = (($factor) + PARAM_CUOTE_TNT);
			}
			else{
				
				$cost_courrier = ((($param->_courier_factor/100) * $factor) + PARAM_CUOTE_TNT);
			}
		}
		else{
			if ($param->_courier_factor == 0) {
				
				$cost_courrier = (($real_weight * $factor) + PARAM_CUOTE_TNT);
			} else {
				
				$cost_courrier = (($real_weight * ($param->_courier_factor/100)  * $factor) + PARAM_CUOTE_TNT);
			}		
		}
		
		return [
		"cost"        => $cost_courrier, 
		"real_weight" => $real_weight, 
		"factor"      => $factor, 
		"incremento"  => $param->_courier_factor, 
		"config_c"    => ($param->_courier_factor/100), 
		"store_id"    => $store
		];
	}

	public function getOrder($order){
		return $this->db->where(["_order_id" => $order])->get("tbapp_orders")->row();
	}

	public function getParameterStore($store){
		return $this->db->where(["_store_id" => $store])->get("tbapp_store_config")->row();
	}

	public function getColumCourrieTnt($store){
		return $this->db->where(["_store_new_id" => $store])->get("tbapp_courier_store_configure")->row();
	}

	public function getRate($weight, $row, $idcost){

		if ($idcost == 2) {
			$tb = "tbapp_tnt_city_second";
		} else {
			$tb = "tbapp_tnt_city_principal";
		}
		
		return $this->db->query("
			SELECT
				".strtoupper($row)." AS factor
			FROM
				".$tb."
			WHERE
				_since <= ".$weight."
			AND _until >= ".$weight."
			")->row();
	}

	
}