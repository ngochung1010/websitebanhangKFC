<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DangNhapControllers extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
	}
	

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('login/index');
		$this->load->view('template/footer');
	}

	//đăng ký admin
	public function dang_ky_admin()
	{
		$this->load->view('template/header');
		$this->load->view('dang_ky_admin/indexs');
		$this->load->view('template/footer');
		
	}

	public function dang_ky_thanh_vien()
	{
		$this->form_validation->set_rules('username', 'Họ & Tên', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('email', 'email', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('DangNhapModel');
			$data = [
				'username' => $username,
				'email' => $email,
				'password' => $password,
				'tinhtrang' => 1
			];
			$result = $this->DangNhapModel->DangKyAdmin($data);
			if($result){
				$this->session->set_flashdata('success', 'Đăng Ký Người Dùng Admin Thành Công.');
				redirect(base_url('/login'));
			}else{
				$this->session->set_flashdata('error', 'Đăng Ký Người Dùng Admin Thất Bại.');
				redirect(base_url('/dang-ky-admin'));
			}
		}
        else
        {
			$this->dang_ky_admin();
        }

	}

	//

	//users
	public function login(){
		// check dữ liệu 
		$this->form_validation->set_rules('email', 'email', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('DangNhapModel');
			$result = $this->DangNhapModel->checkLogin($email, $password);
			if(count($result)>0){
				$session_array = [
					'id' => $result[0]->id,
					'username'=> $result[0]->username,
					'email'=> $result[0]->email,
				];
				$this->session->set_userdata('LoggedIn',$session_array);
				$this->session->set_flashdata('success', 'Đăng Nhập Thành Công.');
				redirect(base_url('dashboard'));
			}else{
				$this->session->set_flashdata('error', 'Sai Email Hoặc Mật Khẩu Vui Lòng Đăng Nhập Lại!!!');
				redirect(base_url('login'));
			}
		}
        else
        {
            $this->index();
        }
	}

	

	
	
}
