<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
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
		$this->load->view('header/header_nomenu');
		$_SESSION['assoc_id'] = 0;
		$_SESSION['country'] = 0;
		$this->load->view('wrong_url');
        $this->load->view('header/m_footer');
	}
	public function check_compet(){
		$this->load->view('header/header_nomenu');
		$act_compet = $this->tkd_model->get_online_competition();
		if(count($act_compet) === 1){
			$is_international = $act_compet[0]['IS_INTERNATIONAL'];
			$_SESSION['is_international'] = $is_international;
			if($is_international == 1){
				$this->load->view('video/select_country');	
			}else{
				$compet_id = $act_compet[0]['ID'];
				$data['compet_list'] = $act_compet;
				$this->load->view('video/select_compet', $data);
				//$this->save_competition($compet_id);	
			}
		}else{
			$this->load->view('no_active_competition');
		}
	}
	public function set_country($country=0){
		$_SESSION['country'] = $country;
		//$_SESSION[('country', $country, 0);
		//$this->videos();
		redirect('video/videos');
	}
	public function play_youtube_video($video_id){
		$this->load->view('header/header_nomenu');
		$result = $this->tkd_model->get_youtube_video($video_id);
		$data['video_url'] = $result->LINK1;
		//var_dump($result);
		$this->load->view('youtube/play_youtube_video', $data);  //youtube video...
		$this->load->view('header/m_footer');
	}
	public function assoc($assoc, $coat=1, $country=0){
		$assoc_result = $this->tkd_model->get_associations_siteurl($assoc);
		if(!empty($assoc_result)){
			$assoc_id = $assoc_result[0]['ID'];
			$_SESSION['site_title'] = $assoc_result[0]['A_NAME'];
			$_SESSION['assoc_tel'] = $assoc_result[0]['A_CONTACT'];
			$_SESSION['assoc_addr'] = $assoc_result[0]['A_ADDR'];
			$_SESSION['assoc_id'] = $assoc_id;
			$_SESSION['country'] = $country;
			$_SESSION['use_agree'] = 0;

			$act_compet = $this->tkd_model->get_active_competition();
			if(count($act_compet) > 0){
				$compet_id = $act_compet[0]['ID'];
				$compet_name = $act_compet[0]['C_NAME'];
				$judge_cnt_methode = $act_compet[0]['KIND1'];
				$_SESSION['compet_id'] = $compet_id;
				$_SESSION['coat_no'] = $coat;
				$_SESSION['competition_name'] = $compet_name;
				$_SESSION['judge_count'] = $judge_cnt_methode;
				redirect('video/show_compet_name');
			}else{
				$this->load->view('header/header_nomenu');
				if($_SESSION['country'] == 0){
					$this->load->view('no_active_competition');
				}else{
					$this->load->view('no_active_competition_e');
				}
			}
		}else{
			$this->load->view('header/header_nomenu');
			$this->load->view('no_active_competition');
		}
	}

	/////////////////////////////
	// 비디오 플레이
	/////////////////////////////
	public function save_competition($id, $coat){
		$result = $this->tkd_model->get_competition($id);
		$compet_name = $result->C_NAME;
		$judge_cnt_methode = $result->KIND1;
		$data['compet_name'] = $compet_name;
		$_SESSION['center_id'] = $id;
		$_SESSION['coat_no'] = $coat;
		$_SESSION['competition_name'] = $compet_name;
		$_SESSION['judge_count'] = $judge_cnt_methode;
		redirect('video/show_compet_name');
	}
	//대회명표출...
	public function videos($compet_id, $coat_no=1, $country=0){
		$this->load->view('header/header_nomenu');
		$_SESSION['compet_id'] = $compet_id; 
		$_SESSION['coat_no'] = $coat_no;
		$_SESSION['country'] = $country;
		$result = $this->tkd_model->get_competition_info($compet_id);
		$is_international = $result[0]['IS_INTERNATIONAL'];
		$_SESSION['is_international'] = $is_international;
		$_SESSION['judge_count'] = $result[0]['KIND1'];
		$_SESSION['use_athlete_picture'] = $result[0]['NEED_PICTURE'];
		$compet['results'] = $result;
		$compet['coat_no'] = $_SESSION['coat_no'];
		//var_dump($result);
		redirect('video/show_compet_name');
	}
	public function show_compet_name(){
		$compet_id = $_SESSION['compet_id']; 
		$this->load->view('header/header_nomenu');
		$options = $this->tkd_model->get_compet_options($compet_id);
		if($options){
			$_SESSION['use_animation'] = $options->USE_ANIMATION;
			$_SESSION['show_centername'] = $options->SHOW_CENTERNAME;
			$video_quality = $options->VIDEO_QUALITY;
			if($video_quality==0){
				$_SESSION['video_quality'] = 'auto';
			}else if($video_quality==1){
				$_SESSION['video_quality'] = '240p';
			}else if($video_quality==2){
				$_SESSION['video_quality'] = '360p';
			}else if($video_quality==3){
				$_SESSION['video_quality'] = '540p';
			}else if($video_quality==4){
				$_SESSION['video_quality'] = '720p';
			}else if($video_quality==5){
				$_SESSION['video_quality'] = '1080p';
			}
		}else{
			$_SESSION['use_animation'] = 0;
			$_SESSION['show_centername'] = 0;
			$_SESSION['video_quality'] = 'auto';
		}
		$result = $this->tkd_model->get_competition_info($compet_id);
		$sponsor = $this->tkd_model->get_competition_sponsor($compet_id);
		$compet['results'] = $result;
		$compet['sponsor'] = $sponsor;
		$compet['coat_no'] = $_SESSION['coat_no'];
		$compet['compet_id'] = $compet_id;
		//var_dump($compet);
		$this->load->view('video/show_compet_name', $compet);
		$this->load->view('header/m_footer');
	}
	//이미지표출...
	public function show_image($url){
		$this->load->view('header/header_nomenu');
		$data['url'] = $url;
		$this->load->view('video/show_image', $data);
		$this->load->view('header/m_footer');
	}
	//메시지표출...
	public function get_tv_message(){
		$msg_id = $this->input->post('id');
		$post = $this->tkd_model->get_tv_message($msg_id);
		$msg = iconv("EUC-KR", "UTF-8", $post->TV_MESSAGE); //$post->TV_MESSAGE;
		$data = array("msg"=>"success", "post" => $msg);
		echo json_encode($data);
	}
	public function show_message(){
		$this->load->view('header/header_nomenu');
		$compet_id = $_SESSION['center_id']; 
		$compet['coat_no'] = $_SESSION['coat_no'];
		$result = $this->tkd_model->get_active_message();
		$data['message'] = $result->TV_MESSAGE;
		$this->load->view('video/show_message', $data);
		$this->load->view('header/m_footer');
	}
	//
	public function get_jongmok_info(){
		$jongmok = $this->tkd_model->get_jongmok_info();
		//var_dump($result);
		$_SESSION['judge_count'] = $jongmok->JUDGE_CNT;
		$data['jongmok_id'] = $jongmok->JONGMOK_ID;
		$data['category_id'] = $jongmok->CATEGORY_ID;
		$data['team_methode'] = $jongmok->TEAM_METHODE;
		$data['game_step'] = $jongmok->GAME_STEP;
		$data['game_kind'] = $jongmok->GAME_KIND;
		$data['jo'] = $jongmok->JO_NO;
		$data['pumsae'] = $jongmok->PUMSAE;
		$country_code = $_SESSION['country'];
		if($country_code==1){
			$result_jongmok = $this->tkd_model->select_jongmok($jongmok->JONGMOK_ID);
			$result_category = $this->tkd_model->get_category_by_id($jongmok->CATEGORY_ID);
			$data['jongmok'] = $result_jongmok[0]['JONGMOK_NAME_E'];
			$data['category'] = $result_category[0]['CATEGORY_NAME_E'];
		}else{
			$data['jongmok'] = $jongmok->JONGMOK_NAME;
			$data['category'] = $jongmok->CATEGORY_NAME;
		}
		return $data;
	}
	public function show_jongmok($act_kind){
		$this->load->view('header/header_nomenu');
		$jongmok = $this->tkd_model->get_jongmok_info();
		$_SESSION['judge_count'] = $jongmok->JUDGE_CNT;
		$data['judge_count'] = $jongmok->JUDGE_CNT;
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
		$sponsor = $this->tkd_model->get_competition_sponsor($_SESSION['compet_id']);
		$data['sponsor'] = $sponsor;
		$judge = $this->tkd_model->get_judge_assign_game($jongmok->MATCH_ID);
		if ($judge){
			$data['judge'] = $judge;
		}else{
			$data['judge'] = null;
		}
		//var_dump($compet);
		if($act_kind == "101"){
			$data['show_judge_picture'] = 1;
		}else{
			$data['show_judge_picture'] = 2;
		}
		if($_SESSION['country']==1){
			$result_jongmok = $this->tkd_model->select_jongmok($jongmok->JONGMOK_ID);
			$result_category = $this->tkd_model->get_category_by_id($jongmok->CATEGORY_ID);
			$data['jongmok'] = $result_jongmok[0]['JONGMOK_NAME_E'];
			$data['category'] = $result_category[0]['CATEGORY_NAME_E'];
		}else{
			$data['jongmok'] = $jongmok->JONGMOK_NAME;
			$data['category'] = $jongmok->CATEGORY_NAME;
		}
		$this->load->view('video/show_jongmok', $data);
		$this->load->view('header/m_footer');
	}
	public function show_judge($act_kind){
		$this->load->view('header/header_nomenu');
		$jongmok = $this->tkd_model->get_jongmok_info();
		//$_SESSION['judge_count'] = $jongmok->JUDGE_CNT;
		//$data['judge_count'] = $jongmok->JUDGE_CNT;

		$data['coat_no'] = $_SESSION['coat_no'];
		$data['compet_id'] = $_SESSION['compet_id'];
		$sponsor = $this->tkd_model->get_competition_sponsor($_SESSION['compet_id']);
		$data['sponsor'] = $sponsor;
		//$judge = $this->tkd_model->get_judge_assign_game($jongmok->MATCH_ID);
		$judge = $this->tkd_model->get_judge_assign();
		if ($judge){
			$data['judge'] = $judge;
		}else{
			$data['judge'] = null;
		}
		//var_dump($compet);
		if($act_kind == "103"){
			$data['show_judge_picture'] = 1;	//사진표출
		}else{
			$data['show_judge_picture'] = 2;	//사진표출안함
		}
		$this->load->view('video/show_judge', $data);
		$this->load->view('header/m_footer');
	}
	public function athletes_cutoff($game_jongmok)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$compet_id = $_SESSION['compet_id'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		$this->load->view('video/athletes_cutoff', $ndata);
		$this->load->view('header/m_footer');
	}
	public function athletes_fight($game_jongmok)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$compet_id = $_SESSION['compet_id'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		$this->load->view('video/athletes_fight', $ndata);
		$this->load->view('header/m_footer');
	}
	public function athletes_team()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$compet_id = $_SESSION['compet_id'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/athletes_team', $ndata);  //youtube video...
		$this->load->view('header/m_footer');
	}
	public function athletes_tonament()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$compet_id = $_SESSION['compet_id'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		$this->load->view('video/athletes_tonament', $ndata);  //youtube video...
		$this->load->view('header/m_footer');
	}
	public function result_cutoff($game_jongmok)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list2($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		//var_dump($result);
		if(count($result) > 0){
			if($game_jongmok==34){
				$this->load->view('video/result_cutoff', $ndata);
			}else if($game_jongmok==345){
				$this->load->view('video/result_cutoff5', $ndata);
			}else{
				$this->load->view('video/result_cutoff_count', $ndata);
			}
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
		}
		$this->load->view('header/m_footer');
	}
	public function result_fight()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		//$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list2($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		//var_dump($result);
		if(count($result) > 0){
			$this->load->view('video/result_fight', $ndata);
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
		}
		$this->load->view('header/m_footer');
	}
	public function result_cutoff_count($game_jongmok)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list2($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		//var_dump($result);
		if(count($result) > 0){
			$this->load->view('video/result_cutoff_count', $ndata);
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
		}
		$this->load->view('header/m_footer');
	}
	public function result_cutoff_tonament($cat, $jo)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list3($coat);
		$data['lists'] = $result;
		$data['cat_id'] = $cat;
		$data['jo'] = $jo;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		//var_dump($result);
		if(count($result) > 0){
			$this->load->view('video/result_cutoff_tonament', $ndata);
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
		}
		$this->load->view('header/m_footer');
	}
	public function result_cutoff_team()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		//var_dump($result);
		if(count($result) > 0){
			$this->load->view('video/result_cutoff_team', $ndata);
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function result_tonament()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		//var_dump($result);
		if(count($result) > 0){
			$this->load->view('video/result_tonament', $ndata);
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function result_tonament_one()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		$data['lists'] = $result;
		$ndata = array_merge($data, $jongmok);
		$this->load->view('video/header_play_videos', $ndata);
		//var_dump($result);
		if(count($result) > 0){
			$this->load->view('video/result_tonament_one', $ndata);
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_videos_cutoff($game_jongmok)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_checked($coat);
		//var_dump($result);
		if(count($result) > 0){
			$rec_cnt = count($result);
			$a_name = [];
			$c_name = [];
			$video_id = [];
			$country = [];
			$unattend = [];
			$i = 0;
			foreach ($result as $row){
				$video_id[$i] = $row['VIDEO_ID'];
				$video_uid[$i] = $row['VIDEO_ID'];
				$a_name[$i] = $row['A_NAME'];
				$c_name[$i] = $row['A_CENTER'];
				$a_orderno[$i] = $row['A_ORDERNO'];
				$unattend[$i] = $row['UNATTEND'];
				$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
				$country[$i] = $country_data->COUNTRY_ENG;
				$i++;
			}
			$data['rec_cnt'] = $rec_cnt;
			$data['a_name'] = $a_name;
			$data['c_name'] = $c_name;
			$data['a_orderno'] = $a_orderno;
			$data['video_id'] = $video_id;
			$data['video_uid'] = $video_uid;
			$data['country'] = $country;
			$data['unattend'] = $unattend;
			$data['video_quality'] = $_SESSION['video_quality'];
			$ndata = array_merge($data, $jongmok);
			$this->load->view('video/header_play_videos', $ndata);
			//var_dump($data);
			if($rec_cnt == 1){
				$this->load->view('video/play_videos_1', $ndata);  //youtube video...
			}else if($rec_cnt == 2){
				$this->load->view('video/play_videos_2', $ndata);  //youtube video...
			}else if($rec_cnt == 3){
				$this->load->view('video/play_videos_3', $ndata);  //youtube video...
			}else if($rec_cnt == 4){
				$this->load->view('video/play_videos_4', $ndata);  //youtube video...
			}
			
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_videos_fight($game_jongmok)
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$_SESSION['game_jongmok'] = $game_jongmok;
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_checked($coat);
		//var_dump($result);
		if(count($result) > 0){
			$rec_cnt = count($result);
			$a_name = [];
			$c_name = [];
			$video_id = [];
			$country = [];
			$unattend = [];
			$i = 0;
			foreach ($result as $row){
				$video_id[$i] = $row['VIDEO_ID'];
				$video_uid[$i] = $row['VIDEO_ID'];
				$a_name[$i] = $row['A_NAME'];
				$c_name[$i] = $row['A_CENTER'];
				$a_orderno[$i] = $row['A_ORDERNO'];
				$unattend[$i] = $row['UNATTEND'];
				$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
				$country[$i] = $country_data->COUNTRY_ENG;
				$i++;
			}
			$data['rec_cnt'] = $rec_cnt;
			$data['a_name'] = $a_name;
			$data['c_name'] = $c_name;
			$data['a_orderno'] = $a_orderno;
			$data['video_id'] = $video_id;
			$data['video_uid'] = $video_uid;
			$data['country'] = $country;
			$data['unattend'] = $unattend;
			$data['video_quality'] = $_SESSION['video_quality'];
			$ndata = array_merge($data, $jongmok);
			$this->load->view('video/header_play_videos', $ndata);
			//var_dump($data);
			if($rec_cnt == 1){
				$this->load->view('video/play_videos_fight_1', $ndata);  //youtube video...
			}else if($rec_cnt == 2){
				$this->load->view('video/play_videos_fight_2', $ndata);  //youtube video...
			}else if($rec_cnt == 3){
				$this->load->view('video/play_videos_fight_3', $ndata);  //youtube video...
			}else if($rec_cnt == 4){
				$this->load->view('video/play_videos_fight_4', $ndata);  //youtube video...
			}
			
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_videos_team()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_checked($coat);
		//var_dump($result);
		if(count($result) > 0){
			$rec_cnt = count($result);
			$a_name = [];
			$c_name = [];
			$video_id = [];
			$country = [];
			$unattend = [];
			$i = 0;
			foreach ($result as $row){
				$video_id[$i] = $row['VIDEO_ID'];
				$video_uid[$i] = $row['VIDEO_ID'];
				$a_name[$i] = $row['A_NAME'];
				$c_name[$i] = $row['A_CENTER'];
				$unattend[$i] = $row['UNATTEND'];
				$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
				$country[$i] = $country_data->COUNTRY_ENG;
				$i++;
			}
			$data['rec_cnt'] = $rec_cnt;
			$data['a_name'] = $a_name;
			$data['c_name'] = $c_name;
			$data['video_id'] = $video_id;
			$data['video_uid'] = $video_uid;
			$data['country'] = $country;
			$data['unattend'] = $unattend;
			$data['video_quality'] = $_SESSION['video_quality'];
			$ndata = array_merge($data, $jongmok);
			//var_dump($data);
			$this->load->view('video/header_play_videos', $ndata);
			$this->load->view('video/play_videos_1', $ndata);  //youtube video...
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_videos_tonament()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		//var_dump($result);
		if(count($result) > 0){
			$rec_cnt = count($result);
			$a_name = [];
			$c_name = [];
			$video_id = [];
			$country = [];
			$unattend = [];
			$i = 0;
			foreach ($result as $row){
				$video_id[$i] = $row['VIDEO_ID'];
				$video_uid[$i] = $row['VIDEO_ID'];
				$a_name[$i] = $row['A_NAME'];
				$c_name[$i] = $row['A_CENTER'];
				$unattend[$i] = $row['UNATTEND'];
				$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
				if(isset($country_data)){
					$country[$i] = $country_data->COUNTRY_ENG;
				}
				$i++;
			}
			$data['rec_cnt'] = $i;
			$data['a_name'] = $a_name;
			$data['c_name'] = $c_name;
			$data['video_id'] = $video_id;
			$data['video_uid'] = $video_uid;
			$data['country'] = $country;
			$data['unattend'] = $unattend;
			$data['video_quality'] = $_SESSION['video_quality'];
			$ndata = array_merge($data, $jongmok);
			$this->load->view('video/header_play_videos', $ndata);
			//var_dump($data);
			if($video_id[0] <> '' && $video_id[1] <> ''){	//선수가 두명 다 있을때...
				$this->load->view('video/play_videos_tornament', $ndata);
			}
			if($video_id[0] <> '' && $video_id[1] == ''){
				$this->load->view('video/play_videos_tornament_1', $ndata);
			}
			if($video_id[1] <> '' && $video_id[0] == ''){
				$this->load->view('video/play_videos_tornament_2', $ndata);
			}
			if($video_id[1] == '' && $video_id[0] == ''){
				$this->athletes_tonament();
			}
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_videos_tonament1()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		//var_dump($result);
		if(count($result) > 0){
			$rec_cnt = count($result);
			$a_name = [];
			$c_name = [];
			$video_id = [];
			$country = [];
			$unattend = [];
			$i = 0;
			foreach ($result as $row){
				$video_id[$i] = $row['VIDEO_ID'];
				$video_uid[$i] = $row['VIDEO_ID'];
				$a_name[$i] = $row['A_NAME'];
				$c_name[$i] = $row['A_CENTER'];
				$unattend[$i] = $row['UNATTEND'];
				$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
				if(isset($country_data)){
					$country[$i] = $country_data->COUNTRY_ENG;
				}
				$i++;
			}
			$data['rec_cnt'] = $i;
			$data['a_name'] = $a_name;
			$data['c_name'] = $c_name;
			$data['video_id'] = $video_id;
			$data['video_uid'] = $video_uid;
			$data['country'] = $country;
			$data['unattend'] = $unattend;
			$data['video_quality'] = $_SESSION['video_quality'];
			$ndata = array_merge($data, $jongmok);
			$this->load->view('video/header_play_videos', $ndata);
			//var_dump($data);
			$this->load->view('video/play_videos_tornament_1', $ndata);
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_videos_tonament2()
	{
		$this->load->view('header/header_nomenu');
		$coat = $_SESSION['coat_no'];
		$jongmok = $this->get_jongmok_info();
		$result=$this->tkd_model->get_game_score_list($coat);
		//var_dump($result);
		if(count($result) > 0){
			$rec_cnt = count($result);
			$a_name = [];
			$c_name = [];
			$video_id = [];
			$country = [];
			$unattend = [];
			$i = 0;
			foreach ($result as $row){
				$video_id[$i] = $row['VIDEO_ID'];
				$video_uid[$i] = $row['VIDEO_ID'];
				$a_name[$i] = $row['A_NAME'];
				$c_name[$i] = $row['A_CENTER'];
				$unattend[$i] = $row['UNATTEND'];
				$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
				if(isset($country_data)){
					$country[$i] = $country_data->COUNTRY_ENG;
				}
				$i++;
			}
			$data['rec_cnt'] = $i;
			$data['a_name'] = $a_name;
			$data['c_name'] = $c_name;
			$data['video_id'] = $video_id;
			$data['video_uid'] = $video_uid;
			$data['country'] = $country;
			$data['unattend'] = $unattend;
			$data['video_quality'] = $_SESSION['video_quality'];
			$ndata = array_merge($data, $jongmok);
			$this->load->view('video/header_play_videos', $ndata);
			//var_dump($data);
			$this->load->view('video/play_videos_tornament_2', $ndata);
			$this->load->view('header/m_footer');
		}else{
			unset($_SESSION['coat_no']);
			$this->load->view('no_data');
			$this->load->view('header/m_footer');
		}
	}
	public function play_special_videos($data_id)
	{
		$this->load->view('header/header_nomenu');
		$result = $this->tkd_model->get_video_list($data_id);
		//var_dump($result);
		$video_url = $result->DATA_URL;
		$video_id = $video_url;
		$data['video_id'] = $video_id;
		$data['data_id'] = $data_id;
		$_SESSION['data_id'] = $data_id;
		$this->load->view('video/play_special_videos', $data);  //youtube video...
		$this->load->view('header/m_footer');
	}
	public function play_adver_videos($video_url)
	{
		$this->load->view('header/header_nomenu');
		//$result = $this->tkd_model->get_video_list($data_id);
		//var_dump($result);
		$video_url = $video_url;
		$video_id = $video_url;
		$data['video_id'] = $video_id;
		//$data['data_id'] = $data_id;
		//$_SESSION['data_id'] = $data_id;
		$this->load->view('video/play_adver_videos', $data);  //youtube video...
		$this->load->view('header/m_footer');
	}
	public function update_player_status(){
		$done = $this->input->post('done');
		$result=$this->tkd_model->update_player_status($done);
	}
	public function update_video_status(){
		$done = $this->input->post('done');
		$result=$this->tkd_model->update_video_status();
	}
}