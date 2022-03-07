<?php

require APPPATH.'libraries/REST_Controller.php';

class Competapi extends REST_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array("api/competapi_model"));
		$this->load->library("form_validation");
		$this->load->helper("security");
	}
	public function index_post(){	//insert
		$this->load->view('header/header');
		$cmd = $this->input->post("cmd");
		$msg = $this->input->post("msg");
		$data['cmd'] = $cmd;
		$data['msg'] = $msg;
		$this->load->view('api/send_chat_msg', $data);
	}
	public function send_message($data){
		$this->load->view('api/send_chat_msg', $data);
	}
	
}

?>