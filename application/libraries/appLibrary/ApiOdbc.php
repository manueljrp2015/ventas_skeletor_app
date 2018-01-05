<?php

/**
* 
*/


class apiOdbc
{

	var $url = "";
	var $post = "";
	var $domain;
	var $response = "";
	var $view_result = "";

	public function __construct(){
		
		$fp = fopen("./public/files/ip/ip.txt", "r");
		$linea = fgets($fp);
		fclose($fp);
		$this->domain = "http://".$linea.'/slim_api_rest/';
	}

	public function createNewClient($config , $view = false)
	{
		$this->view_result = $view;
		$this->url = $this->domain."public/create-newclient";
		$this->post = $config;
		return self::execCurl();
	}

	public function updateClient($config , $view = false)
	{
		$this->view_result = $view;
		$this->url = $this->domain."public/update-cliente";
		$this->post = $config;
		return self::execCurl();
	}

	public function testConOdbc($config , $view = false){
		$this->view_result = $view;
		$this->url = $this->domain."public/get-client";
		return  self::execCurlGet();
	}

	public function testConn($config , $view = false){
		$this->view_result = $view;
		$this->url = $this->domain."public/vcon";
		return  self::execCurlGet();
	}

	private function execCurlGet()
	{
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->url);
   
        $this->response = curl_exec($curl);
        curl_close($curl);
        if ($this->view_result) 
        {
            return $this->response;
        }
	}

	private function execCurl()
	{
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, 6);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->post);
        $this->response = curl_exec($curl);
        curl_close($curl);
        if ($this->view_result) 
        {
            return $this->response;
        }
	}
}