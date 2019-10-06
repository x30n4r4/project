<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function login($username,$password){
		
		$array = array('username' => $username,
		'password' => $password);
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($array);

		$query = $this->db->get();

		if ($query->num_rows()>0){
			return $query->row();
		}
		else {
			return FALSE;
		}

	}
	public function get_user($username){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username',$username);
		$query = $this->db->get();

		if($query->num_rows()>0){
			return $query->row();
		}
		else {
			return FALSE;
		}
	}
}
