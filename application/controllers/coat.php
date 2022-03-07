<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coat extends CI_Controller {
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
		$this->coat();
	}
	/////////////////////////////
	// 비디오 플레이
	/////////////////////////////
	public function send_message($compet, $coat, $action){
		$this->load->view('header/header_nomenu');
		$data['compet'] = $compet;
		$data['coat'] = $coat;
		$data['action'] = $action;
		$this->load->view('socket/send_msg', $data);
	}
	public function coat()	{
		$this->load->view('header/header_nomenu');
		$act_compet = $this->tkd_model->get_online_competition();
		if(count($act_compet) > 0){
			$data['compet_list'] = $act_compet;			
			$this->load->view('coat/select_compet', $data);
		}else{
			if(count($act_compet) === 1){
				$compet_id = $act_compet[0]['ID'];
				$this->save_competition($compet_id);	
			}else{
				$this->load->view('no_active_competition');
			}
		}
        $this->load->view('header/m_footer');
	}
	public function save_competition($id, $coat){
		$result = $this->tkd_model->get_competition($id);
		$compet_name = $result->C_NAME;
		$data['compet_name'] = $compet_name;

		$_SESSION['competition_id'] = $id;
		$_SESSION['competition_name'] = $compet_name;
		redirect('coat/show_lists');
	}
	public function show_compet_name(){
		$this->load->view('header/header_nomenu');
		$compet_id = $_SESSION['competition_id']; 
		$result = $this->tkd_model->get_competition_info($compet_id);
		$compet['results'] = $result;
		$this->load->view('coat/show_compet_name', $compet);
		$this->load->view('header/m_footer');
	}
	public function show_lists()
	{
		$this->load->view('header/header_nomenu');
		$result = $this->tkd_model->get_game_list(1);
		$result2 = $this->tkd_model->get_game_list(2);
		//var_dump($result);
		$data['results'] = $result;
		$data['results2'] = $result2;
		$this->load->view('coat/show_game_lists', $data);
		$this->load->view('header/m_footer');
	}
	public function get_video_action(){
		$coat = $_SESSION['coat_no'];
		$action = $this->tkd_model->get_video_action($coat);
		$this->output->set_output($action->C_ACTION);
	}
	public function play_video_done(){
		$coat = $_SESSION['coat_no'];
		$this->tkd_model->update_video_action($coat);
		redirect('video/show_lists');
	}
}