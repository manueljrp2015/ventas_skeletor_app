<?php


/**
* 
*/
class appCartModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function getListOrderPendig($store){
		return $this->db->query("
			SELECT
				prod._product,line.*,
				prod._height,
				prod._width,
				prod._large,
				prod._available,
				prod._weight
			FROM
				tbapp_orders_line as line
			inner JOIN tbapp_products as prod on prod.id = line._product_id
			WHERE
				line._store_id = ".$store."
				AND ISNULL(line._order_id)
				AND line._status_order_line = 'a';
			")->result();
	}

	public function updateCart($data){


		$query = $this->db->get_where("tbapp_products_store",["_producto_id" => $data["p"], "_store_id" => $data["store"]])->row();

		if($query){
			if($query->_discount > 0){
				return $this->db->where(["id" => $data["id"]])->update("tbapp_orders_line",[
				"_cant"       => $data["cant"], 
				"_rode"       => ($data["cant"] * $query->_discount), 
				"_product_id" => $data["p"]
				]);
			}
			else{
				return $this->db->where(["id" => $data["id"]])->update("tbapp_orders_line",[
				"_cant"       => $data["cant"], 
				"_rode"       => ($data["cant"] * $query->_price), 
				"_product_id" => $data["p"]
			]);
			}
		}
		else{

		}
	}

	public function deleteItemsCart($data){
		return $this->db->where(["id" => $data["id"]])->update("tbapp_orders_line",["_status_order_line" => "i"]);
	}

	public function getOrder($order){
		return $this->db->query("
			SELECT
					ordd.*, store._store,
					co.id AS idco,
					co._cost,
					co._total_weight,
					co._factor,
					co._param,
					co._date_retirement,
					co._addressee,
					co._contact,
					co._direcction,
					co._cel
			FROM
				tbapp_orders ordd
			JOIN tbapp_stores AS store ON store.id = ordd._store_id
			LEFT JOIN tbapp_order_courier AS co ON co._order_id = ordd._order_id
			WHERE
				ordd._order_id = ".$order."")->row();
	}

}