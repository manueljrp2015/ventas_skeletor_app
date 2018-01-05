<?php


/**
* 
*/
class appMigrateModel extends CI_Model
{

	private $tbstore = 'tiendas';
	private $tbstore_new = 'tbapp_stores';
	private $tbusers = 'usuarios';
	private $tbusers_new = 'tbapp_registeruser_app';
	private $dbf;
	
	function __construct()
	{
		parent::__construct();

		$this->dbf = $this->load->database('franquisia', TRUE);
	}

	protected function hashPassword($password)
	{
		$opciones = [
            'cost' => 12,
        ];
    	return password_hash($password, PASSWORD_BCRYPT, $opciones);
	}

	protected function generateReferStore($store){
		return strtoupper(str_replace(["_"," "] , "" , $store));
	}


	public function migrateuser(){
		$query = $this->dbf->query("SELECT
									u.*, (
										SELECT
											id_tienda
										FROM
											relacion_tiendas
										WHERE
											id_usuario = u.id_usuario
										ORDER BY
											id_tienda ASC
										LIMIT 1
									) AS store_id
								FROM
									usuarios AS u
								WHERE
									u.llave = 7
								AND u._migrate = 'NM'")->result();

		if($query){
			foreach ($query as $key => $value) {
				$this->db->insert($this->tbusers_new, [
					"_nickname"   => strtoupper($value->usuario),
					"_mail"       => "guest@tamymayorista.cl",
					"_key"        => self::hashPassword($value->pw),
					"_account_id" => $value->llave,
					"_country_id" => 2,
					"_store_id"  => ($value->store_id == null ? 1 : $value->store_id)
					]);
				$this->dbf->where("id_usuario", $value->id_usuario)->update($this->tbusers, ["_migrate" => "M"]);
			}
			return ["process" => "done"];
		}
		else{
			return ["process" => "fail-empty"];
		}
		
	}

	public function migrateStore(){

		
		$query = $this->dbf->get_where($this->tbstore, ["_migrate" => "NM"]);
		
		if($query->row()){
			foreach ($query->result() as $key => $value) {
				
				$this->db->insert($this->tbstore_new, [
					"_store"       => strtoupper($value->nombre_tienda),
					"_cost_center" => $value->centro_costo,
					"_idn"         => $value->rut,
					"_refer"       => self::generateReferStore($value->id_franquicia),
					"_region_id"   => 1,
					"_refer_old" => $value->id_franquicia
					]);
				$this->dbf->where("id_tienda", $value->id_tienda)->update($this->tbstore, ["_migrate" => "M"]);
				
			}
			return ["process" => "done"];
		}
		else{
			return ["process" => "fail-empty"];
		}
	}


/* paso 1 */
	public function migrateProductsqq(){

		$query = $this->dbf->get_where("productos",["unidad_medida" => 5]);
		if($query->row()){
			foreach ($query->result() as $key => $value) {

					$codigo = str_replace("C", "", $value->codigo);
					$que = $this->dbf->get_where("productos_caja",["codigo_caja" => $value->codigo])->result();
					foreach ($que as $key => $values) {
						$this->db->insert("tbapp_products", [
								"_product"      => strtoupper($value->nombre),
								"_sku"          => $codigo,
								"_ean"          => ($value->ean == "" || $value->ean == 0) ? "0000000000000" : $value->ean,
								"_ean_pack "    => ($value->ean_empaque == "" || $value->ean_empaque == 0) ? "0000000000000" :$value->ean_empaque,
								"_ean_box"      => ($value->ean_caja == "" || $value->ean_caja == 0) ? "0000000000000" :$value->ean_caja,
								"_category"     => $value->grupo,
								"_subcategory"  => $value->subgrupo,
								"_line "        => $this->getLine($value->grupo)->id_linea,
								"_max_measure " => $values->cantidad,
								"_min_measure " => 1,
								"_salemin"      => "N",
								"_salemin_pos"  => "Y",
								"_onsale"       => "Y",
								"_salemax"      => "Y",
								"_salemax_pos"  => "N",
								]);

						$id_new = $this->db->insert_id();

						$this->db->insert("tbapp_products_img", [
								"_product_id"  => $id_new,
								"_img "        => "public/images/productos/".$codigo.".jpg",
								"_img_thumbs " => "public/images/productos/".$codigo."_1.jpg",
								]);
					}
				}
				return ["process" => "done"];
			}
		else{
			return ["process" => "fail-empty"];
		}
	}


	
	/*paso 3 */

	public function migrateProductsqqq(){

		$query = $this->dbf->get_where("productos",["unidad_medida" => 2]);
		if($query->row()){
			foreach ($query->result() as $key => $value) {

					
						$this->db->insert("tbapp_products", [
								"_product"      => strtoupper($value->nombre),
								"_sku"          => $value->codigo,
								"_ean"          => ($value->ean == "" || $value->ean == 0) ? "0000000000000" : $value->ean,
								"_ean_pack "    => ($value->ean_empaque == "" || $value->ean_empaque == 0) ? "0000000000000" :$value->ean_empaque,
								"_ean_box"      => ($value->ean_caja == "" || $value->ean_caja == 0) ? "0000000000000" :$value->ean_caja,
								"_category"     => $value->grupo,
								"_subcategory"  => $value->subgrupo,
								"_line"        => $this->getLine($value->grupo)->id_linea,
								"_max_measure " => $value->cantidad_caja,
								"_min_measure " => 1,
								"_salemin"      => "Y",
								"_salemin_pos"  => "Y",
								"_onsale"       => "Y",
								"_salemax"      => "Y",
								"_salemax_pos"  => "N",
								]);

						$id_new = $this->db->insert_id();

						$this->db->insert("tbapp_products_img", [
								"_product_id"  => $id_new,
								"_img "        => "public/images/productos/".$value->codigo.".jpg",
								"_img_thumbs " => "public/images/productos/".$value->codigo."_1.jpg",
								]);
					}

						return ["process" => "done"];
				}
			
		else{
			return ["process" => "fail-empty"];
		}
	}

public function migrateProductsqqqq(){

		$query = $this->dbf->get_where("productos",["unidad_medida" => 4]);
		if($query->row()){
			foreach ($query->result() as $key => $value) {

					
						$this->db->insert("tbapp_products", [
								"_product"      => strtoupper($value->nombre),
								"_sku"          => $value->codigo,
								"_ean"          => ($value->ean == "" || $value->ean == 0) ? "0000000000000" : $value->ean,
								"_ean_pack "    => ($value->ean_empaque == "" || $value->ean_empaque == 0) ? "0000000000000" :$value->ean_empaque,
								"_ean_box"      => ($value->ean_caja == "" || $value->ean_caja == 0) ? "0000000000000" :$value->ean_caja,
								"_category"     => $value->grupo,
								"_subcategory"  => $value->subgrupo,
								"_line"        => $this->getLine($value->grupo)->id_linea,
								"_max_measure " => $value->cantidad_caja,
								"_min_measure " => 1,
								"_salemin"      => "Y",
								"_salemin_pos"  => "Y",
								"_onsale"       => "Y",
								"_salemax"      => "Y",
								"_salemax_pos"  => "N",
								]);

						$id_new = $this->db->insert_id();

						$this->db->insert("tbapp_products_img", [
								"_product_id"  => $id_new,
								"_img "        => "public/images/productos/".$value->codigo.".jpg",
								"_img_thumbs " => "public/images/productos/".$value->codigo."_1.jpg",
								]);
					}

						return ["process" => "done"];
				}
			
		else{
			return ["process" => "fail-empty"];
		}
	}

	public function migrateProductsqqqqq(){

		$query = $this->dbf->get_where("productos",["unidad_medida" => 3]);
		if($query->row()){
			foreach ($query->result() as $key => $value) {

					
						$this->db->insert("tbapp_products", [
								"_product"      => strtoupper($value->nombre),
								"_sku"          => $value->codigo,
								"_ean"          => ($value->ean == "" || $value->ean == 0) ? "0000000000000" : $value->ean,
								"_ean_pack "    => ($value->ean_empaque == "" || $value->ean_empaque == 0) ? "0000000000000" :$value->ean_empaque,
								"_ean_box"      => ($value->ean_caja == "" || $value->ean_caja == 0) ? "0000000000000" :$value->ean_caja,
								"_category"     => $value->grupo,
								"_subcategory"  => $value->subgrupo,
								"_line"        => $this->getLine($value->grupo)->id_linea,
								"_max_measure " => 1,
								"_min_measure " => 1,
								"_salemin"      => "Y",
								"_salemin_pos"  => "N",
								"_onsale"       => "Y",
								"_salemax"      => "N",
								"_salemax_pos"  => "N",
								]);

						$id_new = $this->db->insert_id();

						$this->db->insert("tbapp_products_img", [
								"_product_id"  => $id_new,
								"_img "        => "public/images/productos/".$value->codigo.".jpg",
								"_img_thumbs " => "public/images/productos/".$value->codigo."_1.jpg",
								]);
					}

						return ["process" => "done"];
				}
			
		else{
			return ["process" => "fail-empty"];
		}
	}


	public function migrateProductsqqqqqq(){

		$query = $this->dbf->get_where("productos",["unidad_medida" => 1]);
		if($query->row()){
			foreach ($query->result() as $key => $value) {

					
						$this->db->insert("tbapp_products", [
								"_product"      => strtoupper($value->nombre),
								"_sku"          => $value->codigo,
								"_ean"          => ($value->ean == "" || $value->ean == 0) ? "0000000000000" : $value->ean,
								"_ean_pack "    => ($value->ean_empaque == "" || $value->ean_empaque == 0) ? "0000000000000" :$value->ean_empaque,
								"_ean_box"      => ($value->ean_caja == "" || $value->ean_caja == 0) ? "0000000000000" :$value->ean_caja,
								"_category"     => $value->grupo,
								"_subcategory"  => $value->subgrupo,
								"_line"        => $this->getLine($value->grupo)->id_linea,
								"_max_measure " => $value->cantidad_caja,
								"_min_measure " => 1,
								"_salemin"      => "Y",
								"_salemin_pos"  => "Y",
								"_onsale"       => "Y",
								"_salemax"      => "Y",
								"_salemax_pos"  => "N",
								]);

						$id_new = $this->db->insert_id();

						$this->db->insert("tbapp_products_img", [
								"_product_id"  => $id_new,
								"_img "        => "public/images/productos/".$value->codigo.".jpg",
								"_img_thumbs " => "public/images/productos/".$value->codigo."_1.jpg",
								]);
					}

						return ["process" => "done"];
				}
			
		else{
			return ["process" => "fail-empty"];
		}
	}


	public function migrateProducts(){

		$query = $this->dbf->get_where("productos");
		if($query->row()){
			foreach ($query->result() as $key => $value) {
					$this->db->where(["_sku" => $value->codigo])->update("tbapp_products",["_salepos_pvp" => $value->pvp, "_weight" => $value->peso]);
			}
		}
	}


	public function getLine($grp){
		return $this->dbf->query("select id_linea from grupo where numero_grupo = '".$grp."'")->row();
	}

	public function addNewProductStore(){


		$store = $this->dbf->where("id_tienda !=", "139")->get("tiendas")->result();

		foreach ($store as $key => $values) {
			$query1 = $this->dbf->query("SELECT
							*
						FROM
							productos
						WHERE
							id_producto >= 631")->result();
			 foreach ($query1 as $key => $value) {
			 	$this->dbf->insert("lista_productos", [
						"codigo"              => $value->codigo,
						"precio_franquiciado" => 0,
						"id_tienda"           =>  $values->id_tienda,
						"activo"              => 0
			 		]);
			 }
		}

		 
		 var_dump(["msg" => "done"]);
	}

}