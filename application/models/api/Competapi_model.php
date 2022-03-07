<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Competapi_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	public function get_competitions(){
		$this->db->select("*");
		$this->db->from("COMPETITIONS");
		$query = $this->db->get();
		return $query->result();
	}
}