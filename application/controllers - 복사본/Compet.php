<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compet extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library('upload');
		$this->config->load('ccn_config', true);
		$this->load->database();
		$this->load->model('tkd_model');
		$this->load->library('session');
	}
	public function index(){
		$this->logout();
		$_SESSION['assoc_id'] = 0;
		$_SESSION['assoc_name'] = '';
		$this->load->view('header/header_nomenu');
		$this->load->view('wrong_url');
	}
	public function logout(){
		unset($_SESSION['login_user_name']);
		unset($_SESSION['login_user_center']);
		unset($_SESSION['center_id']);
		$_SESSION['login_user_approved'] = 0;
	}
	public function asso($assoc_id){
		$this->logout();
		$_SESSION['assoc_id'] = $assoc_id;
		//$_SESSION['country'] = 0;
		$_SESSION['use_agree'] = 0;
		redirect('compet/regist');
	}
	public function assoc($assoc_id, $use_agree, $country){
		$this->logout();
		$_SESSION['assoc_id'] = $assoc_id;
		$_SESSION['country'] = $country;
		$_SESSION['use_agree'] = $use_agree;
		redirect("compet/regist");
	}
	public function assoc_amb($assoc_id, $use_agree, $country){
		$this->logout();
		$_SESSION['assoc_id'] = $assoc_id;
		$_SESSION['country'] = $country;
		$_SESSION['use_agree'] = $use_agree;
		redirect('compet/regist_amb');
	}
	public function regist(){
		$assoc_id = $_SESSION['assoc_id'];
		//$country = $_SESSION['country'];
		$act_compet = $this->tkd_model->get_active_competition();
		if(count($act_compet) > 0){
			$compet_id = $act_compet[0]['ID'];
			$country = $act_compet[0]['IS_INTERNATIONAL'];
			$_SESSION['country'] = $country;
			$_SESSION['compet_id'] = $compet_id;
			$_SESSION['compet_mode'] = $act_compet[0]['IS_ACTIVE'];
			$_SESSION['discount_price'] = $act_compet[0]['DISCOUNT_PRICE'];
			$_SESSION['bank_info'] = $act_compet[0]['BANK_INFO'];
			$_SESSION['contact_info'] = $act_compet[0]['C_CONTACT'];
			$_SESSION['KIND2'] = $act_compet[0]['KIND2'];
			$_SESSION['VIDEO_CNT'] = $act_compet[0]['KIND5'];
			$compet = $this->tkd_model->get_associations_info($assoc_id);
			$_SESSION['site_title'] = $compet->A_NAME;
			$_SESSION['assoc_tel'] = $compet->A_CONTACT;
			$_SESSION['assoc_addr'] = $compet->A_ADDR;
			redirect('compet/main');
		}else{
			$this->load->view('header/header_nomenu');
			if($_SESSION['country'] == 0){
				$this->load->view('no_active_competition');
			}else{
				$this->load->view('no_active_competition_e');
			}
		}
	}
	public function regist_amb(){
		$assoc_id = $_SESSION['assoc_id'];
		$country = $_SESSION['country'];
		$act_compet = $this->tkd_model->get_active_competition();
		if(count($act_compet) > 0){
			$compet_id = $act_compet[0]['ID'];
			$_SESSION['compet_id'] = $compet_id;
			$_SESSION['discount_price'] = $act_compet[0]['DISCOUNT_PRICE'];
			$_SESSION['bank_info'] = $act_compet[0]['BANK_INFO'];
			$_SESSION['contact_info'] = $act_compet[0]['C_CONTACT'];
			$_SESSION['KIND2'] = $act_compet[0]['KIND2'];
			$compet = $this->tkd_model->get_associations_info($assoc_id);
			$_SESSION['site_title'] = $compet->A_NAME;
			$_SESSION['assoc_tel'] = $compet->A_CONTACT;
			$_SESSION['assoc_addr'] = $compet->A_ADDR;
			redirect('compet/login_amb');
		}else{
			$this->load->view('header/header_nomenu');
			$this->load->view('no_active_competition_e');
		}
	}
	public function main(){
		$compet_id = $_SESSION['compet_id'];
		$result = $this->tkd_model->get_competition($compet_id);
		$_SESSION['compet_is_video'] = $result->C_KIND;
		$_SESSION['compet_need_picture'] = $result->NEED_PICTURE;
		$_SESSION['active_competition_name'] = $result->C_NAME;
		$_SESSION['active_competition_name_e'] = $result->C_NAME_E;
		$data['result'] = $result;
		$data['compet_id'] = $compet_id;
		if($_SESSION['country'] == 0){
			$this->load->view('header/header');
			$this->load->view('main', $data);
			$this->load->view('header/footer');
		}else{
			$this->load->view('header/header_e');
			$this->load->view('main_e', $data);
			$this->load->view('header/footer_e');
		}
	}
	//로그인
	public function login(){
		$compet_id = $_SESSION['compet_id'];
		$result = $this->tkd_model->get_associations();
		$data['result'] = $result;
		if($_SESSION['country']==0){
			$this->load->view('header/header_nomenu');
			$this->load->view('login', $data);
			$this->load->view('header/m_footer');
		}else{
			$this->load->view('header/header_e');
			$this->load->view('login_e', $data);
			$this->load->view('header/footer_e');
		}
	}
	public function login_amb(){
		$compet_id = $_SESSION['compet_id'];
		$result = $this->tkd_model->get_associations();
		$data['result'] = $result;
		$this->load->view('amb/header_e_amb');
		$this->load->view('amb/login_e_amb', $data);
		$this->load->view('amb/footer_e_amb');
	}
	//로그아웃
	public function loginout()
	{
		//unset($_SESSION['center_name']);
		unset($_SESSION['login_user_name']);
		unset($_SESSION['login_user_center']);
		unset($_SESSION['center_id']);
		$_SESSION['login_user_approved'] = 0;
		unset($_SESSION['last_jongmok_id']);
		unset($_SESSION['last_category_id']);
		unset($_SESSION['last_weight_id']);
		unset($_SESSION['last_single_group']);
		//unset($_SESSION['compet_id']);
		redirect('compet/main');
	}
	public function loginout_amb()
	{
		//unset($_SESSION['center_name']);
		unset($_SESSION['login_user_name']);
		unset($_SESSION['login_user_center']);
		unset($_SESSION['center_id']);
		$_SESSION['login_user_approved'] = 0;
		unset($_SESSION['last_jongmok_id']);
		unset($_SESSION['last_category_id']);
		unset($_SESSION['last_weight_id']);
		unset($_SESSION['last_single_group']);
		//unset($_SESSION['compet_id']);
		redirect('compet/login_amb');
	}
	//로그인 확인
	public function check_login(){
		$compet_id = $_SESSION['compet_id'];
		$assoc_id = $_SESSION['assoc_id'];
		$data['login_id']  = $this->input->post('login_id');
		$data['login_pass'] = $this->input->post('login_pass');
		$data['assoc_id'] = $assoc_id;
		$result = $this->tkd_model->check_login($data);
		$count = count($result);
		//var_dump($result);
		if ($count > 1){
			$approv = $result[0]['APPROVED'];
			$data['results'] = $result;
			$this->load->view('header/header_nomenu');
			$this->load->view('same_master_list', $data);
        	$this->load->view('header/m_footer');
		}else{
			if ($count === 1){
				$approv = $result[0]['APPROVED'];
				if ($approv === 1){
					$centerid = $result[0]['ID'];
					$center = $result[0]['CENTER_NAME'];
					$chief = $result[0]['C_NAME'];
					$c_guid = $result[0]['C_GUID'];
					$compet = $this->tkd_model->get_associations_info($assoc_id);
					
					$_SESSION['site_title'] = $compet->A_NAME;
					$_SESSION['assoc_tel'] = $compet->A_CONTACT;
					$_SESSION['assoc_addr'] = $compet->A_ADDR;

					$_SESSION['login_user_name'] = $cheif;
					$_SESSION['login_user_center'] = $center;
					$_SESSION['center_id'] = $centerid;
					$_SESSION['login_user_approved'] = 1;
					$_SESSION['login_user_center_guid'] = $c_guid;
					redirect('compet/main/');
				}else{
					$this->load->view('header/header_nomenu');
					if($_SESSION['country'] == 0){
						$this->load->view('not_athorized');
					}else{
						$this->load->view('not_athorized_e');
					}
					//$this->load->view('header/m_footer');
					$this->load->view('header/footer_e');
				}
			}else{
				$this->load->view('header/header_nomenu');
				if($_SESSION['country'] == 0){
					$this->load->view('not_registed');
				}else{
					$this->load->view('not_registed_e');
				}
				//$this->load->view('header/m_footer');
				$this->load->view('header/footer_e');
			}
		}
	}
	public function check_login_amb(){
		$compet_id = $_SESSION['compet_id'];
		$assoc_id = $_SESSION['assoc_id'];
		$data['login_id']  = $this->input->post('login_id');
		$data['login_pass'] = $this->input->post('login_pass');
		$data['assoc_id'] = $assoc_id;
		$result = $this->tkd_model->check_login($data);
		$count = count($result);
		//var_dump($result);
		if ($count > 1){
			$approv = $result[0]['APPROVED'];
			$data['results'] = $result;
			$this->load->view('header/header_nomenu');
			$this->load->view('same_master_list', $data);
        	$this->load->view('header/m_footer');
		}else{
			if ($count === 1){
				$approv = $result[0]['APPROVED'];
				if ($approv === 1){
					$centerid = $result[0]['ID'];
					$center = $result[0]['CENTER_NAME'];
					$chief = $result[0]['C_NAME'];
					$c_guid = $result[0]['C_GUID'];
					$compet = $this->tkd_model->get_associations_info($assoc_id);
					
					$_SESSION['site_title'] = $compet->A_NAME;
					$_SESSION['assoc_tel'] = $compet->A_CONTACT;
					$_SESSION['assoc_addr'] = $compet->A_ADDR;

					$_SESSION['login_user_name'] = $cheif;
					$_SESSION['login_user_center'] = $center;
					$_SESSION['center_id'] = $centerid;
					$_SESSION['login_user_approved'] = 1;
					$_SESSION['login_user_center_guid'] = $c_guid;
					redirect('compet/registed_athlete_amb/');
				}else{
					$this->load->view('amb/header_e_amb');
					if($_SESSION['country'] == 0){
						$this->load->view('not_athorized');
					}else{
						$this->load->view('not_athorized_e');
					}
					//$this->load->view('header/m_footer');
					$this->load->view('amb/footer_e_amb');
				}
			}else{
				$this->load->view('amb/header_e_amb');
				$this->load->view('not_registed_e');
				//$this->load->view('header/m_footer');
				$this->load->view('amb/footer_e_amb');
			}
		}
	}
	public function select_login_id($id)	{
		$result = $this->tkd_model->select_login_member($id);
		//print_r($result);
		if (isset($result)){
			$centerid = $result->ID;
			$chief = $result->C_NAME;
			$center = $result->CENTER_NAME;
			$assoc_id = $result->CENTER_ID;
			$approv = $result->APPROVED;
			$compet = $this->tkd_model->get_associations_info($assoc_id);

			$_SESSION['association'] = $assoc_id;
			$_SESSION['site_title'] = $compet->A_NAME;
			$_SESSION['assoc_tel'] = $compet->A_CONTACT;
			$_SESSION['assoc_addr'] = $compet->A_ADDR;

			$_SESSION['login_user_name'] = $cheif;
			$_SESSION['login_user_center'] = $center;
			$_SESSION['center_id'] = $centerid;
			$_SESSION['login_user_approved'] = $approv;
			$_SESSION['login_user_center_guid'] =$c_guid;
			redirect('compet/main');
		}
	}
	public function find_center()	{
		$compet_id = $_SESSION['compet_id'];
		$center = $this->input->post('center_name');
		if (isset($center)){
			$result = $this->tkd_model->get_registed_center($center);
		}
		//var_dump($center);
		if(!empty($result)){
			$data['center_info'] = $result;
			if($_SESSION['country']==0){
				$this->load->view('header/header');
				$this->load->view('find_center', $data);
				$this->load->view('header/footer');
			}else{
				$this->load->view('header/header_e');
				$this->load->view('find_center_e', $data);
				//$this->load->view('header/footer_e');
				if ($compet_id == 36) {
					$this->load->view('header/footer_e_amb');
				}else{
					$this->load->view('header/footer_e');
				}
			}
		}else{
			if($_SESSION['country']==0){
				$this->load->view('header/header');
				$this->load->view('find_center_no');
				$this->load->view('header/footer');
			}else{
				$this->load->view('header/header_e');
				$this->load->view('find_center_no_e');
				//$this->load->view('header/footer_e');
				if ($compet_id == 36) {
					$this->load->view('header/footer_e_amb');
				}else{
					$this->load->view('header/footer_e');
				}
			}
		}
	}
	public function help()	{
		$compet_id = $_SESSION['compet_id'];
		if($_SESSION['country']==0){
			$this->load->view('header/header');
			$this->load->view('help');
			$this->load->view('header/footer');
		}else{
			$this->load->view('header/header_e');
			$this->load->view('help_e');
			//$this->load->view('header/footer_e');
			if ($compet_id == 36) {
				$this->load->view('header/footer_e_amb');
			}else{
				$this->load->view('header/footer_e');
			}
		}
	}
	public function welcome_message()	{
		$this->load->view('header/header');
		$this->load->view('welcome_message', $data);
        $this->load->view('header/footer');
	}
	function fetch_category(){
		if($this->input->post('jongmok_id')){
			echo $this->tkd_model->fetch_category($this->input->post('jongmok_id'));
		}
	}
	function fetch_weight(){
		if($this->input->post('category_id')){
			echo $this->tkd_model->fetch_weight($this->input->post('category_id'));
		}
	}
	public function add_video_file($ath_id){
		$ath_info = $this->tkd_model->get_athlete_info($ath_id);
		$data['ath_id'] = $ath_id;
		$data['jongmok'] = $ath_info->JONGMOK_NAME;
		$data['category'] = $ath_info->CATEGORY_NAME;
		$data['ath_name'] = $ath_info->A_NAME;
		$this->load->view('header/header');
		//$this->load->view('add_file_dropbox', $data);
		$this->load->view('add_video_file', $data);
        $this->load->view('header/footer');
	}
	public function save_athlete_video($a_id, $video_name){
		$data['a_id'] = $a_id;
		$data['video_name'] = $video_name;
		$this->load->view('header/header');
		$this->load->view('upload_vimeo', $data);
        $this->load->view('header/footer');
	}//update_athlete_videoid
	public function update_athlete_videoid($a_id, $video_id){
		$data['a_id'] = $a_id;
		$data['video_id'] = $video_id;
		$this->tkd_model->update_athlete_videoid($data);
		redirect('Compet/registed_athlete');
	}
	//선수등록(개인전)
	public function add_athlete()	{
		$compet = $_SESSION['compet_id'];
		if ($compet > 0){		
			$approv = $_SESSION['login_user_approved'];
			if ($approv==1){
				$compet_id = $_SESSION['compet_id'];
				$center_id = $_SESSION['center_id'];
				$result_jongmok = $this->tkd_model->get_jongmok_single($compet_id);
				if(!empty($result_jongmok)){
					$jongmok_id = $result_jongmok[0]['ID'];
					$result_category = $this->tkd_model->get_category($jongmok_id);
					$category_id = $result_category[0]['ID'];
					$result_weight = $this->tkd_model->get_weight($category_id);
					$data['jongmok'] = $result_jongmok;
					$data['category'] = $result_category;
					$data['weight'] = $result_weight;
					if($_SESSION['country'] == 0){
						$this->load->view('header/header');
						$this->load->view('insert_athlete', $data);
						$this->load->view('header/footer');	
					}else{
						$this->load->view('header/header_e');
						$this->load->view('insert_athlete_e', $data);
						//$this->load->view('header/footer_e');	
						if ($compet == 36) {
							$this->load->view('header/footer_e_amb');
						}else{
							$this->load->view('header/footer_e');
						}
					}
				}else{
					$this->load->view('no_jongmok_setting');
				}
			}else{
				redirect('compet/login?returnURL='.rawurlencode(site_url('compet/add_athlete')));
			}
		}else{
			redirect('compet/main');
		}
	}
	//선수등록(단체전)
	public function add_team()	{
		$compet = $_SESSION['compet_id'];
		if ($compet > 0){		
			$approv = $_SESSION['login_user_approved'];
			if ($approv==1){
				$compet_id = $_SESSION['compet_id'];
				$center_id = $_SESSION['center_id'];
				$result_jongmok = $this->tkd_model->get_jongmok_group($compet_id);
				//var_dump($result_jongmok);
				if(count($result_jongmok) > 0){
					$jongmok_id = $result_jongmok[0]['ID'];
					$result_category = $this->tkd_model->get_category($jongmok_id);
					$category_id = $result_category[0]['ID'];
					$category_man_cnt = $result_category[0]['MAN_CNT'];
					$result_weight = $this->tkd_model->get_weight($category_id);
					$data['jongmok'] = $result_jongmok;
					$data['category'] = $result_category;
					$data['weight'] = $result_weight;
					$data['category_man_cnt'] = $category_man_cnt;
					if($_SESSION['country'] == 0){
						$this->load->view('header/header');
						$this->load->view('insert_athlete_group', $data);
						$this->load->view('header/footer');	
					}else{
						$this->load->view('header/header_e');
						$this->load->view('insert_athlete_group_e', $data);
						//$this->load->view('header/footer_e');	
						$this->load->view('header/footer_e');
					}
				}else{
					$this->load->view('no_jongmok_setting');
				}
			}else{
				redirect('compet/login?returnURL='.rawurlencode(site_url('compet/add_athlete_group')));
			}
		}else{
			redirect('compet/main');
		}
	}
	//개인수정
	public function edit_athlete($a_id)	{
		$this->load->view('header/header');
		$compet_id = $_SESSION['compet_id'];
		$center_id = $_SESSION['center_id'];

		$ath_info = $this->tkd_model->get_athlete_byid($a_id);
		$weight_id = $ath_info->A_WEIGHT;
		//$video_id = $ath_info->VIDEO_ID;

		$jongmok = $this->tkd_model->get_jongmok_single($compet_id);
		$jongmok_id = $ath_info->JONGMOK_ID;
		$category = $this->tkd_model->get_category($jongmok_id);
		$category_id = $ath_info->CATEGORY_ID;
		$weight = $this->tkd_model->get_weight($category_id);
		$_SESSION['current_athlete_id'] = $a_id;
		$_SESSION['current_athlete_guid'] = $ath_info->A_GUID;
		if($ath_info){
			//var_dump($ath_info);
			$data['id'] = $a_id;
			$data['jongmok'] = $jongmok;
			$data['category'] = $category;
			$data['weight'] = $weight;
			$data['athlete_id'] = $a_id;
			$data['jongmok_id'] = $jongmok_id;
			$data['category_id'] = $category_id;
			$data['weight_id'] = $weight_id;
			$data['a_name'] = $ath_info->A_NAME;
			$data['a_jumin'] = $ath_info->A_JUMIN;
			$data['a_year'] = $ath_info->A_YEAR;
			//$data['video_id'] = $video_id;
			$data['a_picture'] = $ath_info->A_PICTURE;
			if($_SESSION['country'] == 0){
				$this->load->view('edit_athlete', $data);
			}else{
				$this->load->view('edit_athlete_e', $data);
			}
			//$this->load->view('header/footer');	
			if ($compet_id == 36) {
				$this->load->view('header/footer_e_amb');
			}else{
				$this->load->view('header/footer_e');
			}
		}else{
			$this->load->view('no_jongmok_setting');
		}
	}
	public function edit_athlete_amb($a_id)	{
		$this->load->view('header/header');
		$compet_id = $_SESSION['compet_id'];
		$center_id = $_SESSION['center_id'];

		$ath_info = $this->tkd_model->get_athlete_byid($a_id);
		$weight_id = $ath_info->A_WEIGHT;
		//$video_id = $ath_info->VIDEO_ID;

		$jongmok = $this->tkd_model->get_jongmok_single($compet_id);
		$jongmok_id = $ath_info->JONGMOK_ID;
		$category = $this->tkd_model->get_category($jongmok_id);
		$category_id = $ath_info->CATEGORY_ID;
		$weight = $this->tkd_model->get_weight($category_id);
		$_SESSION['current_athlete_id'] = $a_id;
		$_SESSION['current_athlete_guid'] = $ath_info->A_GUID;
		if($ath_info){
			//var_dump($ath_info);
			$data['id'] = $a_id;
			$data['jongmok'] = $jongmok;
			$data['category'] = $category;
			$data['weight'] = $weight;
			$data['athlete_id'] = $a_id;
			$data['jongmok_id'] = $jongmok_id;
			$data['category_id'] = $category_id;
			$data['weight_id'] = $weight_id;
			$data['a_name'] = $ath_info->A_NAME;
			$data['a_jumin'] = $ath_info->A_JUMIN;
			$data['a_year'] = $ath_info->A_YEAR;
			$data['a_email'] = $ath_info->E_MAIL;
			//$data['video_id'] = $video_id;
			$data['a_picture'] = $ath_info->A_PICTURE;
			$this->load->view('amb/edit_athlete_e', $data);
			//$this->load->view('header/footer');	
			$this->load->view('amb/footer_e_amb');
		}else{
			$this->load->view('no_jongmok_setting');
		}
	}
	//팀수정
	public function edit_team($a_id)	{
		$this->load->view('header/header');
		$compet_id = $_SESSION['compet_id'];
		$center_id = $_SESSION['center_id'];

		$ath_info = $this->tkd_model->get_athlete_byid($a_id);
		$team_list = $this->tkd_model->get_team_byguid($ath_info->A_GUID);
		$weight_id = $ath_info->A_WEIGHT;
		//$video_id = $ath_info->VIDEO_ID;

		$jongmok_result = $this->tkd_model->get_jongmok_group($compet_id);
		$jongmok_id = $ath_info->JONGMOK_ID;
		$methode = $this->tkd_model->get_jongmok_methode($jongmok_id);
		$c_methode = $methode->C_METHODE;
		$category_result = $this->tkd_model->get_category($jongmok_id);
		$category_id = $ath_info->CATEGORY_ID;
		$category_info = $this->tkd_model->get_category_price($category_id);
		$category_man_cnt = $category_info->MAN_CNT;
		$weight_result = $this->tkd_model->get_weight($category_id);
		$_SESSION['current_athlete_id'] = $a_id;
		$_SESSION['current_athlete_guid'] = $ath_info->A_GUID;
		if($ath_info){
			//var_dump($ath_info);
			$data['a_id'] = $a_id;
			$data['jongmok'] = $jongmok_result;
			$data['category'] = $category_result;
			$data['c_methode'] = $c_methode;
			$data['weight'] = $weight_result;
			$data['team_name'] = $ath_info->A_NAME;
			$data['team_list'] = $team_list;
			$data['a_guid'] = $ath_info->A_GUID;
			$data['jongmok_id'] = $jongmok_id;
			$data['category_id'] = $category_id;
			$data['category_man_cnt'] = $category_man_cnt;
			$data['weight_id'] = $weight_id;
			//$data['video_id'] = $video_id;
			$data['a_picture'] = $ath_info->A_PICTURE;
			if($_SESSION['country'] == 0){
				$this->load->view('edit_athlete_group', $data);
			}else{
				$this->load->view('edit_athlete_group_e', $data);
			}
			//$this->load->view('header/footer');	
			if ($compet_id == 36) {
				$this->load->view('header/footer_e_amb');
			}else{
				$this->load->view('header/footer_e');
			}
		}else{
			$this->load->view('no_jongmok_setting');
		}
	}
	public function edit_team_amb($a_id)	{
		$this->load->view('amb/header_e_amb');
		$compet_id = $_SESSION['compet_id'];
		$center_id = $_SESSION['center_id'];

		$ath_info = $this->tkd_model->get_athlete_byid($a_id);
		$team_list = $this->tkd_model->get_team_byguid($ath_info->A_GUID);
		$weight_id = $ath_info->A_WEIGHT;
		//$video_id = $ath_info->VIDEO_ID;

		$jongmok_result = $this->tkd_model->get_jongmok_group($compet_id);
		$jongmok_id = $ath_info->JONGMOK_ID;
		$methode = $this->tkd_model->get_jongmok_methode($jongmok_id);
		$c_methode = $methode->C_METHODE;
		$category_result = $this->tkd_model->get_category($jongmok_id);
		$category_id = $ath_info->CATEGORY_ID;
		$category_info = $this->tkd_model->get_category_price($category_id);
		$category_man_cnt = $category_info->MAN_CNT;
		$weight_result = $this->tkd_model->get_weight($category_id);
		$_SESSION['current_athlete_id'] = $a_id;
		$_SESSION['current_athlete_guid'] = $ath_info->A_GUID;
		if($ath_info){
			//var_dump($ath_info);
			$data['a_id'] = $a_id;
			$data['jongmok'] = $jongmok_result;
			$data['category'] = $category_result;
			$data['c_methode'] = $c_methode;
			$data['weight'] = $weight_result;
			$data['team_name'] = $ath_info->A_NAME;
			$data['team_list'] = $team_list;
			$data['a_guid'] = $ath_info->A_GUID;
			$data['jongmok_id'] = $jongmok_id;
			$data['category_id'] = $category_id;
			$data['category_man_cnt'] = $category_man_cnt;
			$data['weight_id'] = $weight_id;
			//$data['video_id'] = $video_id;
			$data['a_picture'] = $ath_info->A_PICTURE;
			$this->load->view('amb/edit_athlete_group_e', $data);
			//$this->load->view('header/footer');	
			$this->load->view('amb/footer_e_amb');
		}else{
			$this->load->view('no_jongmok_setting');
		}
	}
	//선수저장(개인전)
	public function save_athlete()	{
		$compet_id = $_SESSION['compet_id'];
		$jongmok_id = $this->input->post('jongmok');
		$single_or_group = $this->input->post('single_group');
		$category_id = $this->input->post('category');
		$weight_id = $this->input->post('weight');
		$t_price = $this->input->post('att_price');
		$a_guid = $this->input->post('a_guid');
		if($weight_id > 0){
			$weight = $weight_id;
		}else{
			$weight = 0;
		}
		for($i=0;$i<5;$i++){
			$a_name = $this->input->post('a_name'.$i);
			$a_jumin = $this->input->post('a_jumin'.$i);
			if (!empty($a_name)){
				$data['ath_name'] = $a_name;
				$data['compet_id'] = $compet_id;	
				$data['school_id'] = $_SESSION['center_id'];
				$data['jongmok_id'] = $jongmok_id;
				$data['category_id'] = $category_id;
				$data['weight_id'] = $weight;
				$data['ath_jumin'] = $a_jumin;
				$data['ath_year'] = $this->input->post('a_year'.$i);
				
				$data['athlete_cnt'] = 1;
				$data['a_guid'] = $a_guid;
				//$data['video_id'] = $this->input->post('video_id'.$i);
				$data['att_price'] = $t_price;

				if($_SESSION['compet_need_picture'] === 1){
					$fileName = $_FILES["file_name".$i]["name"];
					if($fileName){
						$n_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
						$image_dir = './uploads/'.$compet_id;
						if(!is_dir($image_dir)){
							mkdir($image_dir);
						}
						move_uploaded_file($_FILES["file_name".$i]["tmp_name"], $image_dir.'/'.$n_filename);
						$data['a_picture'] = $n_filename;
					}else{
						$data['a_picture'] = '';
					}
				}else{
					$data['a_picture'] = '';
				}
			$this->tkd_model->insert_athlete($data);
			}	
		}
		if ($_SESSION['discount_price'] > 0){
			$this->tkd_model->update_athlete_attprice();
		}
		redirect('Compet/registed_athlete');
	}
	//선수저장(단체전)
	public function save_team()	{
		$compet_id = $_SESSION['compet_id'];
		$jongmok_id = $this->input->post('jongmok');
		$single_or_group = $this->input->post('single_group');
		$category_id = $this->input->post('category');
		$weight_id = $this->input->post('weight');
		$t_price = $this->input->post('att_price');
		$a_guid = $this->input->post('a_guid');
		$team_name = $this->input->post('a_name0');
		//$video_id = $this->input->post('video_id');
		$a_picture2 = $this->input->post('a_picture2');
		$weight = 0;
		$methode = $this->tkd_model->get_jongmok_methode($jongmok_id);
		$c_methode = $methode->C_METHODE;
		$team_cnt = 0;
		for($i=0;$i<20;$i++){
			if (!empty($this->input->post('a_name'.$i))){
				$team_ath['ath_id'] = $i + 1;
				$team_ath['ath_name'] = $this->input->post('a_name'.$i);
				$team_ath['ath_jumin'] = $this->input->post('a_jumin'.$i);
				$team_ath['ath_year'] = $this->input->post('a_year'.$i);
				$team_ath['a_guid'] = $a_guid;
				$team_ath['compet_id'] = $_SESSION['compet_id'];
				$team_ath['school_id'] = $_SESSION['center_id'];
				$team_cnt++;
				$this->tkd_model->insert_team($team_ath);
			}	
		}
		$data['ath_name'] = $team_name . ' Team';
		$data['compet_id'] = $compet_id;	
		$data['school_id'] = $_SESSION['center_id'];
		$data['jongmok_id'] = $jongmok_id;
		$data['category_id'] = $category_id;
		$data['weight_id'] = $weight;
		$data['ath_jumin'] = '';
		$data['ath_year'] = 0;
		if($c_methode == 1){
			$data['att_price'] = $t_price * $team_cnt;
		}else{
			$data['att_price'] = $t_price;
		}
		$data['athlete_cnt'] = $team_cnt;
		$data['a_guid'] = $a_guid;
		//$data['video_id'] = $video_id;
		if($_SESSION['compet_need_picture'] === 1){
			$fileName = $_FILES["file_name"]["name"];
			if(!empty($fileName)){
				$n_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
				$image_dir = './uploads/'.$compet_id;
				if(!is_dir($image_dir)){
					mkdir($image_dir);
				}
				move_uploaded_file($_FILES["file_name"]["tmp_name"], $image_dir.'/'. $n_filename);
				$data['a_picture'] = $image_dir.'/'.$n_filename;
			}else if(!empty($a_picture2)){
				$data['a_picture'] = $a_picture2;
			}else{
				$data['a_picture'] = '';
			}
		}else{
			$data['a_picture'] = '';
		}

		$result = $this->tkd_model->insert_athlete($data);
		redirect('Compet/registed_athlete');
	}
	//등록선수수정
	public function update_athlete($id)	{
		$weight = $this->input->post('weight');
		if ($weight > 0){
			$weight_id = $weight;
		}else{
			$weight_id = 0;
		}
		$data['id'] = $id;
		$a_name = $this->input->post('a_name');
		$a_jumin = $this->input->post('a_jumin');
		$t_price = $this->input->post('att_price');
		$data['jongmok_id'] = $this->input->post('jongmok');
		$data['category_id'] = $this->input->post('category');
		$data['weight_id'] = $weight_id;
		$data['att_price'] = $t_price;
		$data['ath_name'] = $a_name;
		$data['ath_jumin'] = $a_jumin;
		$data['ath_year'] = $this->input->post('a_year');
		//$data['video_id'] = $this->input->post('video_id');
		$data['athlete_cnt'] = 1;
		$a_picture = $this->input->post('a_picture');
		if($_SESSION['discount_price'] > 0){
			$cnt = $this->tkd_model->get_same_athlete_namejumin($a_name, $a_jumin);
			if($cnt > 1){
				$data['att_price'] = $_SESSION['discount_price'];
			}else{
				$data['att_price'] = $t_price;
			}
		}else{
			$data['att_price'] = $t_price;
		}

		if($_SESSION['compet_need_picture'] === 1){
			$fileName = $_FILES["file_name"]["name"];
			if(!empty($fileName)){
				$n_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
				$image_dir = './uploads/'.$_SESSION['compet_id'];
				move_uploaded_file($_FILES["file_name"]["tmp_name"], $image_dir.'/'. $n_filename);
				$data['a_picture'] = $n_filename;
			}else if(!empty($a_picture)){
				$data['a_picture'] = $a_picture;
			}else{
				$data['a_picture'] = '';
			}
		}else{
			$data['a_picture'] = '';
		}
		$this->tkd_model->update_athlete($data);
		redirect('Compet/registed_athlete');
	}
	public function update_athlete_amb($id)	{
		$weight = $this->input->post('weight');
		if ($weight > 0){
			$weight_id = $weight;
		}else{
			$weight_id = 0;
		}
		$data['id'] = $id;
		$a_name = $this->input->post('a_name');
		$a_jumin = $this->input->post('a_jumin');
		$t_price = $this->input->post('att_price');
		$data['jongmok_id'] = $this->input->post('jongmok');
		$data['category_id'] = $this->input->post('category');
		$data['weight_id'] = $weight_id;
		$data['att_price'] = $t_price;
		$data['ath_name'] = $a_name;
		$data['ath_jumin'] = $a_jumin;
		$data['ath_year'] = $this->input->post('a_year');
		//$data['video_id'] = $this->input->post('video_id');
		$data['athlete_cnt'] = 1;
		$a_picture = $this->input->post('a_picture');
		if($_SESSION['discount_price'] > 0){
			$cnt = $this->tkd_model->get_same_athlete_namejumin($a_name, $a_jumin);
			if($cnt > 1){
				$data['att_price'] = $_SESSION['discount_price'];
			}else{
				$data['att_price'] = $t_price;
			}
		}else{
			$data['att_price'] = $t_price;
		}

		if($_SESSION['compet_need_picture'] === 1){
			$fileName = $_FILES["file_name"]["name"];
			if(!empty($fileName)){
				$n_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["file_name"]["tmp_name"], './uploads/'.$_SESSION['compet_id'].'/'. $n_filename);
				$data['a_picture'] = $n_filename;
			}else if(!empty($a_picture)){
				$data['a_picture'] = $a_picture;
			}else{
				$data['a_picture'] = '';
			}
		}else{
			$data['a_picture'] = '';
		}
		$this->tkd_model->update_athlete($data);
		redirect('Compet/registed_athlete_amb');
	}
	//team저장
	public function update_team($id)	{
		$athlete_id = $id;
		$a_guid = $this->input->post('a_guid');
		$jongmok_id = $this->input->post('jongmok');
		//$single_or_group = $this->input->post('single_group');
		$category_id = $this->input->post('category');
		$weight_id = $this->input->post('weight');
		$t_price = $this->input->post('att_price');
		//$athlete_cnt = $this->input->post('ath_count');
		$team_name = $this->input->post('team_name');
		//$video_id = $this->input->post('video_id');
		$a_picture2 = $this->input->post('a_picture2');
		$methode = $this->tkd_model->get_jongmok_methode($jongmok_id);
		$c_methode = $methode->C_METHODE;
		if($weight_id > 0){
			$weight = $weight_id;
		}else{
			$weight = 0;
		}
		//이전팀의자료를 삭제...
		$this->tkd_model->delete_team($a_guid);
		$team_cnt = 0;
		for($i=0;$i<20;$i++){
			if (!empty($this->input->post('a_name'.$i))){
				$team_ath['ath_id'] = $i + 1;
				$team_ath['ath_name'] = $this->input->post('a_name'.$i);
				$team_ath['ath_jumin'] = $this->input->post('a_jumin'.$i);
				$team_ath['ath_year'] = $this->input->post('a_year'.$i);
				$team_ath['a_guid'] = $a_guid;
				$team_ath['compet_id'] = $_SESSION['compet_id'];
				$team_cnt++;
				$this->tkd_model->insert_team($team_ath);
			}	
		}
		//팀명정보수정...
		$data['id'] = $id;
		$data['ath_name'] = $team_name;
		$data['ath_jumin'] = '';
		$data['ath_year'] = 0;
		$data['jongmok_id'] = $jongmok_id;
		$data['category_id'] = $category_id;
		$data['weight_id'] = $weight;
		if($c_methode == 1){
			$data['att_price'] = $t_price * $team_cnt;
		}else{
			$data['att_price'] = $t_price;
		}
		$data['athlete_cnt'] = $team_cnt;
		//$data['video_id'] = $video_id;
		if($_SESSION['compet_need_picture'] === 1){
			$fileName = $_FILES["file_name"]["name"];
			if(!empty($fileName)){
				$n_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
				$image_dir = './uploads/'.$_SESSION['compet_id'];
				move_uploaded_file($_FILES["file_name"]["tmp_name"], $image_dir.'/'. $n_filename);
				$data['a_picture'] = $image_dir.'/'.$n_filename;
			}else if(!empty($a_picture2)){
				$data['a_picture'] = $a_picture2;
			}else{
				$data['a_picture'] = '';
			}
		}else{
			$data['a_picture'] = '';
		}
		
		//var_dump($data);
		$result = $this->tkd_model->update_athlete($data);
		redirect('Compet/registed_athlete');
	}
	public function update_team_amb($id)	{
		$athlete_id = $id;
		$a_guid = $this->input->post('a_guid');
		$jongmok_id = $this->input->post('jongmok');
		//$single_or_group = $this->input->post('single_group');
		$category_id = $this->input->post('category');
		$weight_id = $this->input->post('weight');
		$t_price = $this->input->post('att_price');
		//$athlete_cnt = $this->input->post('ath_count');
		$team_name = $this->input->post('team_name');
		//$video_id = $this->input->post('video_id');
		$a_picture2 = $this->input->post('a_picture2');
		$methode = $this->tkd_model->get_jongmok_methode($jongmok_id);
		$c_methode = $methode->C_METHODE;
		if($weight_id > 0){
			$weight = $weight_id;
		}else{
			$weight = 0;
		}
		//이전팀의자료를 삭제...
		$this->tkd_model->delete_team($a_guid);
		$team_cnt = 0;
		for($i=0;$i<20;$i++){
			if (!empty($this->input->post('a_name'.$i))){
				$team_ath['ath_id'] = $i + 1;
				$team_ath['ath_name'] = $this->input->post('a_name'.$i);
				$team_ath['ath_jumin'] = $this->input->post('a_jumin'.$i);
				$team_ath['ath_year'] = $this->input->post('a_year'.$i);
				$team_ath['a_guid'] = $a_guid;
				$team_ath['compet_id'] = $_SESSION['compet_id'];
				$team_cnt++;
				$this->tkd_model->insert_team($team_ath);
			}	
		}
		//팀명정보수정...
		$data['id'] = $id;
		$data['ath_name'] = $team_name;
		$data['ath_jumin'] = '';
		$data['ath_year'] = 0;
		$data['jongmok_id'] = $jongmok_id;
		$data['category_id'] = $category_id;
		$data['weight_id'] = $weight;
		if($c_methode == 1){
			$data['att_price'] = $t_price * $team_cnt;
		}else{
			$data['att_price'] = $t_price;
		}
		$data['athlete_cnt'] = $team_cnt;
		//$data['video_id'] = $video_id;
		if($_SESSION['compet_need_picture'] === 1){
			$fileName = $_FILES["file_name"]["name"];
			if(!empty($fileName)){
				$n_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
				$image_dir = './uploads/'.$_SESSION['compet_id'];
				move_uploaded_file($_FILES["file_name"]["tmp_name"], $image_dir.'/'. $n_filename);
				$data['a_picture'] = $image_dir.'/'.$n_filename;
			}else if(!empty($a_picture2)){
				$data['a_picture'] = $a_picture2;
			}else{
				$data['a_picture'] = '';
			}
		}else{
			$data['a_picture'] = '';
		}
		
		//var_dump($data);
		$result = $this->tkd_model->update_athlete($data);
		redirect('Compet/registed_athlete_amb');
	}
	//선수명 자료추출
	public function get_athlete_name($a_name) {
		$result = $this->tkd_model->get_athlete_name($a_name);
		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($result));
		echo json_encode($result);
	}
	//카테고리 자료추출
	public function get_category() {
		$jongmok_id = $this->input->post('id');
		$result = $this->tkd_model->get_category_by($jongmok_id);
		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($result));
	}
	//체급자료 추출
	public function get_weight($category_id) {
		$result = $this->tkd_model->get_weight_by($category_id);
		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($result));
	}
	//국가코드 자료추출
	public function get_country() {
		$result = $this->tkd_model->get_country();
		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($result));
	}
	public function agree(){
		$this->load->view('header/header_nomenu');
		$this->load->view('center_agree');	
	}
	public function save_agree(){
		$this->load->view('header/header_nomenu');
		$data['compet_id'] = $_SESSION['compet_id'];
		$data['center_id'] = $_SESSION['center_id'];
		$data['agree1'] = $this->input->post('agree1');
		$data['agree2'] = $this->input->post('agree2');
		$data['agree3'] = $this->input->post('agree3');
		$data['agree4'] = $this->input->post('agree4');
		$data['agree5'] = $this->input->post('agree5');
		$this->tkd_model->insert_agree($data);
		redirect('compet/registed_athlete');
	}
	//등록선수현황
	public function registed_athlete()	{
		$approv = $_SESSION['login_user_approved'];
		$compet_id = $_SESSION['compet_id'];
		$center_id = $_SESSION['center_id'];
		if($_SESSION['use_agree']==1){
			$check_agree = $this->tkd_model->check_agree($compet_id, $center_id);
			if(!isset($check_agree)){
				redirect('compet/agree');
			}
		}
		if ($compet_id > 0){
			if ($approv==1){
				$data['compet_id'] = $_SESSION['compet_id'];
				$data['center_id'] = $_SESSION['center_id'];
				$result_jongmok = $this->tkd_model->get_jongmok_all($compet_id);
				//var_dump($result_jongmok);
				$jongmok_id = $result_jongmok[0]['ID'];
				$result_category = $this->tkd_model->get_category($jongmok_id);
				$category_id = $result_category[0]['ID'];
				$result_weight = $this->tkd_model->get_weight($category_id);
				$data2['jongmok'] = $result_jongmok;
				$data2['category'] = $result_category;
				$data2['weight'] = $result_weight;
				
				$result = $this->tkd_model->get_requested_athlete($data);
				$data2['results'] = $result; 
				//var_dump($result);
				if($_SESSION['country'] == 0){
					$this->load->view('header/header');
					$this->load->view('registed_athlete', $data2);
					$this->load->view('header/footer');
				}else{
					$this->load->view('header/header_e');
					$this->load->view('registed_athlete_e', $data2);
					//$this->load->view('header/footer_e');
					if ($compet_id == 36) {
						$this->load->view('header/footer_e_amb');
					}else{
						$this->load->view('header/footer_e');
					}
				}
			}else{
				redirect('Compet/login?returnURL='.rawurlencode(site_url('Compet/registed_athlete')));
			}
		}else{
			redirect('Compet/main');
		}
	}
	public function registed_athlete_amb()	{
		$approv = $_SESSION['login_user_approved'];
		$compet_id = $_SESSION['compet_id'];
		$center_id = $_SESSION['center_id'];
		if ($compet_id > 0){
			if ($approv==1){
				$data['compet_id'] = $_SESSION['compet_id'];
				$data['center_id'] = $_SESSION['center_id'];
				$result_jongmok = $this->tkd_model->get_jongmok_all($compet_id);
				//var_dump($result_jongmok);
				$jongmok_id = $result_jongmok[0]['ID'];
				$result_category = $this->tkd_model->get_category($jongmok_id);
				$category_id = $result_category[0]['ID'];
				$result_weight = $this->tkd_model->get_weight($category_id);
				$data2['jongmok'] = $result_jongmok;
				$data2['category'] = $result_category;
				$data2['weight'] = $result_weight;
				
				$result = $this->tkd_model->get_requested_athlete($data);
				$data2['results'] = $result; 
				//var_dump($result);
				$this->load->view('amb/header_e_amb');
				$this->load->view('amb/registed_athlete_e', $data2);
				//$this->load->view('header/footer_e');
				$this->load->view('amb/footer_e_amb');
			}else{
				redirect('Compet/login?returnURL='.rawurlencode(site_url('Compet/registed_athlete_amb')));
			}
		}else{
			redirect('Compet/login_amb');
		}
	}
	//등록선수삭제
	public function delete_athlete($id)	{
		$this->tkd_model->delete_athlete($id);
		redirect('Compet/registed_athlete');
	}
	//로그인사용자등록
	public function regist_user()	{
		$result = $this->tkd_model->select_center();
		$data['center_list'] = $result;
		$this->load->view('header/header');
		$this->load->view('regist_user', $data);
        $this->load->view('header/footer');
	}
	//도장자료 추출
	public function get_center($center_id) {
		$result = $this->tkd_model->get_center_by($center_id);
		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($result));
	}
	//도장 및 임원등록...
	public function regist_center()	{
		$compet_id = $_SESSION['compet_id'];
		$assoc_id = $this->uri->segment(3, 0);
		$data['country'] = $this->tkd_model->get_country();
		//$_SESSION['association'] = $assoc_id;
		$this->load->view('header/header_nomenu');
		if($_SESSION['country']==0){
			$this->load->view('regist_center', $data);
		}else{
			$this->load->view('regist_center_e', $data);
		}
        //$this->load->view('header/m_footer');
		if ($compet_id == 36) {
			$this->load->view('header/footer_e_amb');
		}else{
			$this->load->view('header/footer_e');
		}
	}
	public function add_center(){
		$email = $this->input->post('email');
		$assoc = $_SESSION['assoc_id'];
		$query = $this->db->get_where('REGISTED_CENTER', array('CENTER_ID'=>$assoc, 'EMAIL'=>$email));
		$cnt = $query->num_rows();
		if ($cnt > 0){
			$this->load->view('header/header');
			$this->load->view('regist_center_error');
			$this->load->view('header/footer');
		}else{
			$data['c_guid'] = $this->input->post('c_guid');
			$data['center_name'] = $this->input->post('center_name');
			$data['center_addr'] = $this->input->post('center_addr');
			$data['center_tel'] = $this->input->post('center_tel');
			$data['area_name'] = $this->input->post('area_name');
			$data['c_name'] = $this->input->post('c_name');
			$data['mobile'] = $this->input->post('mobile');
			$data['email'] = $this->input->post('email');
			$data['login_pass'] = $this->input->post('login_pass');
			$data['recommander'] = $this->input->post('recommander');
			$data['recommander_tel'] = $this->input->post('recommander_tel');
			$data['country_id'] = $this->input->post('country');
			$data['center_id'] = $assoc;

			$this->tkd_model->insert_center($data);
			redirect('Compet/login');
		}
	}
	public function add_center_user()	{
		$c_guid = $_SESSION['login_user_center_guid'];
		$u_name = $this->input->post('u_name');
		$u_grade = $this->input->post('u_grade');
		$u_email = $this->input->post('u_email');
		$u_tel = $this->input->post('u_tel');
		$u_pass = $this->input->post('u_pass');
		$data2['c_guid'] = $c_guid;
		$data2['u_name'] = $u_name;
		$data2['u_email'] = $u_email;	
		$data2['u_pass'] = $u_pass;
		$data2['u_tel'] = $u_tel;
		$data2['u_grade'] = $u_grade;
		$result = $this->tkd_model->insert_center_member($data2);
		//var_dump($data2);
		redirect('Compet/edit_center');
	}
	public function update_center_user($id)	{
		$c_guid = $_SESSION['login_user_center_guid'];
		$u_name = $this->input->post('u_name');
		$u_grade = $this->input->post('u_grade');
		$u_email = $this->input->post('u_email');
		$u_tel = $this->input->post('u_tel');
		$u_pass = $this->input->post('u_pass');
		$data2['id'] = $id;
		$data2['c_guid'] = $c_guid;
		$data2['u_name'] = $u_name;
		$data2['u_email'] = $u_email;	
		$data2['u_pass'] = $u_pass;
		$data2['u_tel'] = $u_tel;
		$data2['u_grade'] = $u_grade;
		$result = $this->tkd_model->update_center_member($data2);
		//var_dump($data2);
		redirect('Compet/edit_center');
	}
	public function edit_center()	{
		$compet_id = $_SESSION['compet_id'];
		$id = $_SESSION['center_id'];
		$country = $this->tkd_model->get_country();
		$data['country'] = $country;
		$result = $this->tkd_model->get_center_id($id);
		$results = $this->tkd_model->get_center_members($result->C_GUID);
		$country_id = $result->COUNTRY_ID;
		if(isset($country_id)){
			$country_result = $this->tkd_model->get_country_id($country_id);
			$data['country_name'] = $country_result[0]['COUNTRY_NAME'];
		}else{
			$data['country_name'] = '';
		}
		//var_dump($results);
		$data['center_info'] = $result;
		$data['user_info'] = $results;
		if($_SESSION['country']==0){
			$this->load->view('header/header');
			$this->load->view('edit_user', $data);
			$this->load->view('header/footer');
		}else{
			if ($compet_id == 36) {
				$this->load->view('header/header_e_amb');
				$this->load->view('edit_user_e_amb', $data);
				$this->load->view('header/footer_e_amb');
			}else{
				$this->load->view('header/header_e');
				$this->load->view('edit_user_e', $data);
				$this->load->view('header/footer_e');
			}
		}
	}
	public function update_center()	{
		$id = $_SESSION['center_id'];
		$c_guid = $_SESSION['login_user_center_guid'];
		$data['id'] = $id;
		$data['c_name'] = $this->input->post('c_chief');
		$data['email'] = $this->input->post('c_email');
		$data['area_name'] = $this->input->post('c_area');
		$data['tel'] = $this->input->post('c_tel');
		$data['mobile'] = $this->input->post('c_mobile');
		$data['login_pass'] = $this->input->post('c_pass');
		$data['recommander'] = $this->input->post('recommander');
		$data['recommander_tel'] = $this->input->post('recommander_tel');
		$data['country_id'] = $this->input->post('country');
		$this->tkd_model->update_center($data);
		//var_dump($data);
		redirect('Compet/edit_center');
	}
	public function delete_center_member($id)	{
		$this->tkd_model->delete_center_member($id);
		redirect('Compet/edit_user');
	}
    public function competition_info()    {
        $this->load->view('competition_info');
    }
    public function download_file()    {
        $this->load->view('header/header');
		$this->load->view('download_file');
        $this->load->view('header/footer');
    }
    public function do_download()    {
        $this->load->helper('download');
        $data = file_get_contents("./downloads/겨루기직인첨부용.hwp"); // Read the file's contents
        $name = '겨루기직인첨부용.hwp';
        force_download($name, $data);
    }
    public function download_client()    {
        $this->load->view('header/header');
		$this->load->view('download_client');
        $this->load->view('header/footer');
    }
    public function download_client_file()    {
        $this->load->helper('download');
        $data = file_get_contents("./downloads/온라인대회접수_설치311111.exe"); // Read the file's contents
        $name = '온라인대회접수_설치311111.exe';
        force_download($name, $data);
    }
    public function upload_file()    {
		$compet_id = $_SESSION['compet_id'];
		if($compet_id > 0){
			$school_id = $_SESSION['center_id'];
			if($school_id > 0){
				$result = $this->tkd_model->get_request_doc($compet_id, $school_id);
				$data['doc_info'] = $result;
				$this->load->view('header/header');
				$this->load->view('upload_file', $data);
				$this->load->view('header/footer');
			}else{
				redirect('Compet/login?returnURL='.rawurlencode(site_url('Compet/upload_file')));	
			}
		}else{
			redirect('Compet/main');
		}
    }
    public function upload_suyaksu()    {
		$compet_id = $_SESSION['compet_id'];
		if($compet_id > 0){
			$school_id = $_SESSION['center_id'];
			if($school_id > 0){
				$result = $this->tkd_model->get_request_suyaksu($compet_id, $school_id);
				$data['doc_info'] = $result;
				$this->load->view('header/header');
				$this->load->view('upload_suyaksu', $data);
				$this->load->view('header/footer');
			}else{
				redirect('Compet/login?returnURL='.rawurlencode(site_url('Compet/upload_suyaksu')));	
			}
		}else{
			redirect('Compet/main');
		}
    }
	public function request_image_view()	{
		$img_file = end($this->uri->segments);
		$data['img_file'] = $img_file;
		$this->load->view('header/header');
		$this->load->view('request_image_view', $data);
		$this->load->view('header/footer');
	}
    public function upload_request_image()    {
        $targetDir = "./uploads/";
        $fileName = basename($_FILES["file_name"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $n_filename = uniqid() . '.' . $fileType;
        $n_name = $targetDir . $n_filename;
        if(isset($_POST["submit"]) && !empty($_FILES["file_name"]["name"])){
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array(strtolower($fileType), $allowTypes)){
                if(move_uploaded_file($_FILES["file_name"]["tmp_name"], $n_name)){
                    $data['DOC_NAME'] = $this->input->post('subject_name');
                    $data['UNIQ_FILENAME'] = $n_filename;
                    $data['ORG_FILENAME'] = $fileName;
                    $this->tkd_model->insert_request_image($data);
                    redirect('Compet/upload_file');
                }else{
                    echo "<script>
                        alert('에러!!! 업로드중 에러가 발생했습니다.');
                        </script>";
					redirect('Compet/upload_file');	
                }
            }else{
                echo "<script>
                    alert('에러!!! JPG, JPEG, PNG, GIF 파일만 업로드 됩니다.');
                    </script>";
				redirect('Compet/upload_file');	
            }
        }
    }
    public function upload_request_suyaksu()    {
        $targetDir = "./uploads/";
        $fileName = basename($_FILES["file_name"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $n_filename = uniqid() . '.' . $fileType;
        $n_name = $targetDir . $n_filename;
        if(isset($_POST["submit"]) && !empty($_FILES["file_name"]["name"])){
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array(strtolower($fileType), $allowTypes)){
                if(move_uploaded_file($_FILES["file_name"]["tmp_name"], $n_name)){
                    $data['UNIQ_FILENAME'] = $n_filename;
                    $data['ORG_FILENAME'] = $fileName;
                    $this->tkd_model->insert_request_suyaksu($data);
                    redirect('Compet/upload_suyaksu');
                }else{
                    echo "<script>
                        alert('에러!!! 업로드중 에러가 발생했습니다.');
                        </script>";
					redirect('Compet/upload_suyaksu');	
                }
            }else{
                echo "<script>
                    alert('에러!!! JPG, JPEG, PNG, GIF 파일만 업로드 됩니다.');
                    </script>";
				redirect('Compet/upload_suyaksu');	
            }
        }
    }
    public function delete_request_doc($id)	{
		$this->tkd_model->delete_request_doc($id);
		redirect('Compet/upload_file');
	}
	public function game_match()	{
		$this->load->view('header/header');
		$this->load->view('game_match');
		$this->load->view('header/footer');
	}
	//=======비밀번호 찾기==============================
	public function find_pass()
	{
		$this->load->view('header/header');
		$this->load->view('find_pass');
		$this->load->view('header/footer');
	}
	public function send_password_email(){
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
		$config['charset']  = 'euc-kr';
		$config['newline']  = "\r\n";
		$config['smtp_timeout'] = "10";
		$config['wordwrap'] = TRUE;

		$this->email->clear();
		$this->email->initialize($config);
		
		$uemail=$this->input->post('email');
		$result=$this->tkd_model->get_center_byemail($uemail);
		$pass=$result->LOGIN_PASS;
		//var_dump($uemail);
		//var_dump($pass);
		if($result){
			$this->email->from("ccnplaza@gmail.com" , "관리자"); //보내는 사람
			$this->email->to($uemail); //받는 사람
			$this->email->subject("아이디 비밀번호 찾기 메일"); //메일 제목
			$this->email->message("안녕하세요? 회원님. ".
					"요청하신 회원님의 비밀번호는 다음과 같습니다."."<br><br>".
					"<br>비밀번호: ".$pass."<br><br>".
					"비밀번호를 분실하거나 다른 사람들한테 노출되지 않도록 주의를 부탁드립니다.");

			if ($this->email->send())
			{
				$this->load->view('header/header');
				$this->load->view('email_send_ok');
				$this->load->view('header/footer');
			} else {
				$this->load->view('header/header');
				$this->load->view('email_send_fail');
				$this->load->view('header/footer');
			}
		} else {
			$this->load->view('header/header');
			$this->load->view('email_send_fail');
			$this->load->view('header/footer');
		}
	}

	public function api_get_compatitions()
	{
		$result = $this->tkd_model->api_get_competitions();
		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($result));
		echo iconv("UTF-8", "EUC-KR", $result);
		//$json_str = json_encode($result, JSON_UNESCAPED_UNICODE);
		//echo iconv("UTF-8", "EUC-KR", $json_str);
		//echo iconv("UTF-8", "EUC-KR", $result);
	}
	public function api_get_pointlist()
	{
		$this->load->view('header/header_nomenu');
		$coat_no = $this->input->get('coat');
		$query = $this->db->get_where('GAME_SCORE_REMOTE_IN2', array('COAT_NO'=>$coat_no));
		$compet = array();
		//여러 값을 넘길 때는 array로 필요한 데이트를 추가한다.
		foreach ($query->result_array() as $list) {
			$jongmok = $list['JONGMOK_NAME'];
			$blue = $list['BLUE_NAME'];
			$red = $list['RED_NAME'];
			$item = array();
			$item['ID'] = $list['MATCH_ID'];
			$item['A_NO'] = $list['A_NO'];
			$item['GAME_KIND'] = $list['GAME_KIND'];
			$item['JONGMOK'] = iconv("EUC-KR", "UTF-8", $jongmok);
			$item['BLUE_NAME'] = iconv("EUC-KR", "UTF-8", $blue);
			$item['RED_NAME'] = iconv("EUC-KR", "UTF-8", $red);
			$compet[] = $item;
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($compet, JSON_UNESCAPED_UNICODE));
	}
	public function api_insert_data()
	{
		$data['match_id'] = $this->input->get('id');
		$data['coat'] = $this->input->get('coat');
		$data['judge'] = $this->input->get('judge');
		$data['a_kind'] = $this->input->get('a_kind');
		$data['point'] = $this->input->get('point');
		$this->tkd_model->api_update_score($data);
	}
	public function send_message(){
		$data['cmd'] = $this->input->get('cmd');
		$data['msg'] = $this->input->get('msg');
		$this->load->view('api/send_chat_msg', $data);
	}
}