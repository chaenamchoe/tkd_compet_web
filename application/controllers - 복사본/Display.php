<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library('upload');
		$this->config->load('ccn_config', true);
		$this->load->database();
		$this->load->model('tkd_model');
		$this->load->library('session');
	}
	//실행중인 대회선택...
	public function show_name($id)	{
		$this->load->view('header/header_nomenu');
		$data['id'] = $id;
		$this->load->view('tvdisplay/main', $data);
	}
}