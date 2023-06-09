<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LienHeControllers extends CI_Controller {

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

        $this->load->model('LienHeModel');
		$data['lienhe'] = $this->LienHeModel->selectLienHe();

		$this->load->view('lienhe/list', $data);
		$this->load->view('admin_template/footer');
		
	}
	
    //delete
	public function delete($id){
		$this->load->model('LienHeModel');
		$this->LienHeModel->deleteLienHe($id);
		$this->session->set_flashdata('success', 'Xóa Thành Công.');
		redirect(base_url('lienhe/list'));
	}//kết thúc delete

    //uploads liên hệ
    public function upload($id)
    {
        $this->load->model('LienHeModel');
		$this->LienHeModel->uploadLienHe($id);
		$this->session->set_flashdata('success', 'Xóa Thành Công.');
		redirect(base_url('lienhe/list'));
    }


}
