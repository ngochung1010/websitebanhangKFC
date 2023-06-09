<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon; //thư viện carbon lấy thời gian
class OnlineCheckout extends CI_Controller {

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    //hàm gởi gmail
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

    //thanh toán cod momo vnpay
	public function online_checkout()
	{
        $this->load->library('cart');//thư viện giỏ hàng
        $this->load->library('email');//thư viện gmail
        //tính tổng giá tiền
        $thanhtien = 0;
        $tongtien = 0;
        foreach($this->cart->contents() as $item){
            //
            $thanhtien = $item['qty']*$item['price'];
            $tongtien += $thanhtien;
        }//kết thúc tính tổng giá tiền
		if(isset($_POST['cod'])) //thanh toán bằng tiền mặt
        {
                // check dữ liệu 
           
            $this->form_validation->set_rules('email', 'email', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
            $this->form_validation->set_rules('tenkh', 'Tên & Họ', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
            $this->form_validation->set_rules('diachi', 'Địa Chỉ', 'trim|required', ['required'=>'Bạn Chưa Nhập %s.']);
            $this->form_validation->set_rules('sdt', 'Số Điện Thoại', 'trim|required',['required'=>'Bạn Chưa Nhập %s.']);
            if ($this->form_validation->run() == true)
            {
                $email = $this->input->post('email');
                // $hinhthuc = $this->input->post('hinhthuc');
                $sdt = $this->input->post('sdt');
                $tenkh = $this->input->post('tenkh');
                $diachi = $this->input->post('diachi');
                $data = array(
                    'tenkh' => $tenkh,
                    'diachi' => $diachi,
                    'sdt' => $sdt,
                    'email' => $email,
                    'hinhthuc' => 'cod'
                );
                $this->load->model('DangNhapModel');
                
                $result = $this->DangNhapModel->NewDonHang($data);
                
                if($result){ 
                    //đặt hàng oder
                    // $madonhang = rand(00, 9999); //từ 00 đến 9999
                    $data_oder = array(
                        // 'madonhang' => $madonhang,
                        'id_vanchuyen' => $result,
                        'tinhtrang' => 1
                        
                    );
                    $insert_order = $this->DangNhapModel->insert_order($data_oder);
                    //chi tiết đơn hàng
                    foreach($this->cart->contents() as $item){
                        $ngay_tao = Carbon::now('Asia/Ho_Chi_Minh');
                        $data_oder_details = array(
                            // 'madonhang' => $madonhang, //dựa vào madondang của đặt hàng để lưu vào bảng chi tiết đặt hàng
                            'donhang_id' => $insert_order,
                            'id_monan' => $item['id'], //lấy từ session của them_gio_hang
                            'soluong' => $item['qty'], ///lấy từ session của them_gio_hang
                            'giaban' => $item['price'],
                            'ngaytaodonhang' => $ngay_tao
                            
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
                redirect(base_url('/checkout'));
            }
        }
		elseif(isset($_POST['payUrl'])) //thanh toán bằng momo
        {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create"; //tạo mã ngân hàng
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j'; //Mã truy cập của bạn do MoMo cung cấp
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; //Mã bí mật của bạn do MoMo cung cấp

            $orderInfo = "Thanh toán qua MoMo"; //thông tin đơn hàng
            $amount = $tongtien;
            $orderId = rand(00, 9999); //mã đơn hàng được chọn ngẫu nhiên
            $redirectUrl = "http://localhost:8000/cam_on"; //trã về trang cảm ơn khi tanh toán song
            $ipnUrl = "http://localhost:8000/cam_on";
            $extraData = "";
            
           
                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $amount;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;
            
                $requestId = time() . "";
                // $requestType = "payWithATM"; //thanh toán với ATM
                $requestType = "captureWallet"; //thanh toán với QRcode
                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json
            
                //Just a example, please check more in there
                $this->cart->destroy();
            
                header('Location: ' . $jsonResult['payUrl']);
            
        }
        // if(isset($_POST['payUrl'])) // Thanh toán bằng MoMo
        // {
        //     $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create"; //tạo mã ngân hàng
        //     $partnerCode = 'MOMOBKUN20180529';
        //     $accessKey = 'klm05TvNBzhg7h7j'; //Mã truy cập của bạn do MoMo cung cấp
        //     $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; //Mã bí mật của bạn do MoMo cung cấp

        //     $orderInfo = "Thanh toán qua MoMo"; //thông tin đơn hàng
        //     $amount = $tongtien;
        //     $orderId = rand(00, 9999); //mã đơn hàng được chọn ngẫu nhiên
        //     $redirectUrl = "http://localhost:8000/cam_on"; //trã về trang cảm ơn khi thanh toán thành công
        //     $ipnUrl = "http://localhost:8000/ipn"; //đường dẫn IPN để xử lý phản hồi từ MoMo
        //     $extraData = "";

        //     $requestId = time() . "";
        //     $requestType = "captureWallet"; //thanh toán với ví MoMo
        //     $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        //     $signature = hash_hmac("sha256", $rawHash, $secretKey);
        //     $data = array(
        //         'partnerCode' => $partnerCode,
        //         'accessKey' => $accessKey,
        //         'requestId' => $requestId,
        //         'amount' => $amount,
        //         'orderId' => $orderId,
        //         'orderInfo' => $orderInfo,
        //         'redirectUrl' => $redirectUrl,
        //         'ipnUrl' => $ipnUrl,
        //         'extraData' => $extraData,
        //         'requestType' => $requestType,
        //         'signature' => $signature
        //     );

        //     $result = $this->execPostRequest($endpoint, json_encode($data));
        //     $jsonResult = json_decode($result, true);

        //     if(isset($jsonResult['payUrl'])){
        //         // Chuyển hướng đến trang thanh toán MoMo
        //         header('Location: ' . $jsonResult['payUrl']);
        //         exit();
        //     } else {
        //         // Xử lý lỗi
        //         echo "Có lỗi xảy ra khi tạo đơn hàng thanh toán MoMo.";
        //         // Ghi log lỗi hoặc thông báo cho người dùng
        //     }
        // } elseif(isset($_POST['errorCode']) && isset($_POST['orderId']) && isset($_POST['message'])) {
        //     // Xử lý phản hồi sau khi thanh toán thành công hoặc thất bại
        //     if($_POST['errorCode'] == 0){
        //         // Thanh toán thành công
        //         // Lưu thông tin khách hàng vào cơ sở dữ liệu
        //         $email = $this->input->post('email');
        //         $sdt = $this->input->post('sdt');
        //         $tenkh = $this->input->post('tenkh');
        //         $diachi = $this->input->post('diachi');
        //         $data = array(
        //             'tenkh' => $tenkh,
        //             'diachi' => $diachi,
        //             'sdt' => $sdt,
        //             'email' => $email,
        //             'hinhthuc' => 'momo'
        //         );
        //         $this->load->model('DangNhapModel');
        //         $result = $this->DangNhapModel->NewDonHang($data);

        //         if($result){
        //             // Xử lý đặt hàng và gửi email
        //             // Chuyển hướng đến trang cảm ơn
        //             header('Location: http://localhost:8000/cam_on');
        //             exit();
        //         } else {
        //             // Xử lý lỗi khi lưu thông tin khách hàng vào cơ sở dữ liệu
        //             echo "Có lỗi xảy ra khi lưu thông tin khách hàng.";
        //             // Ghi log lỗi hoặc thông báo cho người dùng
        //         }
        //     } else {
        //         // Thanh toán thất bại
        //         // Xử lý lỗi thanh toán
        //         echo "Có lỗi xảy ra khi thanh toán.";
        //         // Ghi log lỗi hoặc thông báo cho người dùng
        //     }
        // }

        elseif(isset($_POST['redirect'])) //thanh toán bằng vnpay
        {
            // error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            // date_default_timezone_set('Asia/Ho_Chi_Minh');

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:8000/cam_on"; //trã về trang cảm ơn
            $vnp_TmnCode = "90R0OJMT";//Mã website tại VNPAY 
            $vnp_HashSecret = "LHPEWOTXEEMHMIFMYUGOSAMIPORRIISS"; //Chuỗi bí mật

            $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Noi Dung Thanh Toan';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $tongtien * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //127.0.0.1
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
            // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
            // $vnp_Bill_Email = $_POST['txt_billing_email'];
            // $fullName = trim($_POST['txt_billing_fullname']);
            // if (isset($fullName) && trim($fullName) != '') {
            //     $name = explode(' ', $fullName);
            //     $vnp_Bill_FirstName = array_shift($name);
            //     $vnp_Bill_LastName = array_pop($name);
            // }
            // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
            // $vnp_Bill_City=$_POST['txt_bill_city'];
            // $vnp_Bill_Country=$_POST['txt_bill_country'];
            // $vnp_Bill_State=$_POST['txt_bill_state'];
            // // Invoice
            // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
            // $vnp_Inv_Email=$_POST['txt_inv_email'];
            // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
            // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
            // $vnp_Inv_Company=$_POST['txt_inv_company'];
            // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
            // $vnp_Inv_Type=$_POST['cbo_inv_type'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef

                // "vnp_ExpireDate"=>$vnp_ExpireDate

                // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
                // "vnp_Bill_Email"=>$vnp_Bill_Email,
                // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
                // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
                // "vnp_Bill_Address"=>$vnp_Bill_Address,
                // "vnp_Bill_City"=>$vnp_Bill_City,
                // "vnp_Bill_Country"=>$vnp_Bill_Country,
                // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
                // "vnp_Inv_Email"=>$vnp_Inv_Email,
                // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
                // "vnp_Inv_Address"=>$vnp_Inv_Address,
                // "vnp_Inv_Company"=>$vnp_Inv_Company,
                // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
                // "vnp_Inv_Type"=>$vnp_Inv_Type
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            // }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            //mã hóa dữ liệu
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
                // vui lòng tham khảo thêm tại code demo
        }
	}
}
