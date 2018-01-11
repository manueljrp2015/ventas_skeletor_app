<?php

/**
 *
 */
class appCatalogsModel extends CI_Model
{

  private $apptb_typeaccount     = 'tbapp_type_account';
  private $apptb_country         = 'tbapp_country';
  private $apptb_typeid          = 'tbapp_typeid';
  private $apptb_type_warehouse = 'tbapp_warehouse_type';
  private $apptb_fn_tiendas = 'tiendas';

  private $apptb_store = "tbapp_stores";

  private $dbf;

  function __construct()
  {
    parent::__construct();
    $this->dbf = $this->load->database('franquisia', TRUE);
  }

  public function getTypeAccount(){
    return json_encode($this->db->where('_account_status','ac')->get($this->apptb_typeaccount)->result(), JSON_FORCE_OBJECT);
  }

  public function getTypeAccountUser(){
    $arr = array(1,2);
    return json_encode($this->db->get($this->apptb_typeaccount)->result(), JSON_FORCE_OBJECT);
  }

  public function getCountry(){
    return json_encode($this->db->where('_country_status','ac')->get($this->apptb_country)->result(), JSON_FORCE_OBJECT);
  }

  public function getTypeId(){
    return json_encode($this->db->order_by("_typeid","asc")
      ->where('_status_typeid','ac')
      ->get($this->apptb_typeid)
      ->result(), JSON_FORCE_OBJECT);
  }

  public function getTypeWarehouse(){
    return json_encode($this->db->order_by("_warehouse_type","asc")
      ->where('_status_type','ac')
      ->get($this->apptb_type_warehouse)
      ->result(), JSON_FORCE_OBJECT);
  }

  public function getStore(){

    if($this->session->userdata("stores_old") == '*'){
      return json_encode($this->dbf->order_by("nombre_tienda","asc")
      ->where('activo','1')
      ->get($this->apptb_fn_tiendas)
      ->result(), JSON_FORCE_OBJECT);
    }
    else{
      return json_encode($this->dbf->order_by("nombre_tienda","asc")
      ->where('activo','1')
      ->where_in('id_tienda', $this->session->userdata("stores_old"))
      ->get($this->apptb_fn_tiendas)
      ->result(), JSON_FORCE_OBJECT);
    }
    
    
  }

  public function getStoreNew(){
    if($this->session->userdata("stores_new") == '*'){

    return json_encode($this->db->order_by("_store","asc")
      ->get($this->apptb_store)
      ->result(), JSON_FORCE_OBJECT);

    }
    else{
      return json_encode($this->db->order_by("_store","asc")
      ->where_in('id', $this->session->userdata("stores_new"))
      ->get($this->apptb_store)
      ->result(), JSON_FORCE_OBJECT);
    
    }
  }

  public function getGiros(){
    
    return json_encode($this->db->order_by("GirCod","asc")
      ->get("tbapp_softland_cwtgiro")
      ->result(), JSON_FORCE_OBJECT);
  }

  public function getPais(){
    
    return json_encode($this->db->order_by("PaiCod","asc")
      ->get("tbapp_softland_cwtpais")
      ->result(), JSON_FORCE_OBJECT);
  }

  public function getRegion(){
    
    return json_encode($this->db->order_by("id_Region","asc")
      ->get("tbapp_softland_cwtregion")
      ->result(), JSON_FORCE_OBJECT);
  }

  public function getProvincia($id_region){
    
    return $this->db
      ->where(["id_Region" => $id_region])
      ->order_by("ProvDes","asc")
      ->get("tbapp_softland_cwtprovincia")
      ->result();

  }

  public function getComuna($id_region){
    
    return $this->db->order_by("ComDes ","asc")
      ->where(["id_Region" => $id_region])
      ->get("tbapp_softland_cwtcomu")
      ->result();
  }

  public function getCiudad($id_region){
    
    return $this->db->order_by("CiuDes","asc")
      ->where(["id_Region" => $id_region])
      ->get("tbapp_softland_cwtciud")
      ->result();
  }

  public function getCountryTnt(){
    return $this->db->query("SELECT _ciudad from tbpapp_currier_config_tnt GROUP BY _ciudad;")->result();
  }

  public function getPuebloTnt($data){
    return $this->db->query("SELECT _pueblos from tbpapp_currier_config_tnt WHERE _ciudad = '".$data['country']."';")->result();
  }

  public function getCostTnt($data){
    return $this->db->query("SELECT * from tbpapp_currier_config_tnt WHERE _pueblos = '".$data['pueblo']."';")->row();
  }

  public function getTypePayments($active = "A"){
    return $this->db->where(["_status_payment" => $active])->get("tbapp_type_payments")->result();
  }

  public function getBankActive($active = "A"){
    return $this->db->where(["_status_bank" => $active])->get("tbapp_bank")->result();
  }

  public function getLineProduct(){
    return $this->db->get("tbapp_products_line")->result();
  }

  public function getCategoryProduct(){
    return $this->db->get("tbapp_products_group")->result();
  }

  public function getSubCategoryProduct(){
    return $this->db->get("tbapp_products_groupsub")->result();
  }

  public function getUndProduct(){
    return $this->db->get("tbapp_products_und")->result();
  }

  public function getTypeStore(){
    return $this->db->get("tbapp_store_type")->result();
  }

  public function getListPriceStore(){
    return $this->db->get("tbapp_products_list_price")->result();
  }

}

 ?>
