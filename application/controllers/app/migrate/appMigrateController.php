<?php

/**
* 
*/
class appMigrateController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			"app/migrate/appMigrateModel"
			]);
	}

	public function migrate(){
		//header("Content-Type: application/json; charset=UTF-8");
		echo json_encode($this->appMigrateModel->migrateProducts());

	}


	public function addNewProductStore(){
		json_encode($this->appMigrateModel->addNewProductStore());
	}

	
}