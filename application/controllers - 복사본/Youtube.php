<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Youtube extends CI_Controller {
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
		$this->load->view('youtube/play_youtube_live');
	}
	public function play_youtube_live($coat1_url='', $coat2_url='')
	{
		$this->load->view('header/header_nomenu');
		$coat1_url = 'https://youtu.be/ieplNle512M';
		$data['video_id1'] = $coat1_url;
		$data['video_id2'] = $coat2_url;
		$this->load->view('youtube/play_special_videos', $data);  //youtube video...
		$this->load->view('header/m_footer');
	}

}