<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppCellarModel extends CI_Model {

	private $tborders;
	private $tborderline;
	private $tborderstate;

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			"app/functions/appFunctionsModel"
			]);

		$this->tborders = "tbapp_orders";
		$this->tborderline = "tbapp_orders_line";
		$this->tborderstate = "tbapp_order_timeline";
	}

	public function refreschOrder($order){

		$tax = $this->appFunctionsModel->getTax()->_tax_factor;

		$query = $this->db->query("
			SELECT
				SUM(_cant) AS cantidad,
				sum(_rode) AS rode,
				COUNT(_order_id) AS items,
				sum(_rode) * ".$tax." AS iva,
				sum(_rode) - (sum(_rode) * ".$tax.")  AS neto,
				(
					SELECT
						_rode
					FROM
						tbapp_orders_line
					WHERE
						_order_id = ".$order."
					AND _producto_sku = 'TR001'
				) AS courier_cost
			FROM
				tbapp_orders_line
			WHERE
				_order_id = ".$order."
			AND _status_order_line = 'a';
			")->row();

		if ($query) {
			$this->db->where(["_order_id" => $order])->update($this->tborders, [
				"_total_order"  => $query->rode,
				"_total_iva"    => $query->iva,
				"_total_neto"   => $query->neto,
				"_courier_cost" => $query->courier_cost,
				"_item"         => $query->items,
				"_total_cant"   => $query->cantidad
			]);

			if($query->items == 0){
				$this->db->where(["_order_id" => $order])->update($this->tborders,[
					"_order_state" => 13
				]);

				$this->db->insert($this->tborderstate,[
					"_order_id" => $order,
					"_order_state" => 13
				]);
			}

			return true;
		} else {
		}
	}

	public function getPurchasesForStore(){
			return $this->db->query("
				SELECT
					ords.*, stores._store,
					stores._idn,
					st._description_state,
					(SELECT COUNT(*) FROM tbapp_order_timeline WHERE _order_id = ords._order_id) as count_state,
					(SELECT COUNT(_status) from tbapp_payments where _order_id = ords._order_id) as cstspay,
  					(SELECT _status from tbapp_payments where _order_id = ords._order_id) as stspay
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS stores ON stores.id = ords._store_id
				JOIN tbapp_order_state as st on st.id = ords._order_state;")->result();
	}

	public function getPurchasesSummaryForStore(){

			return $this->db->query("
				SELECT
						sum(ords._total_order) AS totalo,
						sum(ords._item) AS totali,
						sum(ords._total_cant) AS totalc,
						count(ords.id) AS totalid,
						sum(ords._volume) AS totalv,
						sum(ords._weight) AS totalw
					FROM
						tbapp_orders AS ords
					JOIN tbapp_stores AS stores ON stores.id = ords._store_id
					WHERE
						MONTH (ords._date_create) = 12
					AND YEAR (ords._date_create) = 2017
					and ords._order_state != 13;")->row();
						
		
	}

	public function deleteItemOrder($id, $order){
		$this->db->where(["id" => $id])->update($this->tborderline,[
			"_status_order_line" => 'i'
		]);
		$this->refreschOrder($order);
	}


	public function getCourierOrder($data){
		return $this->db->query("
			SELECT
			c.*,
			ctp._type_courier FROM
			tbapp_order_courier as c
			LEFT JOIN tbapp_order_courier_type as ctp ON ctp.id = c._courier_id
			WHERE
			c._order_id = ".$data['order'].";")->row();
	}

	public function getItemOrder($data){
		return $this->db->query("SELECT
					oline.id,
					oline._order_id,
					oline._product_id,
					oline._producto_sku,
					oline._cant,
					oline._rode,
					oline._line_order,
					oline._bill,
					oline._picking,
					oline._order_picking,
					oline._confirm,
					oline._office_guide,
					oline._user_id,
					oline._store_id,
					p._product,
					p._available,
					p._available_real
					 from 
					tbapp_orders_line as oline
					RIGHT JOIN tbapp_products as p on p.id = oline._product_id
					WHERE
					oline._order_id = ".$data['order']."
					and
					oline._status_order_line = 'a';")->result();
	}

	


	public function getItemOrderWidthStore($order, $store){
		return $this->db->query("
				SELECT
					oline.id,
					oline._order_id,
					oline._product_id,
					oline._producto_sku,
					oline._cant,
					oline._rode,
					oline._line_order,
					oline._bill,
					oline._picking,
					oline._order_picking,
					oline._confirm,
					oline._office_guide,
					oline._user_id,
					oline._store_id,
					p._product,
					p._available,
					p._available_real,
					ps._price,
					ps._discount
				FROM
					tbapp_orders_line AS oline
				RIGHT JOIN tbapp_products AS p ON p.id = oline._product_id 
				RIGHT JOIN tbapp_products_store as ps	ON ps._producto_id = oline._product_id AND ps._store_id = ".$store." 
				WHERE
					oline._order_id = ".$order."
				AND oline._status_order_line = 'a';")->result();
	}

	public function getInformationStore($store){
		return $this->db->query("
			SELECT
				st.*, stc._balance,
				stc._credit,
				stc._paying_to,
				stc._type_pay
			FROM
				tbapp_stores AS st
			LEFT JOIN tbapp_store_payment_conditions AS stc ON stc._store_id = st.id
			WHERE
				st.id = ".$store.";
			")->row();
	}

	public function getResumenOrder($order){
		return $this->db->query("
			SELECT
			* FROM
			tbapp_orders
			WHERE
			_order_id = ".$order.";
			")->row();
	}

	public function getTimeLine($data){
		return $this->db->query("
			SELECT
				t.id,
				t._order_id,
				t._order_state,
				t._cretae_at,
				st._description_state,
				DATE_FORMAT(t._cretae_at, '%d-%m-%Y') as _date,
				DATE_FORMAT(t._cretae_at, '%l:%i:%S %p') as _time
			FROM
				tbapp_order_timeline AS t
			LEFT JOIN tbapp_order_state AS st ON st.id = t._order_state
			WHERE
				t._order_id = ".$data['order'].";
			")->result();
	}

	public function getComment($data){
		return $this->db->select("_comment")
		->where(["_order_id" => $data["order"]])
		->get("tbapp_orders")
		->row();
	}

	public function updateOrder($data){

		$v = $data['v'];
		$n = $data['n'];
		$order = $data['orden'];

		if($n > $v){
			$res = ($n - $v);
			$operator = "-";
		}
		else if($n < $v){
			$res = ($v - $n);
			$operator = "+";
		}


		$query = $this->db->where(["_producto_id" => $data["pid"], "_store_id" => $data["store"]])->get("tbapp_products_store")->row();

		if($query){
			if($query_discount > 0){
				$price = $query->_discount;
			}
			else{
				$price = $query->_price;
			}
		}

		$this->db->where(["id" => $data["id"]])->update($this->tborderline, [
			"_cant" => $n,
			"_rode" => ($n * $price)
		]);

		$this->refreshStockAvailible($data["pid"], $res, $operator);
		$this->refreschOrder($order);
	}

	public function refreshStockAvailible($id, $res, $operator){

		$query = $this->db->where(["id" => $id])->get("tbapp_products")->row();
		if ($query) {
			if ($operator == "+") {
				$this->db->where(["id" => $id])->update("tbapp_products", [
					"_available" => $query->_available + $res
				]);
			} else if($operator == "-") {
				$this->db->where(["id" => $id])->update("tbapp_products", [
					"_available" => $query->_available - $res
				]);
			} else if($operator == "*"){
			}
		} else {
		}
	}

	public function includeProduct($data){
		$query = $this->db->where(["_order_id" => $data["order"], "_product_id" => $data["_product_id"]])->get($this->tborderline)->row();
		if ($query) {
			$price = $this->getPriceProduct($data['tienda'], $data["_product_id"]);
			$this->db->where(["_order_id" => $data["order"], "_product_id" => $data["_product_id"]])->update($this->tborderline, [
				"_cant"         => ($data['cantidad'] + $query->_cant),
				"_rode"         => (($data['cantidad'] + $query->_cant) * $price),
			]);
			$this->refreschOrder($data['order']);
			$this->refreshStockAvailible($data["_product_id"], $data['cantidad'], "-");
			return ["msg" => true];
		} else {

			$price = $this->getPriceProduct($data['tienda'], $data["_product_id"]);
			if ($price == false) {
				return ["msg" => "no-exist-product"];
			} else {
				$this->db->insert($this->tborderline, [
				"_order_id"     => $data['order'],
				"_product_id"   => $data['_product_id'],
				"_producto_sku" => $data['sku'],
				"_cant"         => $data['cantidad'],
				"_rode"         => ($data['cantidad'] * $price),
				"_store_id "    => $data['tienda'],
				"_user_id  "    => $this->session->userdata("id"),
				"_line_order "  => 0,
			]);
				$this->refreschOrder($data['order']);
				$this->refreshStockAvailible($data["_product_id"], $data['cantidad'], "-");
				return ["msg" => true];
			}
		}		
	}

	public function getPriceProduct($store, $idproduct){
		$q = $this->db->where(["_producto_id" => $idproduct, "_store_id" => $store])->get("tbapp_products_store")->row();
			if ($q) {
				if($q->_discount > 0){
					$price = $q->_discount;
				}
				else{
					$price = $q->_price;
				}
				return $price;
			} else {
				return false;
			}
			
	}

	public function asignedTransportManual($data){

		$query = $this->db->where(["_order_id" => $data["_order_id"], "_producto_sku" => "TR001"])->get("tbapp_orders_line")->row();
		if(!$query){

			/*$this->db->insert("tbapp_order_courier",[
				"_courier_id"   => $data["courier_id"],
				"_cost"         => $data["cost"],
				"_total_weight" => $data["total_weight"],
				"_factor"       => $data["factor"],
				"_param"        => $data["param"],
				"_order_id"     => $data["order_id"],
				"_store_id"     => $data["store_id"],
				]);*/

				if (isset($data["notransport"])) {
					$this->db->insert("tbapp_orders_line",[
					'_product_id'   => "295",
					'_producto_sku' => "TR001",
					'_cant'         => 1,
					'_rode'         => 0,
					'_store_id'     => $data['_store_id'],
					'_order_id'		=> $data["_order_id"],
					'_user_id'      => $this->session->userdata('id')
					]);
				} else {
					$this->db->insert("tbapp_orders_line",[
					'_product_id'   => "295",
					'_producto_sku' => "TR001",
					'_cant'         => 1,
					'_rode'         => $data["_total"],
					'_store_id'     => $data['_store_id'],
					'_order_id'		=> $data["_order_id"],
					'_user_id'      => $this->session->userdata('id')
					]);
				}
			$this->refreschOrder($data['_order_id']);

		}
		else{
			if (isset($data["notransport"])) {
				$this->db->where(["_order_id" => $data["_order_id"], "_producto_sku" => "TR001"])->update("tbapp_orders_line", [
				'_rode' => 0
			]);
			} else {
				$this->db->where(["_order_id" => $data["_order_id"], "_producto_sku" => "TR001"])->update("tbapp_orders_line", [
				'_rode' => $data["_total"]
			]);
			}
			$this->refreschOrder($data['_order_id']);
		}
	}

	public function getOrderState($data){
		return $this->db->query("
			SELECT
					id,
					_description_state,
					".$data["order"]." as o
				FROM
					tbapp_order_state
				WHERE
					id >= 4 and id <= 9;
			")->result();
	}

	public function changeState($data){

		$this->db->insert("tbapp_order_timeline",[
			"_order_id" => $data["order"],
			"_order_state" => $data["id"]
		]);

		$this->db->where(["_order_id" => $data["order"]])->update("tbapp_orders", [
			"_order_state" => $data["id"]
		]);

		return true;
	}

	/*
	|
	|
	| PICKING
	|
	|*/

	public function getOrderForPicking($data){
		return $this->db->query("
			SELECT
				ords.id,
				ords._store_id,
				st._store,
					ords._order_id,
					ords._item,
					ords._total_cant,
					ords._date_create,
					CAST((select sum(_picking) as pick from tbapp_orders_line where _order_id = ords._order_id and _status_order_line = 'a') AS  CHAR) as p,
					CAST((select sum(_cant) as cant from tbapp_orders_line where _order_id = ords._order_id and _status_order_line = 'a' and _producto_sku != 'TR001') AS CHAR) as t,
					pick._start,
					pick._end,
					pick._nropicking
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS st ON st.id = ords._store_id
				LEFT JOIN tbapp_order_picking as pick on pick._order_id = ords._order_id
				WHERE
					ords._store_id = ".$data["store"]."
				AND ords._order_state IN (4, 5, 6, 7, 8, 9)
				ORDER BY ords.id DESC;
			")->result();
	}

	public function getItemOrderForPicking($data){
		return $this->db->query("SELECT
					oline.id,
					oline._order_id,
					oline._product_id,
					oline._producto_sku,
					oline._cant,
					oline._rode,
					oline._line_order,
					oline._bill,
					oline._picking,
					oline._order_picking,
					oline._confirm,
					oline._office_guide,
					oline._user_id,
					oline._store_id,
					p._product,
					p._ean,
					p._ean_pack,
					p._ean_box,
					p._available,
					p._available_real
					from 
					tbapp_orders_line as oline
					RIGHT JOIN tbapp_products as p on p.id = oline._product_id
					WHERE
					oline._order_id = ".$data['order']."
					AND oline._producto_sku <> 'TR001'
					AND oline._status_order_line = 'a'
					ORDER BY oline._order_picking asc;")->result();
	}

	public function getSumaryPicking($data){
		return $this->db->query("
			SELECT
				CAST(SUM(_cant) AS CHAR) AS cantidad,
				CAST(sum(_picking) AS CHAR) AS pickeado,
				CAST((SUM(_cant) - sum(_picking)) AS CHAR) AS resto
			FROM
				tbapp_orders_line
			WHERE
				_order_id = ".$data['order']."
			AND _status_order_line = 'a'
			AND _producto_sku <> 'TR001';
			")->row();
	}

	public function pickingOrder($data){
		$query = $this->db->query("
			SELECT
					l.*
				FROM
					tbapp_products AS prod
				JOIN tbapp_orders_line AS l
				WHERE
					prod._ean = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._picking < l._cant
				OR prod._ean_pack = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._picking < l._cant
				OR prod._ean_box = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._picking < l._cant
				OR prod._sku = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._picking < l._cant;
			")->row();

		if($query){
			$this->db->where(["_producto_sku" => $query->_producto_sku, "_order_id" => $data['_order_hidden']])->update("tbapp_orders_line",[
				"_picking" => $query->_picking + 1
			]);
			return ["msg" => true];
		}
		else{
			return ["msg" => "N/E"];
		}
	}

	public function saveInfoPicking($data){
		$query =  $this->db->where(["_order_id" => $data["order"]])->get("tbapp_order_picking")->row();
		if ($query) {
			return false;
		} else {
			$this->db->insert("tbapp_order_picking", [
				"_order_id"    => $data["order"],
				"_nropicking " => "P-".date("ynjgis")."-".$data["order"]
			]);
		}
		
	}


	/*
	|
	|
	| VERIFY
	|
	|*/


	public function getOrderForVerify($data){
		return $this->db->query("
			SELECT
				ords.id,
				ords._store_id,
				st._store,
					ords._order_id,
					ords._item,
					ords._total_cant,
					ords._date_create,
					CAST((select sum(_confirm) as pick from tbapp_orders_line where _order_id = ords._order_id and _status_order_line = 'a') AS CHAR) as p,
					CAST((select sum(_cant) as cant from tbapp_orders_line where _order_id = ords._order_id and _status_order_line = 'a' and _producto_sku <> 'TR001') AS CHAR) as t,
					pick._start,
					pick._end,
					pick._nroverify
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS st ON st.id = ords._store_id
				LEFT JOIN tbapp_order_verify as pick on pick._order_id = ords._order_id
				WHERE
					ords._store_id = ".$data["store"]."
				AND ords._order_state IN (7, 8, 9)
				ORDER BY ords.id DESC;
			")->result();
	}

	public function getItemOrderForVerify($data){
		return $this->db->query("SELECT
					oline.id,
					oline._order_id,
					oline._product_id,
					oline._producto_sku,
					oline._cant,
					oline._rode,
					oline._line_order,
					oline._bill,
					oline._picking,
					oline._order_picking,
					oline._confirm,
					oline._office_guide,
					oline._user_id,
					oline._store_id,
					p._product,
					p._ean,
					p._ean_pack,
					p._ean_box,
					p._available,
					p._available_real
					from 
					tbapp_orders_line as oline
					RIGHT JOIN tbapp_products as p on p.id = oline._product_id
					WHERE
					oline._order_id = ".$data['order']."
					AND oline._producto_sku <> 'TR001'
					AND oline._status_order_line = 'a'
					ORDER BY oline._order_picking asc;")->result();
	}

	public function getSumaryVerify($data){
		return $this->db->query("
			SELECT
				CAST(SUM(_cant) AS CHAR) AS cantidad,
				CAST(sum(_confirm) AS CHAR) AS verificado,
				CAST((SUM(_cant) - sum(_confirm)) AS CHAR) AS resto
			FROM
				tbapp_orders_line
			WHERE
				_order_id = ".$data['order']."
			AND _status_order_line = 'a'
			AND _producto_sku <> 'TR001';
			")->row();
	}

	public function verifyOrder($data){
		$query = $this->db->query("
			SELECT
					l.*
				FROM
					tbapp_products AS prod
				JOIN tbapp_orders_line AS l
				WHERE
					prod._ean = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._confirm < l._cant
				OR prod._ean_pack = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._confirm < l._cant
				OR prod._ean_box = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._confirm < l._cant
				OR prod._sku = '".$data['_code']."'
				AND l._producto_sku = prod._sku
				AND l._order_id = ".$data['_order_hidden']."
				AND l._confirm < l._cant;
			")->row();

		if($query){
			$this->db->where(["_producto_sku" => $query->_producto_sku, "_order_id" => $data['_order_hidden']])->update("tbapp_orders_line",[
				"_confirm" => $query->_confirm + 1
			]);
			return ["msg" => true];
		}
		else{
			return ["msg" => "N/E"];
		}
	}

	public function saveInfoVerify($data){
		$query =  $this->db->where(["_order_id" => $data["order"]])->get("tbapp_order_verify")->row();
		if ($query) {
			return false;
		} else {
			$this->db->insert("tbapp_order_verify", [
				"_order_id"    => $data["order"],
				"_nroverify " => "V-".date("ynjgis")."-".$data["order"]
			]);
		}
		
	}

}

/* End of file AppCellarModel.php */
/* Location: ./application/models/app/cellar/AppCellarModel.php */