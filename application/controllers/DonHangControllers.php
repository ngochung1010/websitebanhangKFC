<?php

use Carbon\Carbon;

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

    //in đơn hàng
    // public function in_donhang($madonhang) {
    //     // Load thư viện TCPDF
    //     $this->load->library('Pdf');
    
    //     // Tạo đối tượng TCPDF
    //     $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    
    //     $pdf->SetTitle('Print Order: ' . $madonhang);
    //     $pdf->SetHeaderMargin(30);
    //     $pdf->SetTopMargin(20);
    //     $pdf->SetFooterMargin(20);
    //     $pdf->SetAutoPageBreak(true);
    //     $pdf->SetAuthor('Author');
    //     $pdf->SetDisplayMode('real', 'default');
    //     $pdf->SetFont('dejavusans', '', 10);
    
    //     // In đơn hàng
    //     $pdf->AddPage();
    //     $this->load->model('DonHangModel');
    //     $data['chitiet_donhang'] = $this->DonHangModel->printOrderDetails($madonhang);
    
    //     $html = '
    //         <h3>Đơn hàng của bạn bao gồm các món ăn:</h3> 
    //         <p>Cảm ơn bạn đã ủng hộ website <a href="#">kfcvietnam.com</a> của chúng tôi. Vui lòng liên hệ hotline nếu xảy ra sự cố: 19001900</p>        
    //         <table border="1" cellspacing="3" cellpadding="4">
    //             <thead>
    //                 <tr>
    //                     <th>STT</th>
    //                     <th>Mã Đơn Hàng</th>
    //                     <th>Tên Món Ăn</th>
    //                     <th>Giá Món Ăn</th>
    //                     <th>Số Lượng</th>
    //                     <th>Thành Tiền</th>
    //                 </tr>
    //             </thead>
    //             <tbody>';
    
    //     $total = 0;
    //     $stt = 1;
    //     foreach ($data['chitiet_donhang'] as $key => $product) {
    //         $total += $product->qty * $product->giaban;
    //         $thoigian = Carbon::now('Asia/Ho_Chi_Minh');
    //         $html .= '
    //             <tr>
    //                 <td>' . $stt . '</td>
    //                 <td>' . $madonhang . '</td>
    //                 <td>' . $product->tenmonan . '</td> 
    //                 <td>' . $product->giaban . '</td>
    //                 <td>' . $product->qty . '</td>
    //                 <td>' . number_format($product->qty * $product->giaban, 0, ',', '.') . 'đ</td>
    //             </tr>';
    //         $stt++;
    //     }
    
    //     $html .= '<tr><td colspan="6" align="right">Tổng tiền: ' . number_format($total, 0, ',', '.') . 'đ</td></tr>
    //         </tbody>
    //         </table>';
    //     $html .= '<p>Thời gian in đơn hàng: '.$thoigian.'</p>';
    //     // Thêm chữ ký khách hàng
    //     $html .= '<br><br><p style="text-align: right;">Khách hàng ký xác nhận đơn hàng: ________________________</p>';
    //     // Xóa dữ liệu đệm đã gửi trước đó
    //     ob_clean();
    //     // Xuất nội dung HTML
    //     $pdf->writeHTML($html, true, false, true, false, '');
    //     $pdf->Output('Order: ' . $madonhang . '.pdf', 'I');
    // }
    public function in_donhang($madonhang) {
        // Load model đơn hàng
        $this->load->model('DonHangModel');
    
        // Retrieve order details
        $data['chitiet_donhang'] = $this->DonHangModel->printOrderDetails($madonhang);
    
        // Check if order details are available
        // if (!empty($data['chitiet_donhang'])) {
            $donhang = $data['chitiet_donhang'][0];
            // Kiểm tra trạng thái đơn hàng
            if ($donhang->tinhtrang_donhang == 2) {
                // Đơn hàng đã được xử lý, tiến hành in đơn hàng
                // Load thư viện TCPDF
                $this->load->library('Pdf');
            
                // Tạo đối tượng TCPDF
                $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
            
                $pdf->SetTitle('Print Order: ' . $madonhang);
                $pdf->SetHeaderMargin(30);
                $pdf->SetTopMargin(20);
                $pdf->SetFooterMargin(20);
                $pdf->SetAutoPageBreak(true);
                $pdf->SetAuthor('Author');
                $pdf->SetDisplayMode('real', 'default');
                $pdf->SetFont('dejavusans', '', 10);
            
                // In đơn hàng
                $pdf->AddPage();
            
                $html = '
                    <h3>Đơn hàng của bạn bao gồm các món ăn:</h3> 
                    <p>Cảm ơn bạn đã ủng hộ website <a href="#">kfcvietnam.com</a> của chúng tôi. Vui lòng liên hệ hotline nếu xảy ra sự cố: 19001900</p>        
                    <table border="1" cellspacing="3" cellpadding="4">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Tên Món Ăn</th>
                                <th>Giá Món Ăn</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>';
            
                $total = 0;
                $stt = 1;
                foreach ($data['chitiet_donhang'] as $key => $product) {
                    $total += $product->qty * $product->giaban;
                    $thoigian = Carbon::now('Asia/Ho_Chi_Minh');
                    $html .= '
                        <tr>
                            <td>' . $stt . '</td>
                            <td>' . $madonhang . '</td>
                            <td>' . $product->tenmonan . '</td> 
                            <td>' . $product->giaban . '</td>
                            <td>' . $product->qty . '</td>
                            <td>' . number_format($product->qty * $product->giaban, 0, ',', '.') . 'đ</td>
                        </tr>';
                    $stt++;
                }
            
                $html .= '<tr><td colspan="6" align="right">Tổng tiền: ' . number_format($total, 0, ',', '.') . 'đ</td></tr>
                    </tbody>
                    </table>';
                $html .= '<p>Thời gian in đơn hàng: '.$thoigian.'</p>';
                // Thêm chữ ký khách hàng
                $html .= '<br><br><p style="text-align: right;">Khách hàng ký xác nhận đơn hàng: ________________________</p>';
                // Xóa dữ liệu đệm đã gửi trước đó
                ob_clean();
                // Xuất nội dung HTML
                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->Output('Order: ' . $madonhang . '.pdf', 'I');
            } elseif ($donhang->tinhtrang_donhang == 1){

                // Đơn hàng chưa được xử lý, không thể in
                $this->session->set_flashdata('error', 'Đơn hàng chưa được xử lý.');
				redirect($_SERVER['HTTP_REFERER']); //quay lại trang trước đó
            }else{
                $this->session->set_flashdata('error', 'Đơn hàng đã bị hủy.');
				redirect($_SERVER['HTTP_REFERER']); //quay lại trang trước đó
            }
        // } else {
        //     // Không tìm thấy đơn hàng
        //     echo 'Không tìm thấy đơn hàng.';
        // }
    }
   
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
    public function delete_donhang($id)
    {
        $this->checkLogin();
        $this->load->model('DonHangModel');

        $del_chitiet_donhang = $this->DonHangModel->DeLeTeChiTietDonHang($id);
		$del = $this->DonHangModel->DeLeTeDonHang($id);
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
        $id = $this->input->post('id');
        $this->load->model('DonHangModel'); 
        $data = array(
            'tinhtrang' => $value
        );
        $this->DonHangModel->CapNhatDonHang($data, $id);
    }

    
    
}