<?php


/**
* 
*/
class appFileProcessController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			"app/files/appFileProcessModel"
			]);
	}

	public function setFileAvatar()
	{
		$dir_file = "./public/avatar/"; 
		$new_name_file = "avatar_".$this->session->userdata("id").".png";
		$this->moveUploadedFileImages($_FILES["croppedImage"], $dir_file, 	$new_name_file, TRUE);

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "subido el archivo avatar ".$new_name_file]);	
	}


	protected function moveUploadedFileImages($file, $dir_file, $new_name_file = "", $resize = TRUE)
	{
		if (move_uploaded_file($file["tmp_name"], $dir_file.$file["name"])) {
			self::renameFiles($dir_file.$file["name"], $dir_file.$new_name_file);
			if ($resize == TRUE) {
				self::resizeImages($dir_file.$new_name_file, TRUE , TRUE,150 , 100);
			} else {
			}
			$this->appFileProcessModel->setAvatarUser($dir_file.$new_name_file);
			$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "subido el archivo avatar ".$dir_file.$file["name"]]);	
			return TRUE;
		} else {
			$response = ["text" => "fail_move"];
   			$this->load->view("app/response/text", $response);
		}
	}

	protected function renameFiles($file, $new_name)
	{
		return rename($file, $new_name);
	}

	protected function resizeImages($path, $thumb, $ratio, $width, $height)
	{
		$config['image_library']  = 'gd2';
		$config['source_image']   = $path;
		$config['create_thumb']   = $thumb;
		$config['maintain_ratio'] = $ratio;
		$config['width']          = $width;
		$config['height']         = $height;
		$config['quality']         = "100%";

		$this->load->library('image_lib', $config);
		if ( ! $this->image_lib->resize())
		{
        	$response = ["text" => "error_resize"];
   			$this->load->view("app/response/text", $response);
		}
	}


}