<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AppProductModel extends CI_Model {

	private $table_product = "tbapp_products";

	public function __construct()
	{
		parent::__construct();
	}

	protected function dataProduct($data){
		return [
			"_product "             => strtoupper($data["_product"]),
			"_sku"                  => $data["_sku"],
			"_ean"                  => ($data["_ean"] != null) ? $data["_ean"] : "0000000000000",
			"_ean_pack"             => ($data["_eanbox"] != null) ? $data["_eanbox"] : "0000000000000",
			"_ean_box"              => ($data["_dun"] != null) ? $data["_dun"] : "0000000000000",
			"_und"                  => $data["_und"],
			"_relacionship_package" => $data["_codrela"],
			"_cost"                 => ($data["_cost"] != null) ? $data["_cost"] : 0,
			"_discount"             => ($data["_descu"] != null) ? $data["_descu"] : 0,
			"_category"             => $data["_cate"],
			"_subcategory"          => $data["_subcate"],
			"_line"                 => $data["_line"],
			"_price_a"              => $data["_price1"],
			"_price_b"              => $data["_price2"],
			"_price_c"              => $data["_price3"],
			"_price_d "             => $data["_price4"],
			"_weight"               => $data["_wieght"],
			"_height"               => $data["_height"],
			"_width"                => $data["_width"],
			"_large"                => $data["_large"],
			"_expire"               => $data["_expire"],
			"_available_real"       => ($data["_available_real"] != null) ? $data["_available_real"] : 0,
			"_available"            => ($data["_available"] != null) ? $data["_available"] : 0,
			"_max_measure"          => ($data["_min_measure"] != null) ? $data["_min_measure"]  : 0,
			"_min_measure"          => ($data["_max_measure"] != null) ? $data["_max_measure"] : 0,
		];
	}

	public function putProduct($data){
		$this->db->insert($this->table_product, self::dataProduct($data));
		$idProducto = $this->db->insert_id();
		$this->includeProduct($idProducto);
		$this->db->insert('tbapp_products_img', [
			"_product_id" => $idProducto,
			"_img"         => "public/images/logotamy.png",
			"_img_thumbs"  => "public/images/logotamy.png",
			]);
		return true;
	}


	public function includeProduct($idProducto){
		$stores = $this->db->get('tbapp_stores')->result();
		foreach ($stores as $key => $value) {
			$this->db->insert('tbapp_products_store',[
				"_producto_id " => $idProducto,
				"_store_id "    => $value->id
				]);
		}
	}

	public function getProductList($all = "*"){
		if ($all == "*") {
			return $this->db->query("
				SELECT
				p.*,
				gp._group as grp,
				sgp._sub_group as sgrp,
				line._line  FROM
				tbapp_products as p
				LEFT JOIN tbapp_products_group as gp on gp.id = p._category
				LEFT JOIN tbapp_products_groupsub as sgp on sgp.id = p._subcategory
				LEFT JOIN tbapp_products_line as line on line.id = p._line
				order by p._product, line._line  asc
			")->result();
		} else {
			return $this->db->query("
				SELECT
				p.*,
				gp._group as grp,
				sgp._sub_group as sgrp,
				line._line  FROM
				tbapp_products as p
				LEFT JOIN tbapp_products_group as gp on gp.id = p._category
				LEFT JOIN tbapp_products_groupsub as sgp on sgp.id = p._subcategory
				LEFT JOIN tbapp_products_line as line on line.id = p._line
				WHERE p.id in (".$all.")
				order by p._product, line._line  asc
			")->result();
		}
		
		
	}

	public function inacProduct($id){
		return $this->db->where(["id" => $id])->update($this->table_product, ["_status" => "I"]);
	}

	public function updateProduct($data){
		 $this->db->set('_update_at', 'NOW()', FALSE);
		return $this->db->where(["id" => $data["id"]])->update($this->table_product, self::dataProduct($data));
	}

	public function getProductFromId($id){
		return $this->db->where(["id" => $id])->get($this->table_product)->row();
	}

}

/* End of file AppProductModel.php */
/* Location: ./application/models/app/product/AppProductModel.php */