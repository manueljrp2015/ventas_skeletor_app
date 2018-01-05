<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AppAnalysisController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
	    $this->load->model([
	      "app/analysis/appAnalysisModel"
	      ]);
	}

	public function indexTemp()
	{
		$dashboard = "index";
   
	    $data = [
	      "folder"    => "analysis",
	      "file"      => "analysis-temp"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function getAnalisisStore(){
          $response = ["text" => json_encode(
            [
			"data"                   => $this->appAnalysisModel->getAnalisisStore(),
			//"oweek"                => $this->appDashboardModel->getLastWeekOrder(),
			//"rank"                 => $this->appDashboardModel->rankSellerMonth(),
			"sales"                  => $this->appAnalysisModel->getSaleForMonth(),
			"salesY"                 => $this->appAnalysisModel->getSaleForYear(),
			"salesW"                 => $this->appAnalysisModel->getSaleForWeek(),
			"salesGraph"             => $this->appAnalysisModel->getSalesGraphYear(),
			"salesGraphB"            => $this->appAnalysisModel->getSalesGraphYearBefore(),
			"salesGraphDay"          => $this->appAnalysisModel->getSalesGraphDay(),
			"salesGraphWeek"         => $this->appAnalysisModel->getSaleGraphWeek(),
			"productGraphYear"       => $this->appAnalysisModel->getSaleProductGraphYear(),
			"productGraphYearAfter"  => $this->appAnalysisModel->getSalesGraphYearAfter(),
			"productGraphYearBefore" => $this->appAnalysisModel->getSalesGraphYearB(),
			"productGraphMonth"      => $this->appAnalysisModel->getSaleProductGraphMonth(),
			"salesGraphForWeek"      => $this->appAnalysisModel->getSalesGraphWeek(),
            ])];
    $this->load->view("app/response/text", $response);
  }

}

/* End of file AppAnalysisController.php */
/* Location: ./application/controllers/app/analysis/AppAnalysisController.php */