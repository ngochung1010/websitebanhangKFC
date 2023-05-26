<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thanh_TruotControllers extends CI_Controller {

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

        $this->load->model('Thanh_TruotModel');
		$data['slider'] = $this->Thanh_TruotModel->selectSlider();

		$this->load->view('thanh_truot/index', $data);
		$this->load->view('admin_template/footer');
		
	}
	
    public function add()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		$this->load->view('thanh_truot/add');
		$this->load->view('admin_template/footer');
		
	}

    public function edit($id)
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

        $this->load->model('Thanh_TruotModel'); 
		$data['slider'] = $this->Thanh_TruotModel->selectSlideryId($id);


		$this->load->view('thanh_truot/edit', $data);
		$this->load->view('admin_template/footer');
		
	}

    //thêm slider
    public function store(){
		// check dữ liệu 
		$this->form_validation->set_rules('ten_slider', 'Tên Slider', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {

			//upload file hình ảnh
			$ori_filename = $_FILES['hinhanh_slider']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename); // thời gian upload và thay thế những khoảng trắng trong tên file ảnh
			$config = [
				'upload_path' => './uploads/img_slider', // lỗi 1: sai đường dẩn.
				'allowed_types' => 'gif|jpg|png|jpeg', //lỗi 2: sai đuôi mỡ rộng.
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('hinhanh_slider'))//kiểm tra file đúng chuẩn hay chưa
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin_template/header');
				$this->load->view('admin_template/navbar');
				$this->load->view('thanh_truot/add', $error); // trã về trang add và hiển thị lỗi!!
				$this->load->view('admin_template/footer');
			}
			else
			{
				$slider_filename = $this->upload->data('file_name');
				//tên cột và lấy dữ liệu được bằng phương thức post dựa vào cái name của input gởi quá.
				$data= [
					'ten_slider' => $this->input->post('ten_slider'),
					'tinhtrang_slider' => $this->input->post('tinhtrang_slider'),
					'hinhanh_slider' => $slider_filename
				];
				$this->load->model('Thanh_TruotModel');
				$this->Thanh_TruotModel->insertSlider($data);
				$this->session->set_flashdata('success', 'Thêm Thành Công.');
				redirect(base_url('thanh_truot/list'));
			}
			
		}else{
			$this->add(); 
		}
	}//kết thúc stort 


    //update slider
    public function update($id){
		$this->form_validation->set_rules('ten_slider', 'Tên Slider', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {
			//nếu không trống hình ảnh thì thực hiện upload
			if(!empty($_FILES['hinhanh_slider']['name']))
			{
			//upload file hình ảnh
			$ori_filename = $_FILES['hinhanh_slider']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename); // thời gian upload và thay thế những khoảng trắng trong tên file ảnh
			$config = [
				'upload_path' => './uploads/img_slider', // lỗi 1: sai đường dẩn.
				'allowed_types' => 'gif|jpg|png|jpeg', //lỗi 2: sai đuôi mỡ rộng.
				'file_name' => $new_name,
			];
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('hinhanh_slider'))//kiểm tra file đúng chuẩn hay chưa
				{
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('admin_template/header');
					$this->load->view('admin_template/navbar');
					$this->load->view('thanh_truot/edit'.$id , $error); // trã về trang add và hiển thị lỗi!!
					$this->load->view('admin_template/footer');
				}
				else
				{
					$slider_filename = $this->upload->data('file_name');
					//tên cột và lấy dữ liệu được bằng phương thức post dựa vào cái name của input gởi quá.
					$data= [
						'ten_slider' => $this->input->post('ten_slider'),
						'tinhtrang_slider' => $this->input->post('tinhtrang_slider'),
						'hinhanh_slider' => $slider_filename
					];
				}
			}
			else
			{
				$data= [
					'ten_slider' => $this->input->post('ten_slider'),
					'tinhtrang_slider' => $this->input->post('tinhtrang_slider')
				];
			}
			$this->load->model('Thanh_TruotModel');
			$this->Thanh_TruotModel->updateSlider($data,$id);
			$this->session->set_flashdata('success', 'Update Thành Công.');
			redirect(base_url('thanh_truot/list'));	
		}
		else
		{
			$this->edit($id); 
		}
	}//kết thúc update

    //delete
	public function delete($id){
		$this->load->model('Thanh_TruotModel');
		$this->Thanh_TruotModel->deleteSlider($id);
		$this->session->set_flashdata('success', 'Xóa Thành Công.');
		redirect(base_url('thanh_truot/list'));
	}//kết thúc delete


}
