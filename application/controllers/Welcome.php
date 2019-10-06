<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct(){
		parent::__construct();
		$this->load->model('M_user');
		$this->load->database();
	}
	public function index()
	{
		$this->load->view('home/login');
	}
	public function login(){
		

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run()==FALSE){
			echo "Invalid Login";
		}	
		else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
//			$password = password_hash($password, PASSWORD_BCRYPT);

			$check_user = $this->M_user->get_user($username);

			if(!$check_user){
				return redirect('welcome');
			}
			else{

				$hash =  $check_user->password;
				if(password_verify($this->input->post('password'),$hash)){
					echo "success";
					if($check_user->role=='student'){
						$session_array = array(
							'username' => $check_user->username,
							'fullname' => $check_user->fullname,
							'role' => $check_user->role, 
							 );
						$this->session->set_userdata($session_array);
						return redirect('Student');
					}
					else{
						$session_array = array(
							'username' => $check_user->username, 
							'fullname' => $check_user->fullname, 
							'role' => $check_user->role, 
						);
						$this->session->set_userdata($session_array);
						return redirect('Admin');
					}

				}
				else{
					echo "invalid";
				}
			}

		}

	}
	
}
