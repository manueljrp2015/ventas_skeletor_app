<?php

/**
* 
*/
class appOrdersModel extends CI_Model
{

	private $apptb_fn_pedidos = 'pedidos';

	private $dbf;
	
	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
		$this->load->model([
			"app/functions/appFunctionsModel",
			"app/files/appFileProcessModel",
			"app/odbc/appOdbcModel"
			]);
	}

	public function getGiroRelationship($data){
		return $this->db->get_where("tbapp_softland_cwtgiro",["codigo_giro_sii" => $data['giro']])->row();
	}

	public function getStoreForFree(){

		if($this->session->userdata("stores_old") == '*'){
		return json_encode($this->dbf->query("
			SELECT
				p.id_tienda,
				t.nombre_tienda,
			  t4.nombres
			FROM
				pedidos AS p
			LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
			JOIN relacion_tiendas as t3 ON t3.id_tienda = t.id_tienda 
			JOIN usuarios as t4 ON t4.id_usuario = t3.id_usuario and t4.llave = 7
			WHERE
				p.estado_pedido IN (
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					18,
					19,
					17,
					15
				)
			AND p.excepcion = 0
			GROUP BY
				p.id_tienda
			ORDER BY
				t4.nombres ASC;
			")->result());
		}
		else{
			return json_encode($this->dbf->query("
			SELECT
				p.id_tienda,
				t.nombre_tienda,
			  t4.nombres
			FROM
				pedidos AS p
			LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
			JOIN relacion_tiendas as t3 ON t3.id_tienda = t.id_tienda 
			JOIN usuarios as t4 ON t4.id_usuario = t3.id_usuario and t4.llave = 7
			WHERE
				p.estado_pedido IN (
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					18,
					19,
					17,
					15
				)
			AND p.excepcion = 0
			AND t.id_tienda IN (".$this->session->userdata("stores_old").")
			GROUP BY
				p.id_tienda
			ORDER BY
				t4.nombres ASC;
			")->result());
		}
	}

	public function getListStateAcept(){
		return json_encode($this->dbf->query("
			SELECT
				*
			FROM
				estados
			WHERE
				id_estado IN (
					3,
					6,
					7,
					9,
					10,
					18,
					19,
					17,
					15
				);
			")->result());
	}

	public function getStoreOrders($data){
		return $this->dbf->query("
			SELECT
				p.*, t.nombre_tienda as nt, u.usuario as nu, e.estado as es
			FROM
				pedidos AS p
			LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
			LEFT JOIN usuarios as u ON u.id_usuario = p.id_usuario
			LEFT JOIN estados as e ON e.id_estado = p.estado_pedido
			WHERE
				p.id_tienda = ".$data['store']."
			ORDER BY
				p.fecha_inicio DESC")
		->result();
	}

	public function verifyPendingOrder($data){
		return $this->dbf->query(
			"SELECT
				id_pedido,
				fecha_inicio,
				total_pedido AS total_p,
				id_tienda AS transsacciones,
				cantidad_items AS total_i,
				cantidad_total AS total_t,
				deuda AS deuda,
				estado_pedido,
				estado.estado
			FROM
				pedidos
			JOIN estados AS estado ON estado.id_estado = estado_pedido
			WHERE
				id_tienda = ".$data['store']."
			AND excepcion = 0
			ORDER BY id_pedido desc
			LIMIT 1;
			")->row();
	}

	public function getAnalisysStoreOrders($data){
		return $this->dbf->query(
			"SELECT
				sum(total_pedido) AS total_p,
				count(id_tienda) AS transsacciones,
				SUM(cantidad_items) AS total_i,
				sum(cantidad_total) AS total_t,
				sum(deuda) as deuda
			FROM
				pedidos
			WHERE
				id_tienda = ".$data['store']."")->row();
	}

	public function getRazonForNumStore($data){
		return $this->dbf->query("
						SELECT
							count(t2.id_tienda) as t,
							t2.rut
						FROM
							tiendas as t1
						LEFT JOIN tiendas as t2 on t2.rut = t1.rut
						WHERE
							t1.id_tienda = ".$data["store"].";
						;")->row();
	}

	public function getRazonForStore($data){

		if($this->session->userdata("stores_old") == '*'){
		return $this->dbf->query("SELECT
					t2.id_tienda,
					t2.nombre_tienda,
					t2.centro_costo,
					t2.rut,
					(select id_pedido from pedidos as ped where  ped.id_tienda = t2.id_tienda AND ped.estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15) AND ped.excepcion = 0 ORDER BY ped.id_pedido DESC LIMIT 1) as pedido_afectado,
					IF((select count(id_pedido) from pedidos as ped where  ped.id_tienda = t2.id_tienda AND ped.estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15) AND ped.excepcion = 0 ORDER BY ped.id_pedido DESC LIMIT 1) = 0, 'No puede Habilitar', 'Habilitar Cliente para realizar pedido') as estado,
					(select count(id_pedido) from pedidos as ped where  ped.id_tienda = t2.id_tienda AND ped.estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15) AND ped.excepcion = 0 ORDER BY ped.id_pedido DESC LIMIT 1) as counter,
					t4.nombres
				FROM
					tiendas as t1
				LEFT JOIN tiendas as t2 on t2.rut = t1.rut
				JOIN relacion_tiendas as t3 ON t3.id_tienda = t1.id_tienda 
				JOIN usuarios as t4 ON t4.id_usuario = t3.id_usuario and t4.llave = 7
				join pedidos as ped ON ped.id_tienda = t2.id_tienda AND ped.estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15) AND ped.excepcion = 0 
				WHERE
					t1.id_tienda = ".$data["store"]." and t2.id_tienda != ".$data["store"].";")->result();

		}
		else{
			return ["n"];
		}
	}


	public function freeStoreOrder($data){
		$query = $this->dbf->query("
					SELECT
						*
					FROM
						pedidos
					WHERE
						id_tienda = '".$data["store"]."'
					AND estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15)
					AND excepcion = 0
					ORDER BY
						id_pedido DESC LIMIT 1;
			")->row();

		if($query){

			$this->dbf->where("id_pedido" , $query->id_pedido)->update("pedidos", ["excepcion" => 1]);
			return ["msg" => "done" , "orders" => $query->id_pedido];
		}
		else{
			return ["msg" => "empty"];
		}
	}


	public function changeStateLote($data){
		for ($i=0; $i < count($data); $i++) {
			$query = $this->dbf->query("
					SELECT
						*
					FROM
						pedidos
					WHERE
						id_tienda = '".$data[$i]."'
					AND estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15)
					AND excepcion = 0
					ORDER BY
						id_pedido DESC LIMIT 1;
			")->row();
			if($query){
				$this->dbf->where("id_pedido" , $query->id_pedido)->update("pedidos", ["excepcion" => 1]);
			}
			else{
			}
		}
		return ["msg" => "done"];
	}

	public function getCenterCost(){
		return json_encode($this->dbf->query("SELECT
								centro_costo
							FROM
								tiendas
							WHERE
								centro_costo != 0
							GROUP BY
								centro_costo
							ORDER BY
								centro_costo ASC;")->result());
	}

	protected function dataStore($data){

		$ex = explode("-", trim($data["rut"]));



		return [
			"nombre_tienda"                 => ucwords(trim($data["nstore"])),
			"id_usuario"                    => 0,
			"id_franquicia"                 => self::createCodeStore($data["nstore"], $data["store"]),
			"costo_envio_ciudad"            => ($data["send"] >= 2) ? $data["costo_hiddden"] : "1",
			"troncal_ramal"                 => ($data["send"] >= 2) ? $data["ramal_hiddden"] : "" ,
			"costo_envio_stgo"              => ($data["send"] == 1 ) ? 25000 : 0 ,
			"rut"                           => $ex[0],
			"centro_costo"                  => (isset($data["other_cost"])) ? $data["other_cost"] : $data["ccost"],
			"precio_granel"                 => 5253,
			"habilitar_horario"             => (isset($data["horario"])) ? $data["horario"] : 0,
			"usuario_externo"               => (isset($data["userex"])) ? $data["userex"] : 0,
			"fecha_actualizacion_productos" => date("Y-m-d h:m:s"),
			"precio_venta_granel"           => 15000,
			"id_tipo"                       => 0,
			"bodega"                        => "001",
			"fecha_creacion"                => date("Y-m-d h:m:s"),
			"sube_softland"                 => 1,
			"activo"                        => 1
		];
	}

	protected function dataStoreNew($data){
		return [
			"_store"               => strtoupper(trim($data["nstore"])),
			"_cost_center"         => trim($data["ccost"]),
			"_idn"                 => trim($data["rut"]),
			"_refer"               => self::createCodeStore(trim($data["nstore"]), $data["store"]),
			"_region_id"           => $data["send"],
			"_last_update_product" => "0000-00-00 00:00:00",
			"_refer_old"           => self::createCodeStore(trim($data["nstore"]), $data["store"]),
		];
	}

	protected function dataStoreFileSoftland($data, $id_old, $id_store){
		$ex = explode("-", trim($data["rut"]));
		return [
			"_id_store"          => $id_store,
			"_id_store_old"      => $id_old,
			"_razon_social"      => ucwords(trim($data["nstore"])),
			"_razon_social_real" => trim($data["_razon_real"]),
			"_rut_short"         => $ex[0],
			"_rut_long "         => trim($data["rut"]),
			"_giro_id"           => trim($data["giro"]),
			"_pais_id"           => trim($data["pais"]),
			"_region_id"         => trim($data["region"]),
			"_ciudad_id"         => trim($data["ciudad"]),
			"_comuna_id"         => trim($data["comuna"]),
			"_dirdesp "          => trim($data["dirdesp"]),
			"_dirfact "          => trim($data["dirfact"]),
			"_emaildte"          => trim($data["emaildte"]),
			"_emailc"            => trim($data["emailcontacto"]),
			];
	}

	protected function saveCourier($data, $store_old, $store_new){

		$array = [
			"_type_courier" => $data['send'],
			"_city"         =>  (isset($data['_country_tnt'])) ? $data['_country_tnt'] : 0,
			"_country"      =>  (isset($data['_pueblo_tnt'])) ? $data['_pueblo_tnt'] : 0,
			"_id_costo"     =>  (isset($data['costo_hiddden'])) ? $data['costo_hiddden'] : 0,
			"_row"          =>  (isset($data['ramal_hiddden'])) ? $data['ramal_hiddden'] : 0
		];

		return [
			"_store_new_id "   => $store_new,
			"_store_old_new  " => $store_old,
			"_values"          => serialize($array)

		];
	}



	public function putStore($data){
		
		$response = json_decode($this->appOdbcModel->testConn());

		if(!$response->status){

			if($data["savesoft"] == "save"){

				$this->dbf->insert("tiendas", self::dataStore($data));
				$id_old = $this->dbf->insert_id();

				$this->db->insert("tbapp_stores", self::dataStoreNew($data));
				$id_new = $this->db->insert_id();

				$this->db->insert("tbapp_softland_file_and",self::dataStoreFileSoftland($data, $id_old,$id_new));
				$this->db->insert("tbapp_courier_store_configure", self::saveCourier($data, $id_old, $id_new));
				
				$name_file = 'IMPAUXILIAR-SOFTLAND-'.str_replace(["-"," "], "", $data["rut"]).'-'.date("Ymd").'.xls';
				$file = 'public/files/excel-import-auxiliar/IMPAUXILIAR_SOFTLAND_'.str_replace(["-"," "], "", $data["rut"]).'_'.date("Ymd").'.xls';
				$this->setExcel($data, $file);

				$files = [
					"name"   => $name_file,
					"type"   => "application/vnd.ms-excel",
					"origin" => $file,
					"store"  => $id_old
				];

				$this->appFileProcessModel->setFileBdStore($files);
				$this->appEmailsModel->mailSendFileNewStoreSoftlan($data, $file);

				return ["msgodbc" => "con-fail", "msgprocess" => "done"];
			}
			else{
				$this->dbf->insert("tiendas", self::dataStore($data));
				$id_old = $this->dbf->insert_id();
				$this->db->insert("tbapp_stores", self::dataStoreNew($data));
				$id_new = $this->db->insert_id();
				$this->db->insert("tbapp_courier_store_configure", self::saveCourier($data, $id_old, $id_new));
				return ["msgodbc" => "not-apply", "msgprocess" => "done"];
			}

			
		}
		else{

			if($data["savesoft"] == "save"){

				$this->dbf->insert("tiendas", self::dataStore($data));
				$id_old = $this->dbf->insert_id();

				$this->db->insert("tbapp_stores", self::dataStoreNew($data));
				$id_new = $this->db->insert_id();

				$this->db->insert("tbapp_softland_file_and",self::dataStoreFileSoftland($data, $id_old,$id_new));
				$this->db->insert("tbapp_courier_store_configure", self::saveCourier($data, $id_old, $id_new));

				$this->appEmailsModel->mailStoreSoftlanCreate($data);
				$this->appOdbcModel->createClient($data);

				return ["msgodbc" => "con-done", "msgprocess" => "done"];
			}
			else{
				$this->dbf->insert("tiendas", self::dataStore($data));
				$id_old = $this->dbf->insert_id();
				$this->db->insert("tbapp_stores", self::dataStoreNew($data));
				$id_new = $this->db->insert_id();
				$this->db->insert("tbapp_courier_store_configure", self::saveCourier($data, $id_old, $id_new));

				return ["msgodbc" => "not-apply", "msgprocess" => "done"];
			}
		}

	}

	public function setExcel($data, $file) {
         
   
        $this->phpexcel->getProperties()->setCreator("App Tamy SPA")
                                     ->setLastModifiedBy("App Tamy SPA")
                                     ->setTitle("Documento Para importar tienda a softlan")
                                     ->setSubject("Import de tienda ".ucwords($data["nstore"]))
                                     ->setDescription("Archivo autogenerado para la importacion de tienda a software softlan.")
                                     ->setKeywords("Tamy import openxml php")
                                     ->setCategory("Archivo de Importación");
         
        $ex = explode("-", trim($data["rut"]));
      
        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValueExplicit('A1', $ex[0], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('B1', strtoupper(trim($data["nstore"])) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('D1', trim($data["rut"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('F1', trim($data["giro"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G1', trim($data["pais"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('H1', trim($data["region"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I1', trim($data["ciudad"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J1', trim($data["comuna"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('K1', strtoupper(trim($data["dirfact"])), PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('S1','S', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('AF1',strtolower(trim($data["emailcontacto"])), PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('BE1',strtolower(trim($data["emaildte"])), PHPExcel_Cell_DataType::TYPE_STRING);
         

        // Renombramos la hoja de trabajo
        $this->phpexcel->getActiveSheet()->setTitle('IMPORT_SOFTLAND_STORE');
        $this->phpexcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel5');
        $objWriter->save($file);
    }


	protected function createCodeStore($nstore, $store){

		if ($store == "n") {

			return strrev(substr(str_replace([" ","_","-"], "", strtoupper($nstore)) ,4, 3)).date("Yms");

		} else if($store == "f"){

			$q = $this->dbf->query("
				SELECT (CAST(id_franquicia AS SIGNED) + 1) AS id_f
				FROM
					tiendas
				WHERE
					id_franquicia REGEXP '^[0-9]+$'
				ORDER BY
					CAST(id_franquicia AS SIGNED) DESC
				LIMIT 1;")->row();

			return $q->id_f;
		}
	}

	public function verifyUserKey($store){

		return $this->dbf->query("SELECT
								rtienda.*,
							us.usuario,
							us.nombres,
							COUNT(us.id_usuario) as t,
							(SELECT rut from tiendas where id_tienda = ".$store["id"].") as rut
							FROM
								relacion_tiendas as rtienda
							LEFT JOIN usuarios as us ON us.id_usuario = rtienda.id_usuario
							WHERE
								rtienda.id_tienda = ".$store["id"]."
							AND us.llave = 7;")->row();
	}

	public function verifyUser($username){
		return $this->dbf->get_where("usuarios", ["usuario" => $username])->row();
	}

	public function verifyEmail($email){
		return $this->dbf->get_where("correos", ["correo" => $email])->row();
	}

	protected function datauserStore($data){

		$names = explode(" ", $data['nombre']);
		return [
			"usuario"         => trim($data['user']),
			"pw"              => trim($data['pass']),
			"nombres"         => trim($data['nombre']),
			"ape_paterno"     => trim($names[1]),
			"ape_materno"     => trim($names[1]),
			"llave"           => trim($data['key']),
			"tienda_santiago" => ($data['ubicacion'] == "s") ? 1 : 0,
			"tienda_region"   => ($data['ubicacion'] == "r") ? 1 : 0,
			"usuario_externo" => (isset($data[''])) ? 1 : 0,
			"tipo_usuario"    => ($data['storetp'] == "vc") ?  1:  0,
			"fecha_creacion"  => date("Y-m-d h:m:s"),
			"activo"          => 1,
 		];
	}

	protected function dataRegisterNewUser($data)
	  {
	    return [
			"_nickname"               => strtolower(trim($data["user"])),
			"_mail"                   => strtolower(trim($data["email"])),
			"_key"                    => $this->appFunctionsModel->hashPassword(trim($data["pass"])),
			"_account_id"             => ($data['storetp'] == "vc") ? 12 : 7,
			"_store_id"               => $data["store_id"],
			"_country_id"             => 2,
			"_relacionship_store"     => serialize([$this->getIdStoreNew($data["store_id"])]),
			"_relacionship_store_old" => serialize([$data["store_id"]]),
	    ];
	  }

	  protected function dataRegisterOtherInfo($id)
	  {
	    return [
	      "_IDUser" => $id,
	      "_phone"  => "000-0000000"
	    ];
	  }

	public function putUserStore($data){


			$this->dbf->insert("usuarios", self::datauserStore($data));
			$id_new = $this->dbf->insert_id();

			$this->db->insert("tbapp_registeruser_app", self::dataRegisterNewUser($data));
		    $id = $this->db->insert_id();
		    $this->db->insert("tbapp_registeruser_app_other_info", self::dataRegisterOtherInfo($id));

			$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha registrado el usuario ".$data['user']." - ".$data['nombre']]);	
			

			$this->dbf->insert("relacion_tiendas", [
				"id_tienda"  => $data['store_id'],
				"id_usuario" => $id_new
				]);

			$query = $this->dbf->query("SELECT * from usuarios WHERE llave = 5;")->result();

			foreach ($query as $key => $value) {
				$this->dbf->insert("relacion_tiendas", [
				"id_tienda"  => $data['store_id'],
				"id_usuario" => $value->id_usuario
				]);
			}

			$names = explode(" ", trim($data['nombre']));

			$this->dbf->insert("correos", [
				"correo"                   => trim($data['email']),
				"nombre"                   => trim($names[0]),
				"apellido"                 => trim($names[1]),
				"genero"                   => (isset($data["sex"])) ? $data["sex"] : 0,
				"envio_facturas_ped"       => (isset($data["emfp"])) ? $data["emfp"] : 0,
				"envio_facturas_arriendos" => (isset($data["emfa"])) ? $data["emfa"] : 0,
				"envio_excel"              => (isset($data["emex"])) ? $data["emex"] : 0,
				"envio_ods"                => (isset($data["emods"])) ? $data["emods"] : 0,
				"envio_error"              => (isset($data["emerr"])) ? $data["emerr"] : 0,
				"envio_fact_faltantes"     => (isset($data["emff"])) ? $data["emff"] : 0,
				"envio_info_despacho"      => (isset($data["emid"])) ? $data["emid"] : 0,
				"activo"                   => 1
				]);

			$id_email = $this->dbf->insert_id();

			$this->dbf->insert("relacion_correos", [
				"id_tienda" => $data['store_id'],
				"id_correo" => $id_email
				]);

			$this->appEmailsModel->mailCreateStoreUser($data);

			return TRUE;
	
	}
	public function getIdStoreNew($store){

		$q = $this->dbf->query("
			SELECT id_franquicia from tiendas where id_tienda = ".$store.";
			")->row();
		if($q){
			$que = $this->db->query("SELECT id from tbapp_stores WHERE _refer_old = '".$q->id_franquicia."'")->row();
			return $que->id;
		}

	}

	public function getLastEmail(){
		$q = $this->dbf->query("SELECT
															(id_correo + 1) AS ultima_correo
														FROM
															correos
														ORDER BY
															id_correo DESC
														LIMIT 1;")->row();
		return $q->ultima_correo;
	}

	public function getLastUser(){
		$q = $this->dbf->query("SELECT (id_usuario + 1) as ultima_usuario from usuarios ORDER BY id_usuario desc LIMIT 1;")->row();
		return $q->ultima_usuario;
	}

	public function rewriteUser($id, $store, $user_old){
		$this->dbf->where(["id_tienda" => $store, "id_usuario" => $user_old])->update("relacion_tiendas", ["id_usuario" => $id]);
	}

	public function getLastStore(){

		$q = $this->dbf->query("SELECT (id_tienda + 1) as ultima_tienda from tiendas ORDER BY id_tienda desc LIMIT 1;")->row();
		return $q->ultima_tienda;

	}


	/*
	|
	| lista de productos
	|
	|
	|*/

	public function getStoreFreeProducts(){
		return json_encode($this->dbf->get_where("tiendas",["charge_product" => "N"])->result(), JSON_FORCE_OBJECT);
	}

	public function getStorewidthProducts(){
		return json_encode($this->dbf->get_where("tiendas",["charge_product" => "Y"])->result(), JSON_FORCE_OBJECT);
	}

	public function getStoreActive(){
		if($this->session->userdata("stores_old") == '*'){
		return json_encode($this->dbf->query("SELECT * from tiendas where id_tienda;")->result(), JSON_FORCE_OBJECT);
		}
		else{
			return json_encode($this->dbf->query("SELECT * from tiendas where id_tienda in (".$this->session->userdata("stores_old").");")->result(), JSON_FORCE_OBJECT);
		}
	}

	public function getUserActive(){
		return json_encode($this->dbf->get_where("usuarios",["activo" => "1", "llave" => 7])->result(), JSON_FORCE_OBJECT);
	}

	public function getAnalisisListProducts($data){
		return $this->dbf->query("
			SELECT
			COUNT(codigo) AS tp,
			(
				SELECT
					count(activo)
				FROM
					lista_productos
				WHERE
					activo = 1
				AND id_tienda = ".$data['id']."
			) AS tac,
			(
				SELECT
					count(activo)
				FROM
					lista_productos
				WHERE
					activo = 0
				AND id_tienda = ".$data['id']."
			) AS tinac
		FROM
			lista_productos
		WHERE
			id_tienda = ".$data['id'].";
			")->row();
	}

	public function getListProductsStore($data){
		return $this->dbf->query("
			SELECT
				lp.*, p.ean_caja,
				p.ean_empaque,
				p.ean,
				p.nombre,
				p.grupo,
				grp.grupo as ngrupo,
				p.subgrupo,
				sgrp.sub_grupo
			FROM
				lista_productos AS lp
			LEFT JOIN productos AS p ON p.codigo = lp.codigo
			LEFT JOIN grupo AS grp ON grp.id_grupo = p.grupo
			LEFT JOIN sub_grupo sgrp ON sgrp.numero_sub_grupo = p.subgrupo
			WHERE
				lp.id_tienda = ".$data['id'].";
			")->result();
	}

	public function processChargeList($data){

	
			$query = $this->dbf->query("
						SELECT
							*
						FROM
							lista_productos
						WHERE
							id_tienda = ".$data['store_id_3'].";
			")->result();

			foreach ($query as $key => $values) {

				$query2 = $this->dbf->where(["id_tienda" => $data['store_id_4'], "codigo" => $values->codigo])->get("lista_productos")->row();

				if($query2){

					$this->dbf->where(["id_tienda" => $data['store_id_4'], "codigo" => $values->codigo])->update("lista_productos", [
						"precio_franquiciado" => $values->precio_franquiciado,
						]);
				}
				else{
					$this->dbf->insert("lista_productos", [
						"codigo"              => $values->codigo,
						"precio_franquiciado" => $values->precio_franquiciado,
						"id_tienda"           => $data['store_id_4'],
						"activo"              => $values->activo,
						]);
				}
			}

			return ["msg" => TRUE];
	}

	public function inPriceStore($data){
		$q = $this->dbf->query("SELECT * from lista_productos where id_tienda = ".$data['tienda']." AND codigo = '".$data['code']."';")->row();
		if ($q) {
			return ["msg" => "exist"];
		} else {
			$this->dbf->insert("lista_productos",["codigo" => $data['code'], " 	precio_franquiciado" => $data['precio'], "id_tienda" => $data['tienda'], "activo" => "1"]);

			$this->dbf->where(["id_tienda" => $data['tienda']])->update("tiendas", ["charge_product" => "Y"]);

			$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha incluido el producto ".$data['code'].", con precio ".$data['precio']." a la tienda ".$data['tienda']." con observacion ".strtoupper($data['obj'])]);

			return ["msg" => TRUE];
		}
		
	}

	public function upPriceStore($data){
		
			$this->dbf->where(["id_tienda" => $data['tienda'], "codigo" => $data['code']])->update("lista_productos",["precio_franquiciado" => $data['precio']]);

			
			$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha incluido el producto ".$data['code'].", con precio ".$data['precio']." a la tienda ".$data['tienda']." con observacion ".strtoupper($data['obj'])]);

			return ["msg" => TRUE];

		
	}

	public function deleteProd($data){
		 $this->dbf->where(["id_tienda" => $data["store"] , "codigo" => $data["prod"]])->update("lista_productos",["activo" => ($data["activo"] == 1) ? 0 : 1]);

		 return ["msg" => ($data["activo"] == 1) ? "i" : "a"];
	}

		public function readExcelListProduct($files, $id_store){

			$archivo       = $files;
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			$inputFileType = PHPExcel_IOFactory::identify($archivo);
			$objReader     = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel   = $objReader->load($archivo);
			$sheet         = $objPHPExcel->getSheet(0); 
			$highestRow    = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();

			$file_uri = "public/files/response/".sha1(date("Ymdhms")).".txt";
			$file = fopen($file_uri, "a");

			for ($row = 1; $row <= $highestRow; $row++){ 
				
				if(is_numeric($sheet->getCell("B".$row)->getValue())){

					$que = $this->dbf->where(["codigo" => $sheet->getCell("A".$row)->getValue()])->get("productos")->row();

					if($que){

						$que2 = $this->dbf->where(["codigo" => $sheet->getCell("A".$row)->getValue(), "id_tienda" => $id_store])->get("lista_productos")->row();

						if ($que2) {

							$this->dbf->where(["codigo" => $sheet->getCell("A".$row)->getValue(), "id_tienda" => $id_store])->update("lista_productos", [
									"codigo"              => $sheet->getCell("A".$row)->getValue(),
									"precio_franquiciado" => $sheet->getCell("B".$row)->getValue(),
									"id_tienda"           => $id_store,
									"activo"              => $sheet->getCell("C".$row)->getValue()
									]);


							fwrite($file, $sheet->getCell("A".$row)->getValue()."\t-YA EXISTE EN LA LISTA DE PRODUCTOS DE LA TIENDA PERO FUE ACTUALIZADO\r\n");

						} else {

							$this->dbf->insert("lista_productos", [
									"codigo"              => $sheet->getCell("A".$row)->getValue(),
									"precio_franquiciado" => $sheet->getCell("B".$row)->getValue(),
									"id_tienda"           => $id_store,
									"activo"              => $sheet->getCell("C".$row)->getValue()
									]);

						fwrite($file, $sheet->getCell("A".$row)->getValue()."\t-INCLUIDO EN LA LISTA DE PRODUCTOS DE LA TIENDA\r\n");
						
						}
					}
					else{
						fwrite($file, $sheet->getCell("A".$row)->getValue()."\t-NO EXISTE EN LA TABLA PRODUCTOS\r\n");
					}
				}
				else{			
					fwrite($file, $sheet->getCell("A".$row)->getValue()."\t-POSEE ERROR DE TIPO DATO EN PRECIO\r\n");	
				}
			}$this->dbf->where(["id_tienda" => $id_store])->update("tiendas", ["charge_product" => "Y"]);
			return ["msg" => "done", "file" => base_url().$file_uri];
		}



		public function processChangeUser($data){

			$ex = explode(":", $data["rewrite"]);

			if($ex[1] == "new"){

				$this->dbf->insert("relacion_tiendas",["id_tienda" => $data["store_id_rel1"], "id_usuario" => $data["user_id_rel1"]]);
				$query = $this->dbf->query("SELECT * from usuarios WHERE llave = 5;")->result();

				foreach ($query as $key => $value) {
					$this->dbf->insert("relacion_tiendas", [
					"id_tienda"  => $data["store_id_rel1"],
					"id_usuario" => $value->id_usuario
					]);
				}

				$em = $this->dbf->query("
					SELECT
					t.usuario,t.nombres, co.correo from 
					usuarios as t 
					JOIN relacion_tiendas as rl on rl.id_usuario =t.id_usuario 
					JOIN relacion_correos as cr on cr.id_tienda = rl.id_tienda 
					JOIN correos as co ON co.id_correo = cr.id_correo
					where t.id_usuario= ".$data["user_id_rel1"].";
					")->row();

				$ti = $this->dbf->query("SELECT nombre_tienda, rut from tiendas WHERE id_tienda = ".$data["store_id_rel1"].";")->row();

				$this->appEmailsModel->mailRelationsStoreUser($em->correo, $em->nombres, $ti->nombre_tienda, $ti->rut);

				return ["msg" => "done"];
			}
			else{
				if($this->dbf->where(["id_tienda" => $data["store_id_rel1"], "id_usuario" => $data["user_id_rel1"]])->get("relacion_tiendas")->row()){
					return ["msg" => "exist"];
				}
				else{

					$this->dbf->where(["id_tienda" => $data["store_id_rel1"], "id_usuario" => $ex[1]])->update("relacion_tiendas",[
						"id_usuario" => $data["user_id_rel1"]
						]);

					$em = $this->dbf->query("
					SELECT
					t.usuario,t.nombres, co.correo from 
					usuarios as t 
					JOIN relacion_tiendas as rl on rl.id_usuario =t.id_usuario 
					JOIN relacion_correos as cr on cr.id_tienda = rl.id_tienda 
					JOIN correos as co ON co.id_correo = cr.id_correo
					where t.id_usuario= ".$data["user_id_rel1"].";
					")->row();

					$ti = $this->dbf->query("SELECT nombre_tienda, rut from tiendas WHERE id_tienda = ".$data["store_id_rel1"].";")->row();

					$this->appEmailsModel->mailRelationsStoreUser($em->correo, $em->nombres, $ti->nombre_tienda, $ti->rut);
					return ["msg" => "done"];
				}
			}
		}



		public function verifyRut($data){
			if($this->appFunctionsModel->verificadorRut($data["rut"])){
				$exrut = explode("-", $data["rut"]);
				if($this->dbf->get_where("tiendas", ["rut" => $exrut[0]])->row()){
					return ["msg" => "notin"];
				}
				else{
					return ["msg" => "in"];
				}
			}
			else{
				return ["msg" => "badrut"];
			}
		}

		public function getListStoreTimes(){
			if($this->session->userdata("stores_old") == '*'){
			return $this->dbf->query("SELECT
							t.id_tienda,
							t.nombre_tienda,
							t.rut,
							t.centro_costo,
							t.habilitar_horario,
						IF (
							t.habilitar_horario = 0,
							'Deshabilitado',
							'Habilitado'
						) AS tipo_horario,
						u.usuario,
						u.nombres
						FROM
							tiendas as t
						JOIN relacion_tiendas as rl on rl.id_tienda = t.id_tienda 
						JOIN usuarios as u on u.id_usuario = rl.id_usuario AND u.llave = 7
						WHERE
							t.centro_costo != '06-001'
						OR t.centro_costo != '05-002';")->result();

			}
			else{
				return $this->dbf->query("SELECT
							t.id_tienda,
							t.nombre_tienda,
							t.rut,
							t.centro_costo,
							t.habilitar_horario,
						IF (
							t.habilitar_horario = 0,
							'Deshabilitado',
							'Habilitado'
						) AS tipo_horario,
						u.usuario,
						u.nombres
						FROM
							tiendas as t
						JOIN relacion_tiendas as rl on rl.id_tienda = t.id_tienda 
						JOIN usuarios as u on u.id_usuario = rl.id_usuario AND u.llave = 7
						WHERE
						t.id_tienda in (".$this->session->userdata("stores_old").")
							")->result();
			}

		}

		public function changeStateTime($data){

			$query = $this->dbf->where(["id_tienda" => $data['id']])->get("tiendas")->row();

			if($query){
				if ($query->habilitar_horario == 0) {
					$this->dbf->where(["id_tienda" => $data['id']])->update("tiendas", ["habilitar_horario" => 1]);
					return ["msg" => "hab"];
				} else {
					$this->dbf->where(["id_tienda" => $data['id']])->update("tiendas", ["habilitar_horario" => 0]);
					return ["msg" => "dhab"];
				}
			}
			else{
				return ["msg" => "no-exist"];
			}

		}

		/*
		|
		|
		| ajustar despacho
		|
		|
		|*/


		public function getCostOrder($data){
			return $this->dbf->query("
				SELECT
					neto,
					subtotal,
					total_pedido,
					iva,
					deuda,
					(
						SELECT
							total_linea
						FROM
							lineas_pedido
						WHERE
							id_pedido = ".$data["order"]."
						AND cod_producto = 'TR001'
					) as total_despacho
				FROM
					pedidos
				WHERE
					id_pedido = ".$data["order"].";
				")->row();
		}

		public function saveCostOrder($data){

			 $this->dbf->where(["id_pedido" => $data["nordenf"]])->update("pedidos",[
					"neto"                => $data["neto_orden"],
					"subtotal"            => $data["sub_orden"],
					"total_pedido"        => $data["total_orden"],
					"iva"                 => $data["iva_orden"],
					"deuda"               => $data["total_orden"],
					"total_base_gravable" => $data["sub_orden"]
			 	]);

			 $this->dbf->where(["id_pedido" => $data["nordenf"], "cod_producto" => "TR001"])->update("lineas_pedido",[
			 	"total_linea" => $data["transport"]]);

			 $this->db->insert("tbapp_history_cost_order", [
					"_order_id"      => $data["nordenf"],
					"_total"         => $data["total_orden"],
					"_neto"          => $data["neto_orden"],
					"_iva"           => $data["iva_orden"],
					"_transport"     => $data["transport"],
					"_disco"         => $data["descuento"],
					"_total_org"     => $data["total_orden1"],
					"_neto_org"      => $data["neto_orden1"],
					"_iva_org"       => $data["iva_orden1"],
					"_transport_org" => $data["transport1"],
			 	]);

			 return ["response" => true];
		}
}