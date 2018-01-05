<?php

/**
 *
 */
class appDashboardController extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->appoAuthModel->oauthChecked();
    $this->load->model([
      "app/business/appBusinessModel",
      "app/dashboard/appDashboardModel"
      ]);
  }

  public function indexDashboard()
  {

   $dashboard = "index";
   
    $data = [
      "folder"    => "dashboard/welcome",
      "file"      => $dashboard,
      "info_user" => $this->appUserModel->getInformationUser()
    ];

    $this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha visitado el escritorio"]);

    $this->load->view("app/template/index_template_app", $data);

  }


  public function getAnalisisStore(){
          $response = ["text" => json_encode(
            [
            "data"          => $this->appDashboardModel->getAnalisisStore(),
            "oweek"         => $this->appDashboardModel->getLastWeekOrder(),
            "rank"          => $this->appDashboardModel->rankSellerMonth(),
            "sales"         => $this->appDashboardModel->getSaleForMonth(),
            "salesY"        => $this->appDashboardModel->getSaleForYear(),
            "salesW"        => $this->appDashboardModel->getSaleForWeek(),
            "salesGraph"    => $this->appDashboardModel->getSalesGraphYear(),
            "salesGraphDay" => $this->appDashboardModel->getSalesGraphDay(),
            "salesGraphWeek" => $this->appDashboardModel->getSaleGraphWeek(),
            "productGraphYear" => $this->appDashboardModel->getSaleProductGraphYear(),
            ])];
    $this->load->view("app/response/text", $response);
  }

  public function destroySession()
  {
    $this->appoAuthModel->oauthDestroySession();
  }

  

}
