<?php

use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class indexControllers extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('indexModel');
		$this->load->model('Thanh_TruotModel');
		$this->load->library('cart');//giỏ hàng
		$this->load->library('email');//thư viện gmail
		$this->data['danhmuc'] = $this->indexModel->getDanhMucHome();
		$this->data['sliders'] = $this->indexModel->getSliderHome();
		$this->load->library("pagination");
	}

	

	//trang 404 Page Not Found
	public function notfound()
	{
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/404_notfound');
		// $this->load->view('pages/template/footer');
	}

	public function index()
	{
		// echo Carbon::now('Asia/Ho_Chi_Minh');
		//Phân trang trang chủ
		$config = array();
        $config["base_url"] = base_url() .'/phan-trang/index'; 
		$config['total_rows'] = ceil($this->indexModel->countAllProduct()); //đếm tất cả sản phẩm  //hàm ceil làm tròn phân trang 
		$config["per_page"] = 6; //từng trang 3 sản phẩn
        $config["uri_segment"] = 3; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'Đầu';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Cuối';
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
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //nếu không lấy được số trang hiện tại thì trã về 0
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		$this->data['allproduct_pagination'] = $this->indexModel->getIndexPagination($config["per_page"], $this->page);
		//pagination

		// $this->data['danhmuc_monan'] =  $this->indexModel->DanhMucMonAn();

		$this->data['allMonAn'] = $this->indexModel->getAllMonAn();
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/home', $this->data);
		$this->load->view('pages/template/footer');

	}

	public function danhmuc($id)
	{

		//Phân trang Danh Mục Món Ăn
		$config = array();
        $config["base_url"] = base_url() .'/danh-muc'.'/'.$id; 
		$config['total_rows'] = ceil($this->indexModel->countAllDanhMucMonAn($id)); //đếm tất cả sản phẩm  //hàm ceil làm tròn phân trang 
		$config["per_page"] = 9; //từng trang 3 sản phẩn
        $config["uri_segment"] = 3; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'Đầu';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Cuối';
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
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(3)) ? $this->uri->segment(2) : 0; //nếu không lấy được số trang hiện tại thì trã về 0
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		
		//lọc giá chị từ nhỏ tới lớn hoặc từ lớn tới nhỏ theo giá món ăn
		// $this->data['min_gia'] = $this->indexModel->getMinGiaMonAn();
		// $this->data['max_gia'] = $this->indexModel->getMaxGiaMonAn();
		//bộ lọc
		// if(isset($_GET['kytu']))
		// {
		// 	$kytu = $_GET['kytu'];
		// 	$this->data['allMonAnDanhMuc_pagination'] = $this->indexModel->getCateKyTuPagination($id, $kytu, $config["per_page"], $this->page);

 		// }
		if(isset($_GET['gia']))
		{
			$gia = $_GET['gia'];
			$this->data['allMonAnDanhMuc_pagination'] = $this->indexModel->getCateGiaMonAnPagination($id, $gia, $config["per_page"], $this->page);
		}
		// elseif(isset($_GET['to']) && $_GET['from'])
		// {
		// 	$from_gia = $_GET['from'];
		// 	$to_gia  = $_GET['to'];
		// 	$this->data['allMonAnDanhMuc_pagination'] = $this->indexModel->getPhamViGiaMonAnPagination($id, $from_gia, $to_gia, $config["per_page"], $this->page);
		// }
		else
		{
			$this->data['allMonAnDanhMuc_pagination'] = $this->indexModel->getCatePagination($id ,$config["per_page"], $this->page);
		}
		//pagination

		//$this->data['DanhMuc_MonAn'] = $this->indexModel->getDanhMucMonAn($id);
		$this->data['TenMonAn'] = $this->indexModel->getDanhMucTenMonAn($id);
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/danhmuc');
		$this->load->view('pages/template/footer', $this->data);
	}

	public function monan($id)
	{
		$this->data['ChiTiet_MonAn'] = $this->indexModel->getMonAnChiTiet($id); 
		//hiển thị bình luận
		$this->data['list_comments'] = $this->indexModel->getListComments($id); 
		// $this->data['MonAn_LienQuan'] = $this->indexModel->getMonAnLienQuan($id); 

		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/sanpham_chitiet', $this->data);
		$this->load->view('pages/template/footer');
	}

	//đặt hàng
	public function checkout()
	{
		if($this->session->userdata('LoggedInKhachHang') && $this->cart->contents()) // thỏa mãn 2 điều kiện mới cho đặt hàng
		{
			$this->load->view('pages/template/header', $this->data);
			// $this->load->view('pages/template/slider');
			$this->load->view('pages/checkout');
			$this->load->view('pages/template/footer');
		}
		else
		{
			redirect(base_url().'dang-nhap');
		}
	}

	//giỏ hàng
	public function giohang()
	{
		
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/giohang');
		$this->load->view('pages/template/footer');
	}
	
	//
	public function them_gio_hang()
		{
			$MonAn_id = $this->input->post('MonAn_id');
			$soluong = $this->input->post('soluong');
			$this->data['ChiTiet_MonAn'] = $this->indexModel->getMonAnChiTiet($MonAn_id);

			

			// Kiểm tra hàng trong giỏ hàng
			if ($this->cart->contents() > 0) {
				foreach ($this->cart->contents() as $item) {
					if ($item['id'] == $MonAn_id) {
						$this->session->set_flashdata('success', 'Món ăn đã có trong giỏ hàng, vui lòng cập nhật số lượng.');
						redirect(base_url() . 'gio-hang', 'refresh');
					}
					// else
					// {
					// 	foreach ($this->data['ChiTiet_MonAn'] as $key => $pro) 
					// 	{
					// 		// Kiểm tra số lượng còn của sản phẩm
					// 		// Số lượng còn > số lượng mua thì cho mua
					// 		if ($pro->soluong > $soluong) {
					// 			$giohang = array(
					// 				'id' => $pro->id,
					// 				'qty' => $soluong,
					// 				'price' => $pro->giaban,
					// 				'name' => $pro->tenmonan,
					// 				'options' => array('hinhanh' => $pro->hinhanh, 'soluongcondu' => $pro->soluong)
					// 			);
					// 			$this->cart->insert($giohang);
					// 			$this->session->set_flashdata('success', 'Thêm vào giỏ hàng thành công.');
					// 			redirect(base_url() . 'gio-hang', 'refresh');
					// 		} else {
					// 			$this->session->set_flashdata('error', 'Số lượng đặt không hợp lệ !!!.');
					// 			redirect($_SERVER['HTTP_REFERER']); //quay lại trang trước đó
					// 		}
					// 	}
					// }
				}
			}

			foreach ($this->data['ChiTiet_MonAn'] as $key => $pro) {
				// Kiểm tra số lượng còn của sản phẩm
				// Số lượng còn > số lượng mua thì cho mua
				if ($pro->soluong > $soluong) {
					$giohang = array(
						'id' => $pro->id,
						'qty' => $soluong,
						'price' => $pro->giaban,
						'name' => $pro->tenmonan,
						'options' => array('hinhanh' => $pro->hinhanh, 'soluongcondu' => $pro->soluong)
					);
					$this->cart->insert($giohang);
					$this->session->set_flashdata('success', 'Thêm vào giỏ hàng thành công.');
					redirect(base_url() . 'gio-hang', 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Số lượng đặt không hợp lệ.');
					redirect($_SERVER['HTTP_REFERER']); //quay lại trang trước đó
				}
			}

		}
	
	//cập nhật giỏ hàng
	public function cap_nhat_gio_hang()
	{
		$rowid = $this->input->post('rowid');
		$soluong = $this->input->post('soluong');
		foreach($this->cart->contents() as $item)
		{
			if($rowid == $item['rowid'])
			{
				if($soluong < $item['options']['soluongcondu'])
				{
					$giohang = array(
						'rowid'	  => $rowid,
						'qty'     => $soluong
						
					);
				}
				elseif($soluong > $item['options']['soluongcondu'])
				{
					$giohang = array(
						'rowid'	  => $rowid,
						'qty'     => $item['options']['soluongcondu']
						
					);
				}
				
			}
		}
		$this->cart->update($giohang);
		// redirect(base_url().'gio-hang', 'refresh');
		redirect($_SERVER['HTTP_REFERER']); //lấy đường linh và tự quay về trang trước đó.
	}

	//delete all full
	public function xoa_tat_ca()
	{
		$this->cart->destroy();
		redirect(base_url().'gio-hang', 'refresh');
	}
	//delete 1 sản phẩm
	public function xoa_don_hang($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url().'gio-hang', 'refresh');
	}
	public function login()
	{
		$this->load->view('pages/template/header');
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}
	//đăng nhập khách hàng
	public function dangnhap_khachhang(){
		// check dữ liệu 
		$this->form_validation->set_rules('email', 'email', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('matkhau', 'Password', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {
			$email = $this->input->post('email');
			$password = md5($this->input->post('matkhau'));
			$this->load->model('DangNhapModel');
			$result = $this->DangNhapModel->checkLoginKhachHang($email, $password);
			if(count($result)>0){
				$session_array = [
					'id' => $result[0]->id,
					'username'=> $result[0]->tenkh,
					'email'=> $result[0]->email,
				];
				$this->session->set_userdata('LoggedInKhachHang',$session_array);
				$this->session->set_flashdata('success', 'Đăng Nhập Thành Công.');
				redirect(base_url('/checkout'));
			}else{
				$this->session->set_flashdata('error', 'Sai Email Hoặc Mật Khẩu Hoặc Chưa Kích Hoạt Vui Lòng Đăng Nhập Lại!!!');
				redirect(base_url('/dang-nhap'));
			}
		}
        else
        {
           
			$this->login();
        }
	}

	//đăng ký
	public function dang_ky()
	{
		// check dữ liệu 
		$this->form_validation->set_rules('email', 'email', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('matkhau', 'Mật Khẩu', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('tenkh', 'Tên & Họ', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('diachi', 'Địa Chỉ', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('sdt', 'Số Điện Thoại', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
        {
			$email = $this->input->post('email');
			$password = md5($this->input->post('matkhau'));
			$sdt = $this->input->post('sdt');
			$tenkh = $this->input->post('tenkh');
			$diachi = $this->input->post('diachi');
			$gioitinh = $this->input->post('gioitinh');
			$chu_ky_so = rand(0000,9999);
			$ngay_tao = Carbon::now('Asia/Ho_Chi_Minh'); //thư viện carbon time quản lý thời gian
			$data = array(
				'tenkh' => $tenkh,
				'email' => $email,
				'matkhau' => $password,
				'diachi' => $diachi,
				'gioitinh' => $gioitinh,
				'sdt' => $sdt,
				'chu_ky_so' => $chu_ky_so,
				'ngay_tao' => $ngay_tao

			);
			$this->load->model('DangNhapModel');
			$result = $this->DangNhapModel->NewKhachHang($data);
			if($result){
				// $session_array = [
				// 	'username'=> $tenkh,
				// 	'email'=> $email,
				// ];
				// $this->session->set_userdata('LoggedInKhachHang',$session_array);
				// $this->session->set_flashdata('success', 'Đăng Nhập Thành Công.');
				
				//gửi gmail---------------
				$duongdan = base_url().'xac-thuc-dang-ky/?chu_ky_so='.$chu_ky_so.'&email='.$email; 
				$tieude = "Đăng Ký Thành Công";
				$noidung = "Click vào đường link để kích hoạt tài khoản: ".$duongdan;
				$to_email = $email;
				$this->gui_email($to_email, $tieude, $noidung);
				//gửi gmail thành công và quay lại trang checkout
				redirect(base_url('/dang-nhap'));
			}else{
				$this->session->set_flashdata('error', 'Sai Email Hoặc Mật Khẩu Vui Lòng Đăng Nhập Lại!!!');
				redirect(base_url('/dang-nhap'));
			}
		}
        else
        {
           
			$this->login();
        }
	}

	//Xác thực đăng ký 
	public function xac_thuc_dang_ky()
	{
		if(isset($_GET['email']) && $_GET['chu_ky_so'])
		{
			$chu_ky_so = $_GET['chu_ky_so'];
			$email = $_GET['email'];
		}
		$data['get_khachhang'] = $this->indexModel->getKhachHang($email);
		//cập nhật khách hàng
		$now = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(5); //lấy thời gian tạo + cho 5phut hiệu lực.
		$chu_ky_so_moi = rand(0000, 9999);
		foreach($data['get_khachhang'] as $key => $val)
		{
			if($chu_ky_so != $val->chu_ky_so)
			{
				$this->session->set_flashdata('error', 'Đường link kích hoạt thất bại.');
				redirect(base_url('/dang-nhap'));
			}
			$data_KhachHang = [
				'tinhtrang' => 1,
				'chu_ky_so' => $chu_ky_so_moi
			];
		}
		if($val->ngay_tao < $now) // ngày tạo < hơn bây giờ + 5p
		{
			$active_KhachHang = $this->indexModel->activeKhachHang($email, $data_KhachHang);
			$this->session->set_flashdata('success', 'Kích hoạt tài khoản thành công, mời bạn đăng nhập.');
			redirect(base_url('/dang-nhap'));

		}
		else
		{
			$this->session->set_flashdata('error', 'Kích hoạt thất bại, vui lòng đăng ký lại.');
			redirect(base_url('/dang-nhap'));

		}
	}

	//XÁC nhận đặt hàng
	public function xacnhan_dathang()
	{ 
		// check dữ liệu 
		$this->form_validation->set_rules('email', 'email', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('tenkh', 'Tên & Họ', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('diachi', 'Địa Chỉ', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
		$this->form_validation->set_rules('sdt', 'Số Điện Thoại', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
		if ($this->form_validation->run() == true)
		{
			$email = $this->input->post('email');
			$hinhthuc = $this->input->post('hinhthuc');
			$sdt = $this->input->post('sdt');
			$tenkh = $this->input->post('tenkh');
			$diachi = $this->input->post('diachi');
			$data = array(
				'tenkh' => $tenkh,
				'diachi' => $diachi,
				'sdt' => $sdt,
				'email' => $email,
				'hinhthuc' => $hinhthuc
			);
			$this->load->model('DangNhapModel');
			
			$result = $this->DangNhapModel->NewDonHang($data);
			
			if($result){ 
				//đặt hàng oder
				$madonhang = rand(00, 9999); //từ 00 đến 9999
				$data_oder = array(
					'madonhang' => $madonhang,
					'id_vanchuyen' => $result,
					'tinhtrang' => 1
					
				);
				$insert_order = $this->DangNhapModel->insert_order($data_oder);
				//chi tiết đơn hàng
				foreach($this->cart->contents() as $item){
					$data_oder_details = array(
						'madonhang' => $madonhang, //dựa vào madondang của đặt hàng để lưu vào bảng chi tiết đặt hàng
						'id_monan' => $item['id'], //lấy từ session của them_gio_hang
						'soluong' => $item['qty'] ///lấy từ session của them_gio_hang
						
					);
					$data_oder_details = $this->DangNhapModel->data_oder_details($data_oder_details);
				}

				$this->session->set_flashdata('success', 'Đặt hàng thành công. Chúng tôi sẽ liên hệ trong thời gian sớm nhất.');
				$this->cart->destroy();

				//gửi gmail đơn hàng đã đặt
				$to_email = $email;
				$tieude = "Đặt hàng tại kfc thành công";
				$noidung = "Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất";
				//gởi mail
				$this->gui_email($to_email, $tieude, $noidung);

				redirect(base_url('/cam_on'));
				
			}else{
				$this->session->set_flashdata('error', 'Xác nhận thanh toán đơn hàng không thành công.');
				redirect(base_url('/checkout'));
			}
		}
		else
		{
			$this->checkout();
		}
	}
	
	//đăng xuất
	public function dang_xuat()
	{
		$this->session->unset_userdata('LoggedInKhachHang');
		$this->session->set_flashdata('success', 'Đăng xuất thành công.');
		redirect(base_url('/dang-nhap'));
	}

	//cảm ơn
	public function cam_on()
	{
		if(isset($_GET['partnerCode']))
		{
			$data_momo = [
				'partnerCode' => $_GET['partnerCode'],
				'orderId' => $_GET['orderId'],
				'requestId' => $_GET['requestId'],
				'amount' => $_GET['amount'],
				'orderInfo' => $_GET['orderInfo'],
				'orderType' => $_GET['orderType'],
				'transId' => $_GET['transId'],
				'payType' => $_GET['payType'],
				'signature' => $_GET['signature']

			];

			//lưu dữ liệu momo
			$result = $this->indexModel->inserMoMo($data_momo);
		}
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/cam_on');
		$this->load->view('pages/template/footer');
	}
	//tìm kiếm
	public function tim_kiem()
	{
		if(isset($_GET['keyword']) && $_GET['keyword'] != ''){
			$keyword = $_GET['keyword'];
		}

		//Phân trang Tìm kiếm món ăn
		$config = array();
        $config["base_url"] = base_url() .'/tim-kiem'; //đường dẫn url mặc định 
		$config['reuse_query_string'] = TRUE;// tái sử dụng đường dẫn 
		$config['total_rows'] = ceil($this->indexModel->countAllByTimKiem($keyword)); //đếm tất cả sản phẩm  //hàm ceil làm tròn phân trang 
		$config["per_page"] = 3; //từng trang 3 sản phẩn
        $config["uri_segment"] = 2; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'Đầu';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Cuối';
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
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; //nếu không lấy được số trang hiện tại thì trã về 0
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		$this->data['allTimKiem_pagination'] = $this->indexModel->getTimKiemPagination($keyword ,$config["per_page"], $this->page);
		//pagination

		// $this->data['monan'] = $this->indexModel->getTimKiemMonAn($keyword);
		$this->data['TenMonAn'] = $keyword;
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/timkiem');
		$this->load->view('pages/template/footer', $this->data);
	}
	//

	//gửi gmail 
	public function gui_email($to_email,$tieude,$noidung)
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

	//trang liên hệ 
	public function lienhe()
	{
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider', $this->data);
		$this->load->view('pages/lienhe');
		// $this->load->view('pages/template/footer');
	}
	public function gui_lienhe()
	{
		$data= [
			'ten' => $this->input->post('ten'),
			'sdt' => $this->input->post('sdt'),
			// 'email' => $this->input->post('email'),
			'ghichu' => $this->input->post('ghichu')
		];
		$result = $this->indexModel->insertLienHe($data);
		if($result)
		{
			// $to_email = $this->input->post('email');
			$to_email = 'luongngochung10102001@gmail.com';
			$tieude = "Thông Tin Liên Hệ Của Khách: ".$this->input->post('ten');
			$noidung = "Liên Hệ Ngay Với Khách Hàng:" .
						"\nSố Điện Thoại Của ".$this->input->post('ten').": ".$this->input->post('sdt').
						"\nThông Tin Ghi Chú: ".$this->input->post('ghichu');
			$this->gui_email($to_email,$tieude,$noidung);
		}
		$this->session->set_flashdata('success', 'Chúng tôi sẽ liên hệ với bạn sớm nhất. Xin cảm ơn.');
		redirect(base_url('lienhe'));
	}//kết thúc trang liên hệ

	//bình luận
	public function guibinhluan()
	{
		$data= [
			'ten' => $this->input->post('name_comment'),
			'email' => $this->input->post('email_comment'),
			'danh_gia' => $this->input->post('comments'),
			'monan_id' => $this->input->post('monan_comment'),
			'sao' => $this->input->post('star_rating'),
			'tinhtrang' => 0,
			'ngay_thang' => Carbon::now('Asia/Ho_Chi_Minh')
			
		];
		$result = $this->indexModel->insertBinhLuan($data);
		if($result)
		{
			echo 'success';
		}
		else
		{
			echo 'failed';
		}
	}
		
}
