<?php
use Carbon\Carbon; //khai báo thư viện carbon
defined('BASEPATH') OR exit('No direct script access allowed');

class DangNhapControllers extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('email');//thư viện gmail
		$this->load->model('DangNhapModel');
		
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

	public function gui_gmail($to_email,$tieude,$noidung)
	{
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_user'] = 'lh6237828@gmail.com';
		$config['smtp_pass'] = 'lpnzalykavcshoxr'; //lpnzalykavcshoxr
		$config['smtp_port'] = '465'; 
		$config['charset'] = 'utf-8'; //

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
		
		$this->email->from('lh6237828@gmail.com', 'KFC Gửi Tới Bạn.');
		$this->email->to($to_email); // gửi đến gmail...
		// $this->email->cc('another@example.com'); // gửi 1 bản coppy cho nhiều người.
		// $this->email->bcc('and@another.com'); // gửi 1 bản coppy cho nhiều người | sẽ k thấy thông tin người gửi & người nhận/
		
		$this->email->subject($tieude); // tiêu đề của mail
		$this->email->message($noidung); // nội dung của gmail
		
		$this->email->send();
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
			$token = rand(0000,9999);
			$ngay_tao = Carbon::now('Asia/Ho_Chi_Minh'); //thư viện carbon time quản lý thời gian
			$this->load->model('DangNhapModel');
			$data = [
				'username' => $username,
				'email' => $email,
				'password' => $password,
				'token' => $token,
				'ngay_tao' => $ngay_tao
			];
			$result = $this->DangNhapModel->DangKyAdmin($data);
			if($result){
				$this->session->set_flashdata('success', 'Vui Lòng Vào Gmail Để Kích Hoạt Tài Khoản.');

				//gửi gmail
				$duongdan = base_url().'xac-thuc/?token='.$token.'&email='.$email; 
				$tieude = "Đăng Ký Thành Công";
				$noidung = "Click vào đường link để kích hoạt tài khoản: ".$duongdan;
				$to_email = 'luongngochung10102001@gmail.com'; // gửi về gmail này để kích hoạt tài khoản
				$this->gui_gmail($to_email, $tieude, $noidung);
				//gửi gmail thành công và quay lại trang checkout
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

	}//kết thúc

	//

	//Xác thực đăng ký 
	public function xac_thuc()
	{
		if(isset($_GET['email']) && $_GET['token'])
		{
			$token = $_GET['token'];
			$email = $_GET['email'];
		}
		$data['get_admin'] = $this->DangNhapModel->getAdmin($email);
		//cập nhật khách hàng
		$now = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(5); //lấy thời gian hiện tại + cho 5phut hiệu lực.
		$token_new = rand(0000, 9999); // cho 1 token mới để k bấm vào link củ để kích hoạt được
		foreach($data['get_admin'] as $key => $val)
		{
			if($token != $val->token)
			{
				$this->session->set_flashdata('error', 'Bạn Đã Kích Hoạt Tài Khoản Này.');
				redirect(base_url('/login'));
			}
			$data_admin = [
				'tinhtrang' => 1,
				'token' => $token_new
			];
		}
		if($val->ngay_tao < $now) // ngày tạo < hơn bây giờ + 5p
		{
			$active_KhachHang = $this->DangNhapModel->activeAdmin($email, $data_admin);
			$this->session->set_flashdata('success', 'Kích hoạt tài khoản thành công, mời bạn đăng nhập.');
			redirect(base_url('/login'));

		}
		else
		{
			$this->session->set_flashdata('error', ' Đã Quá Thời Gian Kích hoạt, vui lòng đăng ký lại.');
			redirect(base_url('/login'));

		}
	}//kết thúc

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
				$this->session->set_flashdata('error', 'Sai Email Hoặc Mật Khẩu Hoặc Tài Khoản Chưa Kích Hoạt Vui Lòng Đăng Nhập Lại!!!');
				redirect(base_url('login'));
			}
		}
        else
        {
            $this->index();
        }
	}

	

	
	
}
