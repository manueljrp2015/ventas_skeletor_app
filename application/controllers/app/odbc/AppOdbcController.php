<?php


/**
* 
*/
class appOdbcController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function queryOdbc()
    {
       	 $parameters = array();
    	 $parameters['query'] = $this->input->post("query");

         $response = ["text" => $this->apiodbc->testConOdbc($parameters, TRUE)];
         $this->load->view("app/response/text", $response);
    }

    public function testConn()
    {
       	 $parameters = array();
         echo $this->apiodbc->testConn($parameters, TRUE);
    }

     public function testArray()
    {
         $parameters = array();
         echo $this->apiodbc->testConOdbc($parameters, TRUE);
    }


    public function viewOdbc(){
        $data = [
            "folder"   => "odbc",
            "file"     => "view-odbc"
        ];

        $this->load->view("app/template/index_template_app", $data);

    }
    
}