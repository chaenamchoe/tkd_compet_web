<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {
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
		unset($_SESSION['competition_name']);
		unset($_SESSION['compet_id']);
		unset($_SESSION['coat_no']);
		unset($_SESSION['judge_no']);
		unset($_SESSION['assoc_id']);
		$this->load->view('header/header_nomenu');
		$this->load->view('wrong_url');
	}
	public function wait_game(){
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game');
		$this->load->view('header/m_footer');
	}
	public function check_connection(){
		$this->load->view('header/header_nomenu');
		$this->load->view('point/check_connection');
		$this->load->view('header/m_footer');
	}
	public function return_response(){
		$data['compet_id'] = $_SESSION['compet_id'];
		$data['coat_no'] = $_SESSION['coat_no'];
		$data['judge_no'] =	$_SESSION['judge_no'];
		$result = $this->tkd_model->update_judge_response($data);
		redirect('point/wait_game');
	}
	public function set_compet(){
		$this->load->view('header/header_nomenu');
		$this->load->view('point/set_competition');
		$this->load->view('header/m_footer');
	}
	public function set_competition(){
		$compet_id = $this->input->post('compet_id');
		$coat_no = $this->input->post('coat');
		$judge_no = $this->input->post('judge');
		$this->points($compet_id, $coat_no, $judge_no);
	}
	public function points($compet_id, $coat_no, $judge_no){
		$result = $this->tkd_model->get_competition($compet_id);
		if(count($result) > 0){
			$compet_name = $result->C_NAME;
			$compet_name_e = $result->C_NAME_E;
			$is_international = $result->IS_INTERNATIONAL;
			$_SESSION['competition_name'] = $compet_name;
			$_SESSION['competition_name_e'] = $compet_name_e;
			$_SESSION['compet_id'] = $compet_id;
			$_SESSION['coat_no'] = $coat_no;
			$_SESSION['judge_no'] = $judge_no;
			$_SESSION['is_international'] = $is_international;
			redirect('point/wait_game');
		}else{
			
		}
	}
	public function check_password(){
		$compet_id = $this->input->post('compet_id');
		$coat_no = $this->input->post('coat_no');
		$judge_no = $this->input->post('judge_no');
		$password = $this->input->post('compet_pass');
		$result = $this->tkd_model->get_competition($compet_id);
		$db_password = $result->ONLINE_PASSWORD;
		if($password == $db_password){
			$compet_name = $result->C_NAME;
			$online_password = $result->ONLINE_PASSWORD;
			$_SESSION['compet_pass'] = $password;
			$_SESSION['competition_name'] = $compet_name;
			$_SESSION['compet_id'] = $compet_id;
			$_SESSION['coat_no'] = $coat_no;
			$_SESSION['judge_no'] = $judge_no;
			redirect('point/wait_game');
		}else{
			$data['compet_id'] = $compet_id;
			$data['coat_no'] = $coat_no;
			$data['judge_no'] = $judge_no;
			
			$this->load->view('header/header_nomenu');
			$this->load->view('point/wrong_password', $data);
			$this->load->view('header/m_footer');
		}
	}
	public function show_jongmok(){
		redirect('point/wait_game');
		/*
		$this->load->view('header/header_nomenu');
		$jongmok = $this->tkd_model->get_jongmok_info();
		$_SESSION['judge_count'] = $jongmok->JUDGE_CNT;
		$data['jongmok_id'] = $jongmok->JONGMOK_ID;
		$data['category_id'] = $jongmok->CATEGORY_ID;
		$data['team_methode'] = $jongmok->TEAM_METHODE;
		$data['game_step'] = $jongmok->GAME_STEP;
		$data['game_kind'] = $jongmok->GAME_KIND;
		$data['jo'] = $jongmok->JO_NO;
		$data['pumsae'] = $jongmok->PUMSAE;
		$data['man_cnt'] = $jongmok->MAN_CNT;
		$data['jo_cnt'] = $jongmok->JO_CNT;
		$data['coat_no'] = $_SESSION['coat_no'];
		$data['compet_id'] = $_SESSION['compet_id'];
		$data['jongmok'] = $jongmok->JONGMOK_NAME;
		$data['category'] = $jongmok->CATEGORY_NAME;

		$this->load->view('point/show_jongmok', $data);
		$this->load->view('header/m_footer');
		*/
	}
	public function show_point($kind)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$judge = $_SESSION['judge_no'];
		$jongmok = $this->tkd_model->get_jongmok_info();
		$_SESSION['jongmok_name'] = $jongmok->JONGMOK_NAME;
		if($kind=='15' || $kind=='16' || $kind=='17'){
			$result = $this->tkd_model->get_game_score_list_judge();
		}else{
			$result = $this->tkd_model->get_game_score_list($coat);
		}
		$match_id = $result[0]['MATCH_ID'];
		$id = $result[0]['ID'];
		$_SESSION['match_id'] = $match_id;
		$_SESSION['game_kind'] = $kind;
		$_SESSION['jongmok_name'] = $jongmok->JONGMOK_NAME;
		//var_dump($result);
		if(count($result) > 0){
			$data['result'] = $result;
			if($kind=='11'){
				$this->load->view('point/game_score_single', $data);
			}elseif($kind=='12'){
				$this->load->view('point/game_score_tornament', $data);
			}elseif($kind=='14'){	//두가지 점수입력방식
				$this->load->view('point/game_score_cutoff', $data);
			}elseif($kind=='141'){	//통합점수방식
				$this->load->view('point/game_score_cutoff1', $data);
			}elseif($kind=='15'){	//격파장수 방식
				$this->load->view('point/game_score_break', $data);
				//$this->load->view('point/game_score_jump', $data);
			}elseif($kind=='16'){	//줄넘기 횟수카운터 방식
				$this->load->view('point/point_in_pad_jump1', $data);
			}elseif($kind=='17'){	//겨루기 점수바표출 방식
				$this->score_edit_fight($id);
				//$this->load->view('point/point_in_pad_fight', $data);
			}
		}else{
			redirect('point/wait_game');
		}
	}
	public function refresh_point_input()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$judge = $_SESSION['judge_no'];
		$jongmok = $this->tkd_model->get_jongmok_info();
		$_SESSION['jongmok_name'] = $jongmok->JONGMOK_NAME;
		if($kind=='15' || $kind=='16' || $kind=='17'){
			$result = $this->tkd_model->get_game_score_list_judge();
		}else{
			$result = $this->tkd_model->get_game_score_list($coat);
		}
		$match_id = $result[0]['MATCH_ID'];
		$id = $result[0]['ID'];
		$kind = $result[0]['ACTION_KIND'];
		$_SESSION['match_id'] = $match_id;
		$_SESSION['game_kind'] = $kind;
		$_SESSION['jongmok_name'] = $jongmok->JONGMOK_NAME;
		//var_dump($result);
		if(count($result) > 0){
			$data['result'] = $result;
			if($kind=='11'){
				$this->load->view('point/game_score_single', $data);
			}elseif($kind=='12'){
				$this->load->view('point/game_score_tornament', $data);
			}elseif($kind=='14'){	//두가지 점수입력방식
				$this->load->view('point/game_score_cutoff', $data);
			}elseif($kind=='141'){	//통합점수방식
				$this->load->view('point/game_score_cutoff1', $data);
			}elseif($kind=='15'){	//격파장수 방식
				$this->load->view('point/game_score_break', $data);
				//$this->load->view('point/game_score_jump', $data);
			}elseif($kind=='16'){	//줄넘기 횟수카운터 방식
				$this->load->view('point/point_in_pad_jump1', $data);
			}elseif($kind=='17'){	//겨루기 점수바표출 방식
				$this->score_edit_fight($id);
				//$this->load->view('point/point_in_pad_fight', $data);
			}
		}else{
			redirect('point/wait_game');
		}
	}
	public function score_edit_fight($id)
	{
		$this->load->view('header/header_nomenu');
		$data['id'] = $id;
		$result=$this->tkd_model->get_game_score_list_id($id);
		$data['jongmok'] = $_SESSION['jongmok_name'];
		$kind = $_SESSION['game_kind'];
		$data['a_name'] = $result->A_NAME.'-'.$result->A_CENTER;
		$data['result'] = $result;
		//var_dump($result);
		$this->load->view('point/point_in_pad_fight', $data);
		$this->load->view('header/m_footer');
	}
	public function done_judge(){
		$this->tkd_model->update_point_done();
		redirect('point/wait_game');
	}
	public function save_point(){
		$cnt = $this->input->post('cnt');
		for($i=1;$i<=$cnt;$i++){
			$id = $this->input->post('id'.$i);
			$point = $this->input->post('point'.$i);
			
			$data['id'] = $id;
			$data['point'] = $point;
			$data['judge_no'] = $_SESSION['judge_no'];
			$this->tkd_model->update_score($data);
			//var_dump($data);
		} 
		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];
		
		//$this->show_point($_SESSION['game_kind']);
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
	}
	public function save_point_cutoff(){
		$cnt = $this->input->post('cnt');
		for($i=1;$i<=$cnt;$i++){
			$id = $this->input->post('id'.$i);
			$point1 = $this->input->post('point1'.$i);
			$point2 = $this->input->post('point2'.$i);
			
			$data['id'] = $id;
			$data['point1'] = $point1;
			$data['point2'] = $point2;
			$data['judge_no'] = $_SESSION['judge_no'];
			$this->tkd_model->update_score_cutoff($data);
			//var_dump($data);
		} 
		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];
		
		//$this->show_point($_SESSION['game_kind']);
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
	}
	public function save_point_cutoff1(){
		$cnt = $this->input->post('cnt');
		for($i=1;$i<=$cnt;$i++){
			$id = $this->input->post('id'.$i);
			$point1 = $this->input->post('point1'.$i);
			
			$data['id'] = $id;
			$data['point1'] = $point1;
			$data['judge_no'] = $_SESSION['judge_no'];
			$this->tkd_model->update_score_cutoff1($data);
			//var_dump($data);
		} 
		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];
		
		//$this->show_point($_SESSION['game_kind']);
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
	}
	public function save_point_torn(){
		$cnt = $this->input->post('cnt');
		$bid = $this->input->post('bid');
		$bpoint1 = $this->input->post('bpoint1');
		$bpoint2 = $this->input->post('bpoint2');
		$rid = $this->input->post('rid');
		$rpoint1 = $this->input->post('rpoint1');
		$rpoint2 = $this->input->post('rpoint2');
		
		$data['bid'] = $bid;
		$data['rid'] = $rid;
		$data['bpoint1'] = $bpoint1;
		$data['bpoint2'] = $bpoint2;
		$data['rpoint1'] = $rpoint1;
		$data['rpoint2'] = $rpoint2;
		$data['judge_no'] = $_SESSION['judge_no'];
		$this->tkd_model->update_score_torn($data);
		//var_dump($data);

		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];
		
		//$this->show_point($_SESSION['game_kind']);
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
	}
	public function save_point_break(){
		$id = $this->input->post('id');
		$point = $this->input->post('point');
		
		$data['id'] = $id;
		$data['point'] = $point;
		$data['judge_no'] = $_SESSION['judge_no'];
		//var_dump($data);
		
		$this->tkd_model->update_score_break($data);
		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];
		
		//$this->show_point($_SESSION['game_kind']);
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
		
	}
	public function save_point_jump($id, $point){
		$data['id'] = $id;
		$data['point'] = $point;
		$data['judge_no'] = $_SESSION['judge_no'];
		//var_dump($data);
		
		$this->tkd_model->update_score_jump1($data);
		//var_dump($data);
		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];

		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
		
	}
	public function save_point_fight(){
		$this->tkd_model->update_point_done();
		$info['compet_name'] = $_SESSION['competition_name'];
		$info['coat'] = $_SESSION['coat_no'];
		$info['judge'] = $_SESSION['judge_no'];
		$info['match_id'] = $_SESSION['match_id'];
		$this->load->view('header/header_nomenu');
		$this->load->view('point/wait_game', $info);
		$this->load->view('header/m_footer');
	}
	public function get_match_id() {
		$match = $this->tkd_model->get_match_id();
		if(isset($match)){
			$match_id = $match->MATCH_ID;
		}else{
			$match_id = 0;
		}
		$this->output->set_output($match_id);
	}
	public function no_score_data()	{
		$this->load->view('header/header_nomenu');
		$this->load->view('point/no_score_data');
	}
	public function score_edit($id)
	{
		$this->load->view('header/header_nomenu');
		$data['id'] = $id;
		$result=$this->tkd_model->get_game_score_list_id($id);
		$data['jongmok'] = $_SESSION['jongmok_name'];
		$data['a_name'] = $result->A_NAME.'-'.$result->A_CENTER;
		$this->load->view('point/point_in_pad', $data);
		$this->load->view('header/m_footer');
	}
	public function score_edit_break($id)
	{
		$this->load->view('header/header_nomenu');
		$data['id'] = $id;
		$result=$this->tkd_model->get_game_score_list_id($id);
		$data['jongmok'] = $_SESSION['jongmok_name'];
		$data['a_name'] = $result->A_NAME.'-'.$result->A_CENTER;
		$this->load->view('point/point_in_pad_break', $data);
		$this->load->view('header/m_footer');
	}
	public function score_edit_jump1($id)
	{
		$this->load->view('header/header_nomenu');
		$data['id'] = $id;
		$result=$this->tkd_model->get_game_score_list_id($id);
		$data['jongmok'] = $_SESSION['jongmok_name'];
		$kind = $_SESSION['game_kind'];
		$data['a_name'] = $result->A_NAME.'-'.$result->A_CENTER;
		$this->load->view('point/point_in_pad_jump1', $data);
		$this->load->view('header/m_footer');
	}
	public function score_edit_jump2($id)
	{
		$this->load->view('header/header_nomenu');
		$data['id'] = $id;
		$result=$this->tkd_model->get_game_score_list_id($id);
		$data['jongmok'] = $_SESSION['jongmok_name'];
		$kind = $_SESSION['game_kind'];
		$data['a_name'] = $result->A_NAME.'-'.$result->A_CENTER;
		$this->load->view('point/point_in_pad_jump2', $data);
		$this->load->view('header/m_footer');
	}
	public function update_score($id, $point)
	{
		$data['id'] = $id;
		$data['point'] = $point;
		$data['judge_no'] = $_SESSION['judge_no'];
		$this->tkd_model->update_score($data);
		//redirect('point/show_point/'.$_SESSION['game_kind']);
		//var_dump($data);
		$this->show_point($_SESSION['game_kind']);
	}
	public function update_score_break($id, $point)
	{
		$data['id'] = $id;
		$data['point'] = $point;
		$this->tkd_model->update_score_break($data);
		$this->show_point($_SESSION['game_kind']);
	}
	public function update_score_jump1($id, $point)
	{
		$data['id'] = $id;
		$data['point'] = $point;
		$data['judge_no'] = $_SESSION['judge_no'];
		$this->tkd_model->update_score_jump1($data);
		$this->show_point($_SESSION['game_kind']);
	}
	public function update_score_jump2($id, $point)
	{
		$data['id'] = $id;
		$data['point'] = $point;
		$data['judge_no'] = $_SESSION['judge_no'];
		$this->tkd_model->update_score_jump2($data);
		$this->show_point($_SESSION['game_kind']);
	}
	public function update_score_fight($id, $point)
	{
		$data['id'] = $id;
		$data['point'] = $point;
		$data['judge_no'] = $_SESSION['judge_no'];
		$this->tkd_model->update_score_fight($data);
		//$this->show_point($_SESSION['game_kind']);
		redirect('point/wait_game');
	}
	public function update_score_fight2()
	{
		$data['id'] = $this->input->post('id');
		$data['point'] = $this->input->post('point');
		$data['judge_no'] = $_SESSION['judge_no'];
		$this->tkd_model->update_score_fight($data);
		//$this->tkd_model->insert_game_score_time($data);
		//$this->show_point($_SESSION['game_kind']);
		//redirect('point/wait_game');
	}
}