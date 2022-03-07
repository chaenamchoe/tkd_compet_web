<?php

require APPPATH.'libraries/REST_Controller.php';

class Competapi extends REST_Controller{
	public function __construct(){
		parent::__construct();
		//$this->load->database();
		$this->load->model(array("api/competapi_model"));
		$this->load->library("form_validation");
		$this->load->helper("security");
	}
	public function index_post(){	//insert
		$uname = $this->security->xss_clean($this->input->post("uname"));
		$email = $this->security->xss_clean($this->input->post("email"));
		$this->send_email($uname, $email);
		/*
		$data = json_decode(file_get_contents("php://input"));
		$name = isset($data->name) ? $data->name : "";
		$email = isset($data->email) ? $data->email : "";
		$mobile = isset($data->mobile) ? $data->mobile : "";
		*/
		/*
		$name = $this->security->xss_clean($this->input->post("name"));
		$email = $this->security->xss_clean($this->input->post("email"));
		$mobile = $this->security->xss_clean($this->input->post("mobile"));
		$this->form_validation->set_rules("name", "Name", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("mobile", "Mobile", "required");
		if($this->form_validation->run() === FALSE){
			$this->response(array(
				"status" => 0,
				"message" => "All field are needed"
			), REST_Controller::HTTP_NOT_FOUND);
		}else{
			if(!empty($name) && !empty($email) && !empty($mobile)){
				$user = array(
					"name" => $name,
					"email" => $email,
					"mobile" => $mobile
				);
				if($this->bmae_model->insert_user($user)){
					$this->response(array(
						"status"=>1,
						"message"=> "User Created..."
					), REST_Controller::HTTP_OK);
				}else{
					$this->response(array(
						"status"=>0,
						"message"=> "Failed to create"
					), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
			}else{
				$this->response(array(
					"status"=>0,
					"message"=> "All fields are needed"
				), REST_Controller::HTTP_NOT_FOUND);
			}
		}
		*/
	}
	public function index_put(){
		//update
		$data = json_decode(file_get_contents("php://input"));
		if(isset($data->name) && isset($data->email) && isset($data->mobile)){
			$user_id = $data->id;
			$user_info = array(
				"name" => $data->name,
				"email" => $data->email,
				"mobile" => $data->mobile
			);
			if($this->bmae_model->update_user($user_id, $user_info)){
				$this->response(array(
					"status"=>1,
					"message"=> "User updated..."
				), REST_Controller::HTTP_OK);
			}else{
				$this->response(array(
					"status"=>0,
					"message"=> "Failed update"
				), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
		}else{
			$this->response(array(
				"status"=>0,
				"message"=> "All fields are needed"
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function index_delete(){
		$data = json_decode(file_get_contents("php://input"));
		$user_id = $this->security->xss_clean($data->user_id);
		if($this->bmae_model->delete_user($user_id)){
			$this->response(array(
				"status"=>1,
				"message"=> "User deleted..."
			), REST_Controller::HTTP_OK);
		}else{
			$this->response(array(
				"status"=>0,
				"message"=> "Failed to delete"
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function index_get(){
		//get
		//echo "This is get methode";
		$users = $this->bmae_model->get_reg_users();
		//print_r($query->result());
		if(count($users) > 0){
			$this->response(array(
			"status" => 1,
			"message" => "Data found",
			"data" => $users
			), REST_Controller::HTTP_OK);	
		}else{
			$this->response(array(
			"status" => 0,
			"message" => "No Data found",
			"data" => $users
			), REST_Controller::HTTP_NOT_FOUND);	
		}
		
	}
	public function send_email($uname, $uemail){
		$this->load->library('email');
		$this->load->library('parser');
		$config = array();
		$config['useragent'] = "CodeIgniter";
		//$config['mailpath']  = "/usr/bin/sendmail";
		$config['protocol']  = "smtp";
		$config['smtp_host'] = "ssl://smtp.googlemail.com";
		$config['smtp_user'] = "ccnplaza@gmail.com";
		$config['smtp_pass'] = "@Choe3415ccn";
		$config['smtp_port'] = "465";
		$config['mailtype'] = 'html';
		$config['charset']  = 'utf-8';
		$config['newline']  = "\r\n";
		$config['smtp_timeout'] = "10";
		$config['wordwrap'] = TRUE;

		$this->email->clear();
		$this->email->initialize($config);
		
		$this->email->from("ccnplaza@gmail.com" , "관리자"); //보내는 사람
		$this->email->to($uemail); //받는 사람
		$this->email->subject("로그인 사용자 확인메일"); //메일 제목
		$this->email->message("<h3><b>". $uname ."</b>님, 안녕하세요?<br><br>" . 
				"등록하신 로그인 사용자 인증메일입니다."."<br>".
				"본인인증이 완료되면 등록하신 이메일과 비밀번호로 로그인하세요.<br>".
				"아래 링크를 클릭하셔서 본인인증을 하세요.<br><br>".
				'<a href="http://ccnplaza.com/bmae/index.php/userapprove?email=' . $uemail . '"> 본인인증 </a></h3>');

		if ($this->email->send()){
			$this->response(array(
			"status" => 1,
			"message" => "Email send success."
			), REST_Controller::HTTP_OK);	
		}else{
			$this->response(array(
			"status" => 0,
			"message" => "Email send errors"
			), REST_Controller::HTTP_NOT_FOUND);	
		}
	}
	
}

?>