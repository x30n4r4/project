<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	function __construct(){
		parent::__construct();

		if($this->session->username==""){
			redirect('welcome');
		}

		$this->load->model('M_user');
		$this->load->database();

	}
	public function index()
	{
		$this->load->view('admin/index');
	}
	
	
}
