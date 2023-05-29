<?php
class DangNhapModel extends CI_Model{
    public function checkLogin($email, $password){
        //kiểm tra điều kiện email password và tình trạng = 1 là đã kích hoạt
        $query = $this->db->where('email', $email)->where('password', $password)->where('tinhtrang', 1)->get('user');
        return $query->result();
    }
    //kiểm tra đăng nhập khách hàng
    public function checkLoginKhachHang($email, $password){
        //kiểm tra điều kiện email password và tình trạng = 1 là đã kích hoạt
        $query = $this->db->where('email', $email)->where('matkhau', $password)->where('tinhtrang', 1)->get('khachhang');
        return $query->result();
    }
    //đăng ký khách hàng
    public function NewKhachHang($data){
        return $this->db->insert('khachhang', $data);
       
    }

    //đăng ký admin
    public function DangKyAdmin($data){
        return $this->db->insert('user', $data); //THÊM DATA VÀO ĐÚNG BẲNG DANHMUC.
    }
    
    //xác thực admin
    public function getAdmin($email)
    {
        $query = $this->db->get_where('user', ['email' => $email]);
        return $query->result();
    }

    public function activeAdmin($email, $data_admin)
    {
        return $this->db->update('user', $data_admin, ['email' => $email]);
    }

    //đơn hàng
    public function NewDonHang($data){
        $this->db->insert('vanchuyen', $data);
        return $id_vanchuyen = $this->db->insert_id(); // trã về ib mới nhất, phương thức của codeigniter 
    }
    //
    public function insert_order($data_oder)
    {
        return $this->db->insert('donhang', $data_oder);
    }
    //chi tiết đơn hàng
    public function data_oder_details($data_oder_details)
    {
        return $this->db->insert('chitiet_donhang', $data_oder_details);
    }
} 
?>