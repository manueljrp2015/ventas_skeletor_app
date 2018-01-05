<?php

$this->load->view("app/dashboard/parse/header");
$this->load->view("app/dashboard/parse/body-in");
$this->load->view("app/dashboard/parse/header-navbar");
$this->load->view("app/dashboard/parse/search-result");

	if (CHAT_ACTIVE == false) 
	{
	  $this->load->view("app/dashboard/parse/aside-chat");
	}
	else {}

		$this->load->view("app/dashboard/parse/aside-sidebar");


$this->load->view("app/".$folder."/".$file);
//$this->load->view("app/dashboard/parse/page-footer");
$this->load->view("app/dashboard/parse/body-out");
