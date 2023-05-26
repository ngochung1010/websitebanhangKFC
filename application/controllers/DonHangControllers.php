<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DonHangControllers extends CI_Controller {

    public function checkLogin(){
		//nếu không tồn tại cái tài khoản này thì đi tới trang admin
		if(!$this->session->userdata('LoggedIn')){
			redirect(base_url('login')); // quay về trang login
		}
	} 
    public function __construct()
    {   
        parent::__construct();
        $this->checkLogin();
    }

    //In đơn hàng
    // public function in_donhang($madonhang)
    // {
    //     $this->load->library('Pdf');
    //     $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

    //     $pdf->SetTitle('Print Order: '.$madonhang);
    //     $pdf->SetHeaderMargin(30);
    //     $pdf->SetTopMargin(20);
    //     $pdf->setFooterMargin(20);
    //     $pdf->SetAutoPageBreak(true);
    //     $pdf->SetAuthor('Author');
    //     $pdf->SetDisplayMode('real', 'default');
    //     $pdf->Write(5, 'CodeIgniter TCPDF Integration');
    //     $pdf->SetFont('dejavusans', '', 10);

    //     //in đơn hàng
    //     $pdf->SetFont('dejavusans', '', 10);

    //     // add a page
    //     $pdf->AddPage();
    //     $this->load->model('DonHangModel');

    //     $data['chitiet_donhang'] = $this->DonHangModel->InChiTietDonHang($madonhang);

    //     $html = '
    //     <h3>Đơn hàng của bạn bao gồm các sản phẩm:</h3>    
    //     <p>Cảm ơn bạn đã ủng hộ KFC <a href="#">abc.domain</a> của chúng tôi. Vui lòng liên hệ hotline nếu xảy ra sự cố: 19001900</p>        
    //     <table border="1" cellspacing="3" cellpadding="4">
    //       <thead>
    //         <tr>
    //           <th>STT</th>
    //           <th>Mã Đơn Hàng</th>
    //           <th>Tên Món Ăn</th>
    //           <th>Hình Ảnh</th>
    //           <th>Giá</th>
    //           <th>Số Lượng</th>
    //           <th>Đơn Giá</th>
    //         </tr>
    //       </thead>
    //       <tbody>
    //       ';
    //       $tong = 0;
    //       foreach($data['chitiet_donhang'] as $key => $ctdh){
    //         $tong += $ctdh->soluong*$ctdh->giaban;
    //         $html.='
    //             <tr>
    //             <td>'.$key.'</td>
    //             <td>'.$madonhang.'</td>
    //             <td>'.$ctdh->tenmonan.'</td> 
    //             <td>'.base_url('uploads/img_MonAn/'.$ctdh->hinhanh).'</td>
    //             <td>'.$ctdh->giaban.'</td>
    //             <td>'.$ctdh->soluong.'</td>
    //             <td>'.number_format($ctdh->soluong*$ctdh->giaban,0,',','.').'đ</td>
                
    //             </tr>
    //             ';
    //         }

    //     $html.='<tr><td colspan="7" align="right">Tổng tiền: '.number_format($tong,0,',','.').'đ</td></tr>
    //     </tbody>
    //     </table>';
      

    //     // xuất nội dung HTML
    //     $pdf->writeHTML($html, true, false, true, false, '');
    //     $pdf->Output('Đặt Hàng: '.$madonhang.'.pdf', 'I'); 
    // }

	public function index()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

		$this->load->model('DonHangModel');
		$data['donhang'] = $this->DonHangModel->selectDanHang();

		$this->load->view('donhang/list', $data);
		$this->load->view('admin_template/footer');
		
	}

    public function view($madonhang)
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

		$this->load->model('DonHangModel');
		$data['chitiet_donhang'] = $this->DonHangModel->selectDanHangChiTiet($madonhang);

		$this->load->view('donhang/view', $data);
		$this->load->view('admin_template/footer');
		
	}
     
    //delete đơn hàng
    public function delete_donhang($madonhang)
    {
        $this->checkLogin();
        $this->load->model('DonHangModel');

        $del_chitiet_donhang = $this->DonHangModel->DeLeTeChiTietDonHang($madonhang);
		$del = $this->DonHangModel->DeLeTeDonHang($madonhang);
        if($del &&  $del_chitiet_donhang)
        {
            $this->session->set_flashdata('success', 'Xóa Thành công.');
            redirect(base_url('donhang/list'));
            
        }
        else
        {
            $this->session->set_flashdata('error', 'Xóa thất bại.');
            redirect(base_url('donhang/list'));
        }
    }
    //xử lý đơn hàng
    public function xuly()
    {
        $value = $this->input->post('value');
        $madonhang = $this->input->post('madonhang');
        $this->load->model('DonHangModel'); 
        $data = array(
            'tinhtrang' => $value
        );
        $this->DonHangModel->CapNhatDonHang($data, $madonhang);
    }

    
    
}