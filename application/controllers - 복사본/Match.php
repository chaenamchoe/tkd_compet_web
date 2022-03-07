<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {
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
		redirect('match/select_competition');
	}
	public function assoc($assoc){
		$assoc_result = $this->tkd_model->get_associations_siteurl($assoc);
		if($assoc_result){
			//var_dump($assoc_result);
			$assoc_id = $assoc_result[0]['ID'];
			$_SESSION['assoc_id'] = $assoc_id;
			redirect('match/select_competition');
		}
	}
	//대회선택...
	public function select_competition()	{
		$this->load->view('header/header_nomenu');
		$act_compet = $this->tkd_model->get_online_competition();
		if(!empty($act_compet)){
			$data['compet_list'] = $act_compet;			
			$this->load->view('match/select_compet', $data);
		}else{
			$this->load->view('no_active_competition');
		}
        $this->load->view('header/m_footer');
	}
	public function save_competition($id){
		$result = $this->tkd_model->get_competition($id);
		$compet_name = $result->C_NAME;
		$data['compet_name'] = $compet_name;

		$_SESSION['compet_id'] = $id;
		$_SESSION['competition_name'] = $compet_name;
		redirect('match/match_list');
	}
	public function matches($compet_id, $country=0){
		$result = $this->tkd_model->get_competition($compet_id);
		$_SESSION['country'] = $country;
		if($country > 0){
			$compet_name = $result->C_NAME_E;
			$show_youtube = $result->KIND3;
			$data['compet_name'] = $compet_name;
			$_SESSION['compet_id'] = $compet_id;
			$_SESSION['competition_name'] = $compet_name;
			$_SESSION['show_youtube'] = $show_youtube;
			$_SESSION['is_international'] = $result->IS_INTERNATIONAL;
			redirect('match/match_list_e');
		}else{
			$compet_name = $result->C_NAME;
			$show_youtube = $result->KIND3;
			$data['compet_name'] = $compet_name;
			$_SESSION['compet_id'] = $compet_id;
			$_SESSION['competition_name'] = $compet_name;
			$_SESSION['show_youtube'] = $show_youtube;
			$_SESSION['is_international'] = $result->IS_INTERNATIONAL;
			redirect('match/match_list');
		}
	}
	public function match_list($jongmok=0, $category = 0){
		$compet_id = $_SESSION['compet_id'];
		if($compet_id==36){
			$this->load->view('header/header_ambar');
		}else{
			$this->load->view('header/header_nomenu');
		}
		$result_jongmok = $this->tkd_model->get_jongmok_all($compet_id);
		if($jongmok > 0){
			$jongmok_id = $jongmok;
		}else{
			$jongmok_id = $result_jongmok[0]['ID'];
		}
		$result_category = $this->tkd_model->get_category($jongmok_id);
		if($category > 0){
			$category_id = $category;
		}else{
			$category_id = $result_category[0]['ID'];
		}
		$data['jongmok'] = $result_jongmok;
		$data['category'] = $result_category;
		$data['jongmok_id'] = $jongmok_id;
		$data['category_id'] = $category_id;
		$data['game_methode'] = $result_category[0]['C_METHODE'];
		//$data['match_list'] = $this->tkd_model->get_score_mix_view($category_id);
		$data['match_list'] = $this->tkd_model->get_match_list($category_id);
		$this->load->view('match/match_list', $data);
		$this->load->view('header/m_footer');	
	}
	public function match_list_e($jongmok=0, $category = 0){
		$compet_id = $_SESSION['compet_id'];
		if($compet_id==36){
			$this->load->view('header/header_ambar');
		}else{
			$this->load->view('header/header_nomenu');
		}
		$result_jongmok = $this->tkd_model->get_jongmok_all($compet_id);
		if($jongmok > 0){
			$jongmok_id = $jongmok;
		}else{
			$jongmok_id = $result_jongmok[0]['ID'];
		}
		$result_category = $this->tkd_model->get_category($jongmok_id);
		if($category > 0){
			$category_id = $category;
		}else{
			$category_id = $result_category[0]['ID'];
		}
		$data['jongmok'] = $result_jongmok;
		$data['category'] = $result_category;
		$data['jongmok_id'] = $jongmok_id;
		$data['category_id'] = $category_id;
		$data['game_methode'] = $result_category[0]['C_METHODE'];
		//$data['match_list'] = $this->tkd_model->get_score_mix_view($category_id);
		$data['match_list'] = $this->tkd_model->get_match_list($category_id);
		$this->load->view('match/match_list_e', $data);
		$this->load->view('header/m_footer');	
	}
	public function play_videos($video_url)
	{
		$this->load->view('header/header_nomenu');
		$video_id = "https://www.youtube.com/embed/" . $video_url;
		$data['video_id'] = $video_id;
		$this->load->view('match/play_videos', $data);  //youtube video...
		$this->load->view('header/m_footer');
	}
	//카테고리 자료추출
	public function get_category($jongmok_id) {
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
	//등록선수검색
	public function find_athlete()	{
		$this->load->view('header/header_nomenu');
		$compet_id = $_SESSION['compet_id'];
		$ath_name = $this->input->post('a_name');
		$data['a_name'] = $ath_name;
		$result = $this->tkd_model->find_athlete_name($ath_name);
		if($result){
			$result_jongmok = $this->tkd_model->get_jongmok_all($compet_id);
			$jongmok_id = $result[0]['JONGMOK_ID'];
			$result_category = $this->tkd_model->get_category($jongmok_id);
			$category_id = $result[0]['CATEGORY_ID'];

			$data['jongmok'] = $result_jongmok;
			$data['category'] = $result_category;
			$data['jongmok_id'] = $jongmok_id;
			$data['category_id'] = $category_id;
			$data['result'] = $result;
			//var_dump($result);
			if($_SESSION['country']==0){
				$this->load->view('match/find_athlete', $data);
			}else{
				$this->load->view('match/find_athlete_e', $data);
			}
		}else{
			$result_jongmok = $this->tkd_model->get_jongmok_all($compet_id);
			$jongmok_id = $result_jongmok[0]['ID'];
			$result_category = $this->tkd_model->get_category($jongmok_id);
			$category_id = $result_category[0]['ID'];

			$data['jongmok'] = $result_jongmok;
			$data['category'] = $result_category;
			$data['jongmok_id'] = $jongmok_id;
			$data['category_id'] = $category_id;
			$data['result'] = $result;
			$this->load->view('match/no_athlete', $data);
		}
		$this->load->view('header/m_footer');	
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
	public function game_match()	{
		$this->load->view('header/header');
		$this->load->view('game_match');
		$this->load->view('header/footer');
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
		
}