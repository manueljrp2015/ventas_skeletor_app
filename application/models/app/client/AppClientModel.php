<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppClientModel extends CI_Model {


	private $table_settings = "tbapp_store_payment_conditions";
	private $table_Store = "tbapp_stores";
	private $table_Store_config = "tbapp_store_config";
	private $table_file_sofland_temp = "tbapp_softland_file_and";
	private $table_courier_store_configure = "tbapp_courier_store_configure";

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			"app/functions/appFunctionsModel",
			"app/files/appFileProcessModel",
			]);
	}


	public function getStores(){
		return $this->db->get($this->table_Store)->result();
	}

	public function getStoreId($id){
		return $this->db->where(["id" => $id])->get($this->table_Store)->row();
	}

	protected function dataUpdateStore($data){
		return [
			"_store"       => $data["_store_2"],
			"_idn"         => $data["_rut_2"],
			"_email"       => $data["_email_2"],
			"_phone"       => $data["_phone_2"]
		];
	}

	public function updateStore($data){
		return $this->db->where(["id" => $data["id_2"]])->update($this->table_Store, self::dataUpdateStore($data));
	}

	public function getGiroRelationship($data){
		return $this->db->get_where("tbapp_softland_cwtgiro",["codigo_giro_sii" => $data['giro']])->row();
	}

	protected function dataClient($data){
		return [
			"_store"     => strtoupper($data["_name"]),
			"_idn"       => $data["_rut"],
			"_refer"     => strtoupper(random_string('alnum', 16)),
			"_email"     => $data["_email"],
			"_region_id" => $data["_region_c"],
			"_phone"     => str_replace([" ","-"], "", $data["_phone"]),
			"_sii"       => ($data["_band"] == "X") ? "SI" : "NO",
			"_invoice"   => ($data["_band"] == "X") ? 1 : 0,
			"_dir"       => $data["_dir"]
		];
	}


	protected function dataClientUpdate($data){
		return [
			"_store"     => strtoupper($data["_name"]),
			"_idn"       => $data["_rut"],
			"_email"     => $data["_email"],
			"_region_id" => $data["_region_c"],
			"_phone"     => str_replace([" ","-"], "", $data["_phone"]),
			"_dir"       => $data["_dir"]
		];
	}


	protected function dataPayment($data, $id_client){
		return [
			"_credit"      => $data["_credit"],
			"_balance"     => $data["_credit"],
			"_consumption" => 0,
			"_paying_to"   => $data["_form_pay"],
			"_type_pay"    => $data["_type_pay"],
			"_store_id"    => $id_client,
		];
	}

	protected function dataStoreFileSoftland($data, $id_client){
		$ex = explode("-", trim($data["_rut"]));
		return [
			"_id_store"          => $id_client,
			"_id_store_old"      => 999999,
			"_razon_social"      => strtoupper(trim($data["_name"])),
			"_razon_social_real" => ($data["_razon_real"] != null) ? trim($data["_razon_real"]) : null,
			"_rut_short"         => $ex[0],
			"_rut_long "         => trim($data["_rut"]), 
			"_giro_id"           => (isset($data["giro"])) ? trim($data["giro"]) : null,
			"_pais_id"           => (isset($data["pais"])) ? trim($data["pais"]) : null,
			"_region_id"         => (isset($data["region"])) ? trim($data["region"]) : null,
			"_ciudad_id"         => (isset($data["ciudad"])) ? trim($data["ciudad"]) : null,
			"_comuna_id"         => (isset($data["comuna"])) ? trim($data["comuna"]) : null,
			"_dirdesp "          => trim(strtoupper($data["dirdesp"])),
			"_dirfact "          => (trim($data["dirfact"]) != null) ? trim(strtoupper($data["dirfact"])) : null,
			"_emaildte"          => trim($data["_email"]),
			"_emailc"            => trim($data["_email"]),
			];
	}

	protected function dataConfigClient($data, $id_client){
				return [
				"_store_id"       => $id_client,
				"_values"         => serialize([
				"_minbuy" => 0, "_maxbuy" => 0, "_daybuy" => 0,"_frequency" => "fija"
				]),
				"_minbuy"         => 0,
				"_maxbuy"         => 0,
				"_daybuy"         => 0,
				"_frequency"      => "fija",
				"_courier_factor" => $data["_factor"]
				];
	}

	protected function saveCourier($data, $id_client){

		$array = [
			"_type_courier" => $data['send'],
			"_city"         =>  (isset($data['_country_tnt'])) ? $data['_country_tnt'] : 0,
			"_country"      =>  (isset($data['_pueblo_tnt'])) ? $data['_pueblo_tnt'] : 0,
			"_id_costo"     =>  (isset($data['costo_hiddden'])) ? $data['costo_hiddden'] : 0,
			"_row"          =>  (isset($data['ramal_hiddden'])) ? $data['ramal_hiddden'] : 0
		];

		return [
			"_store_new_id "   => $id_client,
			"_store_old_new  " => 999999,
			"_values"          => serialize($array)

		];
	}

	public function putStore($data){
	

		$response = json_decode($this->appOdbcModel->testConn());
		if(!$response->status){
		$this->db->insert($this->table_Store, self::dataClient($data));
		$id_client = $this->db->insert_id();
		$this->db->insert($this->table_settings, self::dataPayment($data, $id_client));
		$this->db->insert($this->table_file_sofland_temp, self::dataStoreFileSoftland($data, $id_client));
		$this->db->insert($this->table_Store_config, self::dataConfigClient($data, $id_client));
		$this->db->insert($this->table_courier_store_configure, self::saveCourier($data, $id_client));

		$name_file = 'IMPAUXILIAR-SOFTLAND-'.str_replace(["-"," "], "", $data["_rut"]).'-'.date("Ymd").'.xls';
		$file = 'public/files/excel-import-auxiliar/IMPAUXILIAR_SOFTLAND_'.str_replace(["-"," "], "", $data["_rut"]).'_'.date("Ymd").'.xls';
				$this->setExcel($data, $file);

		$files = [
					"name"   => $name_file,
					"type"   => "application/vnd.ms-excel",
					"origin" => $file,
					"store"  => $id_old
				];
			$this->appFileProcessModel->setFileBdStore($files);
			$this->appEmailsModel->mailSendFileNewStoreSoftlan($data, $file);
			$this->appEmailsModel->mailStoreCreate($data);
			return ["msgodbc" => "con-fail", "msgprocess" => "done"];
		}
		else{
			$this->db->insert($this->table_Store, self::dataClient($data));
			$id_client = $this->db->insert_id();
			$this->db->insert($this->table_settings, self::dataPayment($data, $id_client));
			$this->db->insert($this->table_file_sofland_temp, self::dataStoreFileSoftland($data, $id_client));
			$this->db->insert($this->table_Store_config, self::dataConfigClient($data, $id_client));
			$this->db->insert($this->table_courier_store_configure, self::saveCourier($data, $id_client));
			$res = $this->appOdbcModel->createClient($data);
			$this->appEmailsModel->mailStoreSoftlanCreate($data);
			$this->appEmailsModel->mailStoreCreate($data);
			return ["msgodbc" => "con-done", "msgprocess" => "done"];

		}
	}

	public function updateStoreComplete($data){

		$response = json_decode($this->appOdbcModel->testConn());
		if(!$response->status){
			/*salva la tabla tiendas*/
					$this->db->where(["id" => $data["id"]])->update($this->table_Store, self::dataClientUpdate($data));
				/*salva la tabla softland*/
				$q1 = $this->db->where(["_id_store" => $data["id"]])->get($this->table_file_sofland_temp)->row();
				if ($q1) {
					$this->db->where(["_id_store"=> $data["id"]])->update($this->table_file_sofland_temp, self::dataStoreFileSoftland($data, $data["id"]));
				} else {
					$this->db->insert($this->table_file_sofland_temp, self::dataStoreFileSoftland($data, $data["id"]));
				}
				/*salva la tabla configuracion*/
				$q2 = $this->db->where(["_store_id" => $data["id"]])->get($this->table_Store_config)->row();
				if ($q2) {
					$this->db->where(["_store_id" => $data["id"]])->update($this->table_Store_config, self::dataConfigClient($data, $data["id"]));
				} else {
					$this->db->insert($this->table_Store_config, self::dataConfigClient($data, $data["id"]));
				}
				/*salva la tabla envio*/
				$q3 = $this->db->where(["_store_new_id" => $data["id"]])->get($this->table_courier_store_configure)->row();
				if ($q3) {
					$this->db->where(["_store_new_id" => $data["id"]])->update($this->table_courier_store_configure, self::saveCourier($data, $data["id"]));
				} else {
					$this->db->insert($this->table_courier_store_configure, self::saveCourier($data, $data["id"]));
				}
				return ["msgodbc" => "con-fail", "msgprocess" => "done-update"];
		}
		else{
			/*salva la tabla tiendas*/
				$this->db->where(["id" => $data["id"]])->update($this->table_Store, self::dataClientUpdate($data));
				/*salva la tabla softland*/
				$q1 = $this->db->where(["_id_store" => $data["id"]])->get($this->table_file_sofland_temp)->row();
				if ($q1) {
					$this->db->where(["_id_store"=> $data["id"]])->update($this->table_file_sofland_temp, self::dataStoreFileSoftland($data, $data["id"]));
				} else {
					$this->db->insert($this->table_file_sofland_temp, self::dataStoreFileSoftland($data, $data["id"]));
				}
				/*salva la tabla configuracion*/
				$q2 = $this->db->where(["_store_id" => $data["id"]])->get($this->table_Store_config)->row();
				if ($q2) {
					$this->db->where(["_store_id" => $data["id"]])->update($this->table_Store_config, self::dataConfigClient($data, $data["id"]));
				} else {
					$this->db->insert($this->table_Store_config, self::dataConfigClient($data, $data["id"]));
				}
				/*salva la tabla envio*/
				$q3 = $this->db->where(["_store_new_id" => $data["id"]])->get($this->table_courier_store_configure)->row();
				if ($q3) {
					$this->db->where(["_store_new_id" => $data["id"]])->update($this->table_courier_store_configure, self::saveCourier($data, $data["id"]));
				} else {
					$this->db->insert($this->table_courier_store_configure, self::saveCourier($data, $data["id"]));
				}
				$res = $this->appOdbcModel->updateClient($data);
				return ["msgodbc" => "con-done", "msgprocess" => "done-update", "odbc-response" => $res];
		}

		
	}

	public function setExcelCreateClient($data, $file) {
         
   
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
                    ->setCellValueExplicit('B1', strtoupper(trim($data["_name"])) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('D1', trim($data["_rut"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('F1', trim($data["giro"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G1', trim($data["pais"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('H1', trim($data["region"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I1', trim($data["ciudad"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J1', trim($data["comuna"]) , PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('K1', strtoupper(trim($data["dirfact"])), PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('S1','S', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('AF1',strtolower(trim($data["_email_email"])), PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('BE1',strtolower(trim($data["_email"])), PHPExcel_Cell_DataType::TYPE_STRING);
         

        // Renombramos la hoja de trabajo
        $this->phpexcel->getActiveSheet()->setTitle('IMPORT_SOFTLAND_STORE');
        $this->phpexcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel5');
        $objWriter->save($file);
    }

    public function getClientUpdate($id_client){
    	return $this->db->query("
    		SELECT
				st.*, stco._courier_factor,
				stco._daybuy,
				stco._frequency,
				stco._maxbuy,
				stco._minbuy,
				stpay._credit,
				stpay._paying_to,
				stpay._type_pay,
				stsoft._razon_social,
				stsoft._razon_social_real,
				stsoft._rut_long,
				stsoft._giro_id,
				stsoft._pais_id,
				stsoft._region_id AS region,
				stsoft._ciudad_id,
				stsoft._comuna_id,
				stsoft._dirdesp,
				stsoft._dirfact,
				stsoft._emailc,
				stsoft._emaildte,
				stcou._values,
				region.Descripcion,
				ciudad.CiuDes,
				comun.ComDes,
				pais.PaiDes, 
				giro.GirDes
			FROM
				tbapp_stores AS st
			LEFT JOIN tbapp_store_config AS stco ON stco._store_id = st.id
			LEFT JOIN tbapp_store_payment_conditions AS stpay ON stpay._store_id = st.id
			LEFT JOIN tbapp_softland_file_and AS stsoft ON stsoft._id_store = st.id
			LEFT JOIN tbapp_courier_store_configure AS stcou ON stcou._store_new_id = st.id
			LEFT JOIN tbapp_softland_cwtregion as region on region.id_Region = st._region_id
			LEFT JOIN tbapp_softland_cwtciud as ciudad on ciudad.CiuCod = stsoft._ciudad_id
			LEFT JOIN tbapp_softland_cwtcomu as comun on comun.ComCod = stsoft._comuna_id
			LEFT JOIN tbapp_softland_cwtpais as pais on pais.PaiCod = stsoft._pais_id
			LEFT JOIN tbapp_softland_cwtgiro as giro on giro.GirCod = stsoft._giro_id
				WHERE
					st.id = ".$id_client.";

    		")->row();
    }


	

}

/* End of file AppClientModel.php */
/* Location: ./application/models/app/client/AppClientModel.php */