<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {
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
		$_SESSION['assoc_id'] = 0;
		redirect('process/select_competition');
	}
	public function assoc($assoc){
		$assoc_result = $this->tkd_model->get_associations_siteurl($assoc);
		if($assoc_result){
			//var_dump($assoc_result);
			$assoc_id = $assoc_result[0]['ID'];
			$_SESSION['assoc_id'] = $assoc_id;
			redirect('process/select_competition');
		}else{
			$this->load->view('header/header_nomenu');
			$this->load->view('no_active_competition');
		}
	}
	//실행중인 대회선택...
	public function select_competition()	{
		$this->load->view('header/header_nomenu');
		$act_compet = $this->tkd_model->get_online_competition();
		if(count($act_compet) > 0){
			$data['compet_list'] = $act_compet;			
			$this->load->view('process/select_compet', $data);
		}else{
			$this->load->view('header/header_nomenu');
			$this->load->view('no_active_competition');
		}
	}
	public function save_competition($compet_id, $coat_no)	{
		$this->load->view('header/header_nomenu');
		$result = $this->tkd_model->get_competition_info($compet_id);
		//var_dump($result);
		$_SESSION['competition_id'] = $compet_id;
		$_SESSION['compatition_name'] = $result[0]['C_NAME'];
		$_SESSION['coat_no'] = $coat_no;
		$compet['results'] = $result;
		$compet['coat_no'] = $coat_no;
		
		$this->load->view('process/show_compet_name', $compet);
	}
	public function get_jongmok_info(){
		$jongmok = $this->tkd_model->get_jongmok_info();
		//var_dump($result);
		$data['jongmok_id'] = $jongmok->JONGMOK_ID;
		$data['category_id'] = $jongmok->CATEGORY_ID;
		$data['team_methode'] = $jongmok->TEAM_METHODE;
		$data['game_step'] = $jongmok->GAME_STEP;
		$data['game_kind'] = $jongmok->GAME_KIND;
		$data['jo'] = $jongmok->JO_NO;
		$data['pumsae'] = $jongmok->PUMSAE;
		$data['jongmok'] = $jongmok->JONGMOK_NAME;
		$data['category'] = $jongmok->CATEGORY_NAME;
		return $data;
	}
	public function show_list($category_id, $match_id){
		$this->load->view('header/header_nomenu');
		$jongmok = $this->get_jongmok_info();
		$result = $this->tkd_model->get_game_list_by_coat($category_id);

		$data['match_list'] = $result;
		$data['match_id'] = $match_id;
		$ndata = array_merge($data, $jongmok);
		//var_dump($result);
		if($ndata['game_kind'] == 0){	//토너먼트
			$this->load->view('process/match_list2', $ndata);	
		}else{					//컷오프
			$this->load->view('process/match_list', $ndata);	
		}
	}
}