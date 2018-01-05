<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppPricesNewModel extends CI_Model {

	private $tbproduc    = "tbapp_products";
	private $tbproducstr = "tbapp_products_store";
	private $pricetime   = "tbapp_products_price_timeline";

		public function updatePrices($data){

			if($data["col"] == 0){
				return $this->db->where(["id" => $data["idp1"]])->update($this->tbproduc,["_price_a" => $data["price"]]);
			}
			else if($data["col"] == 1){
				return $this->db->where(["id" => $data["idp1"]])->update($this->tbproduc,["_price_b" => $data["price"]]);
			}
			else if($data["col"] == 2){
				return $this->db->where(["id" => $data["idp1"]])->update($this->tbproduc,["_price_c" => $data["price"]]);
			}
			else if($data["col"] == 3){
				return $this->db->where(["id" => $data["idp1"]])->update($this->tbproduc,["_price_d" => $data["price"]]);
			}
		
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
				
				if(is_numeric($sheet->getCell("C".$row)->getValue())){

					$que = $this->db->where(["id" => $sheet->getCell("A".$row)->getValue()])->get("tbapp_products")->row();

					if($que){

						$explode = explode(",", $id_store);

						for($i=0; $i<count($explode); $i++){

						$que2 = $this->db->where(["_producto_id" => $que->id, "_store_id" => $explode[$i]])->get("tbapp_products_store")->row();

						if ($que2) {

							$this->db->where(["_producto_id" => $que->id, "_store_id" => $explode[$i]])->update("tbapp_products_store", [
									"_price"          => $sheet->getCell("C".$row)->getValue(),
									"_discount"       => $sheet->getCell("D".$row)->getValue(),
									"_percentage"     => $sheet->getCell("E".$row)->getValue(),
									"_status_product" => strtolower($sheet->getCell("F".$row)->getValue()),
									]);


							fwrite($file, $sheet->getCell("B".$row)->getValue()."\t\t-PRODUCTO ACTUALIZADO\r\n");

						} else {

							$this->db->insert("tbapp_products_store", [
									"_producto_id"    => $que->id,
									"_store_id"       => $explode[$i],
									"_price"          => $sheet->getCell("C".$row)->getValue(),
									"_discount"       => $sheet->getCell("D".$row)->getValue(),
									"_percentage"     => $sheet->getCell("E".$row)->getValue(),
									"_status_product" => strtolower($sheet->getCell("F".$row)->getValue())
									]);

						fwrite($file, $sheet->getCell("B".$row)->getValue()."\t-PRODUCTO INCLUIDO A CLIENTE\r\n");
						
						}
					}
					}
					else{
						fwrite($file, $sheet->getCell("B".$row)->getValue()."\t\t-PRODUCTO NO EXISTENTE\r\n");
					}
				}
				else{			
					fwrite($file, $sheet->getCell("B".$row)->getValue()."\t\t-POSEE ERROR DE TIPO DATO EN PRECIO\r\n");	
				}
			}
			return ["msg" => "done", "file" => base_url().$file_uri];
		}


		public function getPricesForClient($data){
			return $this->db->query("
				SELECT
					store.*, prod._product,
					prod._sku,
					prod.id as idproduc,
					st._store,
					line._line as linea
				FROM
					tbapp_products_store AS store
				LEFT JOIN tbapp_products AS prod ON prod.id = store._producto_id
				LEFT JOIN tbapp_stores AS st ON st.id = store._store_id
				LEFT JOIN tbapp_products_line AS line ON line.id = prod._line
				WHERE
					store._store_id IN (".$data["client"].")
				")->result();
		}


		public function updatePriceClient($data){

			if($data["column"] == 0){
					if((int)$data["price"] == 0 || (int)$data["price"] == 0.00){
						return $this->db->where(["id" => $data["id"]])->update($this->tbproducstr, [
							"_status_product" => 'i',
							"_price"          => (int)$data["price"]
						]);
					}
					else{
						$this->saveTimelinePrices($data);
						return $this->db->where(["id" => $data["id"]])->update($this->tbproducstr, [
							"_price" => (int)$data["price"]
						]);
					}
				}
				elseif($data["column"] == 1){
					if((int)$data["price"] == 0 || (int)$data["price"] == 0.00){
						return $this->db->where(["id" => $data["id"]])->update($this->tbproducstr, [
							"_percentage" => 0,
							"_discount"   => (int)$data["price"]
						]);
					}
					else{
						$this->saveTimelinePrices($data);
						return $this->db->where(["id" => $data["id"]])->update($this->tbproducstr, [
							"_discount" => (int)$data["price"]
						]);
					}

				}
				else{
					if((int)$data["price"] == 0 || (int)$data["price"] == 0.00){
						return $this->db->where(["id" => $data["id"]])->update($this->tbproducstr, [
							"_discount" => 0,
							"_percentage" => (int)$data["price"]
						]);
					}
					else{
						$this->saveTimelinePrices($data);
						return $this->db->where(["id" => $data["id"]])->update($this->tbproducstr, [
							"_percentage" => (int)$data["price"]
						]);
					}
				}	
		}

		public function saveTimelinePrices($data){
			if((int)$data["price_old"] == (int)$data["price"]){
				return false;
			}
			else{
				return $this->db->insert($this->pricetime, [
				"_product_id" => $data["product"],
				"_store_id"   => $data["store"],
				"_price_old"  => (int)$data["price_old"],
				"_price_new"  => (int)$data["price"],
				"_percent"    => ($data["percent"] == 0) ? 0 : $data["price"],
				"_user"       => $this->session->userdata("id"),
			]);
			}
		}

		public function transferPrices($data){

			$explode = explode(",", $data["client"]);

			$ii = 0;
			$j = 0;

			for ($i=0; $i < count($explode); $i++) { 

				$q = $this->db->where(["id" => $data["id"]])->get($this->tbproducstr)->row();
				if($q){
					$q2 = $this->db->where(["_producto_id" => $q->_producto_id, "_store_id" => $explode[$i]])->get($this->tbproducstr)->row();
					if ($q2) {
						$this->db->where(["_producto_id" => $q->_producto_id, "_store_id" => $explode[$i]])->update($this->tbproducstr,[
							"_price" => $q->_price
						]);
						$ii++;

					} else {
						$this->db->insert($this->tbproducstr,[
							"_price"       => $q->_price,
							"_discount"    => 0,
							"_percentage"  => 0,
							"_producto_id" => $q->_producto_id,
							"_store_id"    => $explode[$i]
						]);
						$j++;	

						}			
				}
				else{
				}
			}
			return ["res" => "Actualizados: ".$ii.", Insertados: ".$j.""];
		}


		public function transferPricesMultiple($data){

			$explode = explode(",", $data["product"]);

			$ii = 0;
			$j = 0;

			for ($i=0; $i < count($explode); $i++) { 
				$que = $this->db->where(["_producto_id" => $explode[$i], "_store_id" => $data["origen"]])->get($this->tbproducstr)->row();
				if ($que) {
					$que2 = $this->db->where(["_producto_id" => $explode[$i], "_store_id" => $data["destino"]])->get($this->tbproducstr)->row();
					if ($que2) {
						$this->db->where(["_producto_id" => $explode[$i], "_store_id" => $data["destino"]])->update($this->tbproducstr, [
							"_price" => $que->_price
						]);

						$datos = [
							"product"   => $explode[$i],
							"store"     => $data["destino"],
							"price_old" => $que2->_price,
							"price"     => $que->_price,
							"percent"   => 0
						];
						$this->saveTimelinePrices($datos);
						$ii++;
					} else {
						$this->db->insert($this->tbproducstr, [
							"_price"       => $que->_price,
							"_discount"    => 0,
							"_percentage"  => 0,
							"_producto_id" => $explode[$i],
							"_store_id"    => $data["destino"]
						]);
						$j++;
					}
					
				} else {
					return false;
				}
			}
			return ["res" => "Actualizados: ".$ii.", Insertados: ".$j.""];
		}

		public function getListPrice($data, $client){
			if ($data["product"] == "*") {
				return $this->db->query("
												SELECT
													p.*,
												prod._product,
												prod._sku,
												l._line as linea
												FROM
													tbapp_products_store AS p
												LEFT JOIN tbapp_products as prod ON prod.id = p._producto_id
												LEFT JOIN tbapp_products_line AS l ON l.id = prod._line
												WHERE
													p._store_id = ".$client.";

					")->result();
			} else {
				return $this->db->query("
												SELECT
													p.*,
												prod._product,
												prod._sku,
												l._line as linea
												FROM
													tbapp_products_store AS p
												LEFT JOIN tbapp_products as prod ON prod.id = p._producto_id
												LEFT JOIN tbapp_products_line AS l ON l.id = prod._line
												WHERE
													p._producto_id IN (".$data["product"].")
												AND p._store_id = ".$client.";")->result();
			}
		}
}

/* End of file AppPricesNewModel.php */
/* Location: ./application/models/app/prices/AppPricesNewModel.php */