<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonAnControllers extends CI_Controller {

    public function checkLogin(){
		//nếu không tồn tại cái tài khoản này thì đi tới trang admin
		if(!$this->session->userdata('LoggedIn')){
			redirect(base_url('login')); // quay về trang login
		}
	} 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MonAnModel');
		$this->load->library("pagination");
		
		// $this->pagination->create_links();
		// $this->pagination;
	}

	public function index()
	{
		//Phân trang trang chủ
		$config = array();
		$config["base_url"] = base_url() . '/phan-trang-monan/list';
		$config['total_rows'] = $this->MonAnModel->countAllMonAn();
		$config["per_page"] = 9;
		$config["uri_segment"] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
	
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$start = ($page - 1) * $config["per_page"];
		
		$data["links"] = $this->pagination->create_links();
		$data['allMonAn_pagination'] = $this->MonAnModel->getMonAnPagination($config["per_page"], $start);
	
		$this->checkLogin();
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$data['page'] = $page;
		$this->load->view('monan/list',$data);
		// $this->load->view('monan/list', $data);
		$this->load->view('admin_template/footer');
	}
	// public function index()
	// {
	// 	$this->checkLogin();
	// 	$this->load->view('admin_template/header');
	// 	$this->load->view('admin_template/navbar');

	// 	// Cấu hình phân trang
	// 	$config = array();
	// 	$config["base_url"] = base_url() . '/monan/index';
	// 	$config["total_rows"] = $this->MonAnModel->countAllMonAn();
	// 	$config["per_page"] = 6;
	// 	$config["uri_segment"] = 3;
	// 	// Cấu hình các tag HTML cho phân trang
	// 	$config['full_tag_open'] = '<ul class="pagination">';
	// 	$config['full_tag_close'] = '</ul>';
	// 	$config['first_link'] = 'First';
	// 	$config['first_tag_open'] = '<li>';
	// 	$config['first_tag_close'] = '</li>';
	// 	$config['last_link'] = 'Last';
	// 	$config['last_tag_open'] = '<li>';
	// 	$config['last_tag_close'] = '</li>';
	// 	$config['cur_tag_open'] = '<li class="active"><a>';
	// 	$config['cur_tag_close'] = '</a></li>';
	// 	$config['num_tag_open'] = '<li>';
	// 	$config['num_tag_close'] = '</li>';
	// 	$config['next_tag_open'] = '<li>';
	// 	$config['next_tag_close'] = '</li>';
	// 	$config['prev_tag_open'] = '<li>';
	// 	$config['prev_tag_close'] = '</li>';

	// 	$this->pagination->initialize($config); // Khởi tạo cấu hình phân trang

	// 	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	// 	$data["links"] = $this->pagination->create_links(); // Tạo các liên kết phân trang
	// 	$data['allMonAn_pagination'] = $this->MonAnModel->getMonAnPagination($config["per_page"], $page);

	// 	$this->load->view('monan/list', $data);

	// 	$this->load->view('admin_template/footer');
	// }
		//
		public function add()
		{
			$this->checkLogin();
			$this->load->view('admin_template/header');
			$this->load->view('admin_template/navbar');
			//gọi danh mục 
			$this->load->model('MonAnModel');
			$data['danhmuc'] = $this->MonAnModel->selectdanhmuc();

			$this->load->view('monan/add', $data);
			$this->load->view('admin_template/footer');
			
		}
	//chi tiết món ăn
	public function chitiet($id)
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		//
		$this->load->model('MonAnModel');
		$data['monanchitiet'] = $this->MonAnModel->selectMonAnChitiet($id); 
		//
		// $this->load->model('MonAnModel');
		// $data['monan'] = $this->MonAnModel->selectChiTietMonAn($id);
		//
		$this->load->view('monan/chitiet', $data);
		$this->load->view('admin_template/footer');
	}

	public function store(){
		// check dữ liệu 
		$this->form_validation->set_rules('tenmonan', 'Tên Món Ăn', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('soluong', 'Số Lượng', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('giaban', 'Giá', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('mota', 'Mô Tả', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {

			//upload file hình ảnh
			$ori_filename = $_FILES['hinhanh']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename); // thời gian upload và thay thế những khoảng trắng trong tên file ảnh
			$config = [
				'upload_path' => './uploads/img_MonAn', // lỗi 1: sai đường dẩn.
				'allowed_types' => 'gif|jpg|png|jpeg', //lỗi 2: sai đuôi mỡ rộng.
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('hinhanh'))//kiểm tra file đúng chuẩn hay chưa
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin_template/header');
				$this->load->view('admin_template/navbar');
				$this->load->view('monan/add', $error); // trã về trang add và hiển thị lỗi!!
				$this->load->view('admin_template/footer');
			}
			else
			{
				$monan_filename = $this->upload->data('file_name');
				//tên cột và lấy dữ liệu được bằng phương thức post dựa vào cái name của input gởi quá.
				$data= [
					'tenmonan' => $this->input->post('tenmonan'),
					'mota' => $this->input->post('mota'),
					'tinhtrang' => $this->input->post('tinhtrang'),
					'soluong' => $this->input->post('soluong'),
					'giaban' => $this->input->post('giaban'),
					'id_danhmuc' => $this->input->post('id_danhmuc'),
					'hinhanh' => $monan_filename 
				];
				$this->load->model('MonAnModel');
				$this->MonAnModel->insertMonAn($data);
				$this->session->set_flashdata('success', 'Thêm Thành Công.');
				redirect(base_url('monan/list'));
			}
			
		}else{
			$this->add(); 
		}
	}
	public function edit($id){
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

		//gọi danh mục 
		$this->load->model('comboModel');
		$data['combo'] = $this->comboModel->selectCombo();

		//gọi món ăn theo id
		$this->load->model('MonAnModel'); 
		$data['monan'] = $this->MonAnModel->selectMonAnById($id);

		$this->load->view('monan/edit',$data);
		$this->load->view('admin_template/footer');
	}
	//----------update---------------------------------------------------
	public function update($id){
		$this->form_validation->set_rules('tenmonan', 'Tên Món Ăn', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('soluong', 'Số Lượng', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('giaban', 'Giá', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
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
				'upload_path' => './uploads/img_MonAn', // lỗi 1: sai đường dẩn.
				'allowed_types' => 'gif|jpg|png|jpeg', //lỗi 2: sai đuôi mỡ rộng.
				'file_name' => $new_name,
			];
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('hinhanh'))//kiểm tra file đúng chuẩn hay chưa
				{
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('admin_template/header');
					$this->load->view('admin_template/navbar');
					$this->load->view('monan/edit/'.$id, $error); // trã về trang add và hiển thị lỗi!!
					$this->load->view('admin_template/footer');
				}
				else
				{
					$MonAn_filename = $this->upload->data('file_name');
					//tên cột và lấy dữ liệu được bằng phương thức post dựa vào cái name của input gởi quá.
					$data= [
						'tenmonan' => $this->input->post('tenmonan'),
						'mota' => $this->input->post('mota'),
						'tinhtrang' => $this->input->post('tinhtrang'),
						'soluong' => $this->input->post('soluong'),
						'giaban' => $this->input->post('giaban'),
						'id_danhmuc' => $this->input->post('id_danhmuc'),
						'hinhanh' => $MonAn_filename    
					];
				}
			}
			else
			{
				$data= [
					'tenmonan' => $this->input->post('tenmonan'),
					'mota' => $this->input->post('mota'),
					'tinhtrang' => $this->input->post('tinhtrang'),
					'soluong' => $this->input->post('soluong'),
					'giaban' => $this->input->post('giaban'),
					'id_danhmuc' => $this->input->post('id_danhmuc')
				];
			}
			$this->load->model('MonAnModel');
			$this->MonAnModel->updateMonAn($data,$id);
			$this->session->set_flashdata('success', 'Cập nhật Thành Công.');
			redirect(base_url('monan/list'));	
		}
		else
		{
			$this->edit($id); 
		}
	}

	//delete
	public function delete($id){
		$this->load->model('MonAnModel');
		$this->MonAnModel->deleteMonAn($id);
		$this->session->set_flashdata('success', 'Xóa Thành Công.');
		redirect(base_url('monan/list'));
	}
}