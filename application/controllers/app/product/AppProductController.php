<?php
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class AppProductController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/catalogs/AppCataLogsModel",
			"app/product/AppProductModel"
			]);
	}

	protected function errorValidation()
  {
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  }

	public function index()
	{

	    $data = [
			"folder"          => "product",
			"file"            => "create-product",
			"listLineProduct" => $this->AppCataLogsModel->getLineProduct(),
			"groupProduct"    => $this->AppCataLogsModel->getCategoryProduct(),
			"subgroupProduct" => $this->AppCataLogsModel->getSubCategoryProduct(),
			"undProduct"      => $this->AppCataLogsModel->getUndProduct(),
			"listProduct"      => $this->AppProductModel->getProductList(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


		protected function dataProduct(){
			$this->form_validation->set_rules('_sku', '_sku', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_product', '_product', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_ean', '_ean', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_eanbox', '_eanbox', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_dun', '_dun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_und', '_und', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_cost', '_cost', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_cate', '_cate', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_subcate', '_subcate', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_line', '_line', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_price1', '_price1', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_price2', '_price2', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_price3', '_price3', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_price4', '_price4', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_wieght', '_wieght', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_height', '_height', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_width', '_width', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_large', '_large', 'trim|required|xss_clean');
			$this->form_validation->set_rules('_codrela', '_codrela', 'trim|xss_clean');
			$this->form_validation->set_rules('_descu', '_descu', 'trim|xss_clean');
			$this->form_validation->set_rules('_available_real', '_available_real', 'trim|xss_clean');
			$this->form_validation->set_rules('_available', '_available', 'trim|xss_clean');
			$this->form_validation->set_rules('_expire', '_expire', 'trim|xss_clean');
			$this->form_validation->set_rules('_min_measure', '_min_measure', 'trim|xss_clean');
		  $this->form_validation->set_rules('_max_measure', '_max_measure', 'trim|xss_clean');

		  return $this->form_validation->run();
		}

		public function putProduct(){
			if ($this->input->is_ajax_request()) {
				if (self::dataProduct()) {
					$response = ["text" => json_encode( [
		        	"data" => $this->AppProductModel->putProduct($this->input->post())])];
		        $this->load->view("app/response/text", $response);
				} else {
					self::errorValidation();
				}
				
			} else {
				$this->session->sess_destroy();
	      redirect('/','auto');
			}
			
		}


		public function updateProduct(){
			if ($this->input->is_ajax_request()) {
				if (self::dataProduct()) {
					$response = ["text" => json_encode( [
		        	"data" => $this->AppProductModel->updateProduct($this->input->post())])];
		        $this->load->view("app/response/text", $response);
				} else {
					self::errorValidation();
				}
				
			} else {
				$this->session->sess_destroy();
	      redirect('/','auto');
			}
			
		}

		public function getProductFromId(){
			if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode(["data" => $this->AppProductModel->getProductFromId($this->input->get('id'))])];
			} else {
				$this->session->sess_destroy();
	      redirect('/','auto');
			}
			$this->load->view("app/response/text", $response);
		}

}
/* End of file AppProductController.php */
/* Location: ./application/controllers/app/product/AppProductController.php */