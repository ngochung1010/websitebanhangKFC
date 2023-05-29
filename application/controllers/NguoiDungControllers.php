<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NguoiDungControllers extends CI_Controller {

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

        $this->load->model('NguoiDungModel');
		$data['nguoidung'] = $this->NguoiDungModel->selectNguoiDung();

		$this->load->view('nguoidung/list', $data);
		$this->load->view('admin_template/footer');
		
	}
	
    //delete
	public function delete($id){
		$this->load->model('NguoiDungModel');
		$this->NguoiDungModel->deleteNguoiDung($id);
		$this->session->set_flashdata('success', 'Xóa Thành Công.');
		redirect(base_url('nguoidung/list'));
	}//kết thúc delete


}
