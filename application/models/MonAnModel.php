<?php
class MonAnModel extends CI_Model{
    public function insertMonAn($data){
        return $this->db->insert('monan',$data); //THÊM DATA VÀO ĐÚNG BẲNG DANHMUC.
    }
    //list danh muc 
    public function selectMonAn(){
        $query = $this->db->select(' danhmuc.danhmuc as tendanhmuc, monan.*')
        ->from('danhmuc')
        ->join('monan', 'monan.id_danhmuc=danhmuc.id')
        ->get();
        return $query->result();
    }
    public function selectMonAnChitiet($id){
        $query = $this->db->get_where('monan',['id'=>$id]);
       
        return $query->result();
    }
    
    public function selectdanhmuc(){
        $query = $this->db->select('danhmuc.*')
        ->from('danhmuc')
        ->get();
        return $query->result();
    }
    //select
    public function selectMonAnById($id){
       $query = $this->db->get_where('monan',['id'=>$id]);
       return $query->row();
    }
    // //update
    public function updateMonAn($data, $id){
        return $this->db->update('monan',$data,['id'=>$id]);
    }
    //delete
    public function deleteMonAn($id){
        return $this->db->delete('monan', ['id'=>$id]);
    }
    //chi tiet
    public function selectChiTietMonAn()
    {
        return $this->db->insert('monan');
    }
    //phân trang
    // public function countAllMonAn()
    // {
    //     $this->db->select('danhmuc.id ,danhmuc.danhmuc as tendanhmuc, monan.*')
    //     ->from('danhmuc')
    //     ->join('monan', 'monan.id_danhmuc=danhmuc.id')
    //     ->get();
    //     // return $this->db->count_all(); // không có điều kiện count_all
    //     return $this->db->count_all_results('monan'); // không có điều kiện count_all
        
    // }
    public function countAllMonAn()
    {
        $query = $this->db->select('danhmuc.id, danhmuc.danhmuc as tendanhmuc, monan.*')
            ->from('danhmuc')
            ->join('monan', 'monan.id_danhmuc = danhmuc.id')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows(); // Trả về số lượng bản ghi
        } else {
            return 0; // Không có bản ghi nào
        }
    }
    //giới hạn sản phẩm trên 1 trang
    // public function getMonAnPagination($limit, $start)
    // {
    //     $this->db->limit($limit, $start);//số sản phẩm trên 1 trang
    //     $query = $this->db->get_where('monan', ['tinhtrang' => 1 ]); // lấy sản phẩm có trạng thái là hiển thị
    //     return $query->result();
    // }
    public function getMonAnPagination($limit, $start)
    {
        $this->db->limit($limit, $start); // số sản phẩm trên 1 trang
        $this->db->select('danhmuc.id, danhmuc.danhmuc as tendanhmuc, monan.*');
        $this->db->from('danhmuc');
        $this->db->join('monan', 'monan.id_danhmuc = danhmuc.id');
        $this->db->where('monan.tinhtrang', 1); // lấy sản phẩm có trạng thái là hiển thị
        $this->db->order_by('monan.id', 'DESC'); // Sắp xếp theo id giảm dần
        $query = $this->db->get();
        return $query->result();
    }
}
?>