<?php

/**
* 
*/
class appStoreModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function findProductStore($p){

		$query =  $this->db->query("
			SELECT
				_product
			FROM
				tbapp_products
			WHERE
				_product LIKE '%".$p."%'
			");

		if($query->num_rows() > 0){

			foreach ($query->result() as $row) {
				$d[] = $row;
			}

			return $d;
		}
		else{
			return $d = NULL;
		}	
	}

	public function findProductStoreAllNames(){

		return  $this->db->query("
			SELECT
				_product
			FROM
				tbapp_products
			")->result();	
	}

	public function findProductStoreAllLimit($start, $end, $store){

		$q_two = $this->db->get("tbapp_products_line")->result();
		foreach ($q_two as $key1 => $value_1) {
			$q_one =  $this->db->query("
				SELECT
					ln._line,
					product.*, pr._sku,
					pr._product,
					pr._available,
					pr._category,
					gr._group,
					sgr._sub_group,
					pr._subcategory,
					pr._und,
					pr._min_measure,
					pr._max_measure,
					img._img,
					img._img_thumbs
				FROM
					tbapp_products_store AS product
					JOIN tbapp_products AS pr ON pr.id = product._producto_id
					JOIN tbapp_products_img AS img ON img._product_id = pr.id
					JOIN tbapp_products_line AS ln ON ln.id = pr._line
					JOIN tbapp_products_group AS gr ON gr.id = pr._category
					JOIN tbapp_products_groupsub AS sgr ON sgr.id = pr._subcategory
				WHERE
					product._store_id = ".$store."
					AND pr._line = ".$value_1->id."
					AND product._status_product = 'a'
					order by pr._product asc
					")->result();

								if($q_one){
									foreach ($q_one as $key2 => $value_2) {
					    				$ss[$key1][$key2] = $value_2;
					    		}

								}
								else{
									$ss[$key1][0] = 0;
								}

    		
    		$a[] = ["id_linea" => $value_1->id, "linea" => $value_1->_line, "images" => $value_1->_imagen, "productos" => $ss[$key1]];
    	}

    	return $a;
    		
	}

	public function findProductAll(){

		return  $this->db->query("
			SELECT
				product.*, img._img,
				img._img_thumbs
			FROM
				tbapp_products AS product
			JOIN tbapp_products_img AS img ON img._product_id = product.id
			")->result();	
	}


	public function findProductForName($query, $store){


		$q_two = $this->db->get("tbapp_products_line")->result();
		foreach ($q_two as $key1 => $value_1) {
			$q_one =  $this->db->query("
				SELECT
					ln._line,
					product.*, pr._sku,
					pr._product,
					pr._available,
					pr._category,
					gr._group,
					sgr._sub_group,
					pr._subcategory,
					pr._und,
					pr._min_measure,
					pr._max_measure,
					img._img,
					img._img_thumbs
				FROM
					tbapp_products_store AS product
					JOIN tbapp_products AS pr ON pr.id = product._producto_id
					JOIN tbapp_products_img AS img ON img._product_id = pr.id
					JOIN tbapp_products_line AS ln ON ln.id = pr._line
					JOIN tbapp_products_group AS gr ON gr.id = pr._category
					JOIN tbapp_products_groupsub AS sgr ON sgr.id = pr._subcategory
				WHERE
					pr._product LIKE '%".$query."%'
					AND product._store_id = ".$store."
					AND pr._line = ".$value_1->id."
					AND product._status_product = 'a'
					order by pr._product asc
					")->result();

								if($q_one){
									foreach ($q_one as $key2 => $value_2) {
					    				$ss[$key1][$key2] = $value_2;
					    		}

								}
								else{
									$ss[$key1][0] = 0;
								}

    		
    		$a[] = ["id_linea" => $value_1->id, "linea" => $value_1->_line, "images" => $value_1->_imagen, "productos" => $ss[$key1]];
    	}

    	return $a;
	}

	public function findProductForLine($data){

		$concat =  ($data["query"] != null && $data["query"] != "*") ? " AND pr._line = ".$data["query"] : " ";
		$concat .=  ($data["cat"] != null && $data["cat"] != "*") ? " AND pr._category=".$data["cat"] : " ";
		$concat .=  ($data["subcat"] != null && $data["subcat"] != "*") ? " AND pr._subcategory=".$data["subcat"] : " ";

		$q_two = $this->db->where(["id" => $data["query"]])->get("tbapp_products_line")->result();
		foreach ($q_two as $key1 => $value_1) {

			
			$q_one =  $this->db->query("
				SELECT
					ln._line,
					product.*, pr._sku,
					pr._product,
					pr._available,
					pr._category,
					gr._group,
					sgr._sub_group,
					pr._subcategory,
					pr._und,
					pr._min_measure,
					pr._max_measure,
					img._img,
					img._img_thumbs
				FROM
					tbapp_products_store AS product
					JOIN tbapp_products AS pr ON pr.id = product._producto_id
					JOIN tbapp_products_img AS img ON img._product_id = pr.id
					JOIN tbapp_products_line AS ln ON ln.id = pr._line
					JOIN tbapp_products_group AS gr ON gr.id = pr._category
					JOIN tbapp_products_groupsub AS sgr ON sgr.id = pr._subcategory
				WHERE
					product._store_id = ".$data["store"]."
					".$concat."
					AND product._status_product = 'a'
					order by pr._product asc
					")->result();

								if($q_one){
									foreach ($q_one as $key2 => $value_2) {
					    				$ss[$key1][$key2] = $value_2;
					    		}

								}
								else{
									$ss[$key1][0] = 0;
								}

    		
    		$a[] = ["id_linea" => $value_1->id, "linea" => $value_1->_line, "images" => $value_1->_imagen, "productos" => $ss[$key1]];
    	}

    	return $a;
	}

	protected function dataOrdersProduct($data){
		return [
			'_product_id'   => $data['producto_id'],
			'_producto_sku' => $data['sku'],
			'_cant'         => $data['cant'],
			'_rode'         => ($data['cant'] * $data['precio']),
			'_store_id'     => $data['store'],
			'_user_id'      => $this->session->userdata('id')
			];
	}

	public function putProductOrder($data){

		$query = $this->db->where([
			'_store_id'          => $data['store'],
			'_product_id'        => $data['producto_id'],
			'_producto_sku'      => $data['sku'],
			'_order_id'          => NULL,
			'_status_order_line' => 'a'
			])->get("tbapp_orders_line")->row();

		

		if($query){

			$this->db->where([
			'_store_id'          => $data['store'],
			'_product_id'        => $data['producto_id'],
			'_producto_sku'      => $data['sku'],
			'_order_id'          => NULL,
			'_status_order_line' => 'a'
			])->update("tbapp_orders_line",[
				'_cant' => $query->_cant + $data['cant'],
				'_rode' => ($query->_cant + $data['cant']) * $data['precio']
			]);
		}
		else{
			$this->db->insert("tbapp_orders_line",self::dataOrdersProduct($data));
		}

	}

	public function updateAvailableReal($idproducto, $cant){
		$query = $this->db->where(["id" => $data['producto_id']])->get("tbapp_products")->row();
		if ($query) {
			$this->db->where(["id" => $data['producto_id']])->update("tbapp_products",[
				"_available_real" => ($query->_available_real - $cant),
				"_available" => ($query->_available - $cant),
				]);
		} else {
			return false;
		}
		
	}


	public function findOrderPending(){

		if($this->session->userdata("stores_new") == '*'){
			return $this->db->query("
				SELECT
					sum(lno._cant) as c,
					sum(lno._rode) as t,
				ti._store,
				ti.id
				FROM
					tbapp_orders_line AS lno
				JOIN tbapp_stores AS ti ON ti.id = lno._store_id
				WHERE
					 ISNULL(lno._order_id) AND lno._status_order_line = 'a'
				GROUP BY lno._store_id;
			")->result();
		}
		else{
			return $this->db->query("
				SELECT
					sum(lno._cant) as c,
					sum(lno._rode) as t,
				ti._store,
				ti.id
				FROM
					tbapp_orders_line AS lno
				JOIN tbapp_stores AS ti ON ti.id = lno._store_id
				WHERE
					lno._store_id in (".$this->session->userdata("stores_new").")
				AND ISNULL(lno._order_id) AND lno._status_order_line = 'a'
				GROUP BY lno._store_id;
			")->result();
		}
	}

	public function getCountOrderPending(){
		if($this->session->userdata("stores_new") == '*'){
			return $this->db->query("
				SELECT count(*) as tosss
					FROM (
					   select count(*) from tbapp_orders_line where ISNULL(_order_id) AND _status_order_line = 'a' GROUP BY _store_id
					) AS x
				")->row();
		}
		else{
			return $this->db->query("
				SELECT count(*) as tosss
					FROM (
					   select count(*) from tbapp_orders_line where ISNULL(_order_id) AND _status_order_line = 'a' AND _store_id in (".$this->session->userdata("stores_new").") GROUP BY _store_id
					) AS x
				")->row();
		}
	}

	public function getPaymentConditionsForStore($store){
		return $this->db->query("SELECT
					*
				FROM
					tbapp_store_payment_conditions
				WHERE
					_store_id = ".$store.";")->row();
					}

	
}