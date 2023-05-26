<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DanshboardContollers extends CI_Controller {

	public function checkLogin(){
		//nếu không tồn tại cái tài khoản này thì đi tới trang admin
		if(!$this->session->userdata('LoggedIn')){
			redirect(base_url('login')); // quay về trang login
		}
	}
	public function index()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		$this->load->view('dashboard/index');
		$this->load->view('admin_template/footer');
		
	}
	public function logout(){
		$this->checkLogin();
		$this->session->unset_userdata('LoggedIn');
		$this->session->set_flashdata('message', 'Logout successfully');
		redirect(base_url('login'));
	}
}
