<?php
class DonHangModel extends CI_Model{
   
    //list danh muc 
    public function selectDanHang(){
        $query = $this->db->select('donhang.*, vanchuyen.*, donhang.id as id_donhang')
        ->from('donhang')
        ->join('vanchuyen', 'donhang.id_vanchuyen=vanchuyen.id')
        ->get();
        return $query->result();
    }
    //
    public function selectDanHangChiTiet($madonhang)
    {
        $query = $this->db->select('donhang.id, donhang.tinhtrang as tinhtrang_donhang ,chitiet_donhang.soluong as qty, chitiet_donhang.ngaytaodonhang, chitiet_donhang.donhang_id, chitiet_donhang.id_monan , monan.*')
        ->from('chitiet_donhang')
        ->join('monan', 'chitiet_donhang.id_monan=monan.id')
        ->join('donhang','chitiet_donhang.donhang_id=donhang.id')
        ->where('chitiet_donhang.donhang_id', $madonhang)
        ->get();
        return $query->result();
    }

    // in đơn hàng
    public function printOrderDetails($madonhang)
    {
        $query = $this->db->select('donhang.id, donhang.tinhtrang as tinhtrang_donhang ,chitiet_donhang.soluong as qty, chitiet_donhang.donhang_id, chitiet_donhang.id_monan , monan.*')
        ->from('chitiet_donhang')
        ->join('monan', 'chitiet_donhang.id_monan=monan.id')
        ->join('donhang','chitiet_donhang.donhang_id=donhang.id')
        ->where('chitiet_donhang.donhang_id', $madonhang)
        ->get();
        return $query->result();
    }
    
    //xóa đơn hang 
    public function DeLeTeDonHang($id)
    {
        return $this->db->delete('donhang', ['id' => $id]); 
    }

    public function DeLeTeChiTietDonHang($id)
    {
        return $this->db->delete('chitiet_donhang', ['donhang_id' => $id]); 
    }

    //Cập nhật đơn hàng sau khi xữ lý đơn hàng
    public function CapNhatDonHang($data, $id)
    {
        $this->db->where('id',$id);
        return $this->db->update('donhang', $data);
        // return $this->db->update('donhang', $data , ['id' => $id]); 
    }

}
?>