<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComBoControllers extends CI_Controller {

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

		$this->load->model('comboModel');
		$data['combo'] = $this->comboModel->selectCombo();

		$this->load->view('combo/list', $data);
		$this->load->view('admin_template/footer');
		
	}
    public function add()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		$this->load->view('combo/add');
		$this->load->view('admin_template/footer');
		
	}
	public function store(){
		// check dữ liệu 
		$this->form_validation->set_rules('danhmuc', 'Danh Mục', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('mota', 'Mô Tả', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {

			//upload file hình ảnh
			$ori_filename = $_FILES['hinhanh']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename); // thời gian upload và thay thế những khoảng trắng trong tên file ảnh
			$config = [
				'upload_path' => './uploads/img_danhmuc', // lỗi 1: sai đường dẩn.
				'allowed_types' => 'gif|jpg|png|jpeg', //lỗi 2: sai đuôi mỡ rộng.
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('hinhanh'))//kiểm tra file đúng chuẩn hay chưa
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin_template/header');
				$this->load->view('admin_template/navbar');
				$this->load->view('combo/add', $error); // trã về trang add và hiển thị lỗi!!
				$this->load->view('admin_template/footer');
			}
			else
			{
				$combo_filename = $this->upload->data('file_name');
				//tên cột và lấy dữ liệu được bằng phương thức post dựa vào cái name của input gởi quá.
				$data= [
					'danhmuc' => $this->input->post('danhmuc'),
					'mota' => $this->input->post('mota'),
					'tinhtrang' => $this->input->post('tinhtrang'),
					'hinhanh' => $combo_filename
				];
				$this->load->model('comboModel');
				$this->comboModel->insertCombo($data);
				$this->session->set_flashdata('success', 'Thêm Thành Công.');
				redirect(base_url('combo/list'));
			}
			
		}else{
			$this->add(); 
		}
	}
	public function edit($id){
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

		$this->load->model('comboModel'); 
		$data['combo'] = $this->comboModel->selectComboById($id);

		$this->load->view('combo/edit',$data);
		$this->load->view('admin_template/footer');
	}
	//----------update---------------------------------------------------
	public function update($id){
		$this->form_validation->set_rules('danhmuc', 'Danh Mục', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('mota', 'Mô Tả', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {
			//nếu không trống hình ảnh thì thực hiện upload
			if(!empty($_FILES['hinhanh']['name']))
			{
			//upload file hình ảnh
			$ori_filename = $_FILES['hinhanh']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename); // thời gian upload và thay thế những khoảng trắng trong tên file ảnh
			$config = [
				'upload_path' => './uploads/img_danhmuc', // lỗi 1: sai đường dẩn.
				'allowed_types' => 'gif|jpg|png|jpeg', //lỗi 2: sai đuôi mỡ rộng.
				'file_name' => $new_name,
			];
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('hinhanh'))//kiểm tra file đúng chuẩn hay chưa
				{
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('admin_template/header');
					$this->load->view('admin_template/navbar');
					$this->load->view('combo/add', $error); // trã về trang add và hiển thị lỗi!!
					$this->load->view('admin_template/footer');
				}
				else
				{
					$combo_filename = $this->upload->data('file_name');
					//tên cột và lấy dữ liệu được bằng phương thức post dựa vào cái name của input gởi quá.
					$data= [
						'danhmuc' => $this->input->post('danhmuc'),
						'mota' => $this->input->post('mota'),
						'tinhtrang' => $this->input->post('tinhtrang'),
						'hinhanh' => $combo_filename
					];
				}
			}
			else
			{
				$data= [
					'danhmuc' => $this->input->post('danhmuc'),
					'mota' => $this->input->post('mota'),
					'tinhtrang' => $this->input->post('tinhtrang')
				];
			}
			$this->load->model('comboModel');
			$this->comboModel->updateCombo($data,$id);
			$this->session->set_flashdata('success', 'Update Thành Công.');
			redirect(base_url('combo/list'));	
		}
		else
		{
			$this->edit($id); 
		}
	}

	//delete
	public function delete($id){
		$this->load->model('comboModel');
		$this->comboModel->deleteCombo($id);
		$this->session->set_flashdata('success', 'Xóa Thành Công.');
		redirect(base_url('combo/list'));
	}
}