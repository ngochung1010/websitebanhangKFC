<?php

    class indexModel extends CI_Model{
        
        //list danh muc 
        public function getDanhMucHome(){
            $query = $this->db->get_where('danhmuc',['tinhtrang' => 1]); //get('danhmuc') lấy toàn bộ.
            return $query->result();
        }//

        // danh mục sản phẩm hiển thị ra trang chủ
        // public function DanhMucMonAn()
        // {
        //     $this->db->select('monan.*, danhmuc.danhmuc as ten_danhmuc, danhmuc.id ');
        //     $this->db->from('danhmuc');
        //     $this->db->join('monan', 'monan.id_danhmuc=danhmuc.id');
        //     $query = $this->db->get();
        //     $result = $query->result_array();
        //     //echo "<pre>";
        //     //print_r($result);
        //     $newArray = array(); //tạo mảng mới
        //     foreach($result as $key => $value)
        //     {
        //         $newArray[$value['ten_danhmuc']][] = $value;
        //     }
        //     return $newArray;
        //     //print_r($newArray);
        // }//

        //slider home
        public function getSliderHome(){
            $query = $this->db->get_where('slider',['tinhtrang_slider' => 1]); //get('danhmuc') lấy toàn bộ.
            return $query->result();
        }//

        public function getAllMonAn(){
            $query = $this->db->get_where('monan',['tinhtrang' => 1]); //get('danhmuc') lấy toàn bộ.
            return $query->result();
        }
        //
        public function getDanhMucMonAn($id){
            $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc=danhmuc.id')
            ->where('monan.id_danhmuc', $id)
            ->get();
            return $query->result();
        }

        //
        
        //chi tiết sản phẩm 
        public function getMonAnChiTiet($id)
        {
            $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc=danhmuc.id')
            ->where('monan.id', $id)
            ->get();
            return $query->result();
        }//

        //món ăn liên quan 
        // public function getMonAnLienQuan($id, $id_danhmuc)
        // {
        //     $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
        //     ->from('danhmuc')
        //     ->join('monan', 'monan.id_danhmuc=danhmuc.id')
        //     ->where('monan.id_danhmuc', $id_danhmuc)
        //     ->where_not_in('monan.id', $id)
        //     ->get();
        //     return $query->result();
        // }

        public function getDanhMucTenMonAn($id){
            $this->db->select('danhmuc.*');
            $this->db->from('danhmuc');
            $this->db->limit(1);
            $this->db->where('danhmuc.id', $id);
            $query =$this->db->get();
            $result = $query->row();
            return $TenMonAn = $result->danhmuc;
        }

        // tìm kiếm, like là gần giống với tên món ăn keywword
        public function getTimKiemMonAn($keyword)
        {
            $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc=danhmuc.id')
            ->like('monan.tenmonan', $keyword) 
            ->get();
            return $query->result();
        }

        //phân trang
        public function countAllProduct()
        {
            return $this->db->count_all('monan'); // không có điều kiện count_all
        }

        //phân trang danh mục sản phẩm
        public function countAllDanhMucMonAn($id)
        {
            $this->db->where('id_danhmuc', $id);
            $this->db->from('monan');
            return $this->db->count_all_results(); // lấy tất cả nhưng có điều kiện count_all_results
        }

        //phân trang tìm kiếm sản phẩm
        public function countAllByTimKiem($keyword)
        {
            $this->db->like('monan.tenmonan', $keyword);
            $this->db->from('monan');
            return $this->db->count_all_results(); // lấy tất cả nhưng có điều kiện count_all_results
        }

        public function getTimKiemPagination($keyword, $limit, $start)
        {
            $this->db->limit($limit, $start);
            $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc=danhmuc.id')
            ->like('monan.tenmonan', $keyword) 
            ->get();
            return $query->result();
        }

        //kết thúc phân trang tìm kiếm sản phẩm

        //giới hạn sản phẩm trên 1 trang
        public function getIndexPagination($limit, $start)
        {
            $this->db->limit($limit, $start);//số sản phẩm trên 1 trang
            $query = $this->db->get_where('monan', ['tinhtrang' =>1 ]); // lấy sản phẩm có trạng thái là hiển thị
            return $query->result();
        }

        ////giới hạn sản phẩm trên 1 trang
        public function getCatePagination($id, $limit, $start){
            $this->db->limit($limit, $start);
            $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc=danhmuc.id')
            ->where('monan.id_danhmuc', $id)
            ->get();
            return $query->result();
        }

        //Xác thực đăng ký 
        public function getKhachHang($email)
        {
            $query = $this->db->get_where('khachhang', ['email' => $email]); //điều kiện cái email trong db phải bằng cái email mình gởi vào.
            return $query->result();
        } 
        //Cập nhật sau khi xác thực tài khoản đăng ký
        public function activeKhachHang($email, $data_KhachHang)
        {
            return $this->db->update('khachhang', $data_KhachHang, ['email' => $email]);
        }

        // lọc giá chị ----------
        // public function getCateKyTuPagination($id, $kytu, $limit, $start)
        // {
        //     $this->db->limit($limit, $start);
        //     $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
        //     ->from('danhmuc')
        //     ->join('monan', 'monan.id_danhmuc=danhmuc.id')
        //     ->where('monan.id_danhmuc', $id)
        //     ->order_by('monan.tenmonan', $kytu) //lọc theo tên
        //     ->get();
        //     return $query->result();
        // }

        public function getCateGiaMonAnPagination($id, $gia, $limit, $start)
        {
            $this->db->limit($limit, $start);
            $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc=danhmuc.id')
            ->where('monan.id_danhmuc', $id)
            ->order_by('monan.giaban', $gia) //lọc theo tên
            ->get();
            return $query->result();
        }

        //thông tin liên hệ
        public function insertLienHe($data)
        {
            return $this->db->insert('lienhe', $data);
        }
        
        //Bình luận
        public function insertBinhLuan($data)
        {
            return $this->db->insert('binhluan', $data);
        }

        //lưu dữ liệu cổng thanh toán
        public function inserMoMo($data_momo)
        {
            return $this->db->insert('momo', $data_momo);
        }
        //--
        
        //hiển thị bình luận
        public function getListComments($id)
        {
            $query = $this->db->select('khachhang.tenkh as tenkhachhang, binhluan.*')
            ->from('khachhang')
            ->join('binhluan', 'binhluan.khachhang_id = khachhang.id')
            // ->where('binhluan.khachhang_id', $id)
            ->where('binhluan.tinhtrang', 1)
            ->where('binhluan.monan_id', $id)
            ->get();
            return $query->result();
            // $query = $this->db->get_where('binhluan', ['tinhtrang' => 1 , 'monan_id' => $id]);
            // return $query->result();
        }
    }
?>