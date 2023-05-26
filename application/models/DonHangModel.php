<?php
class DonHangModel extends CI_Model{
   
    //list danh muc 
    public function selectDanHang(){
        $query = $this->db->select('donhang.*, vanchuyen.*')
        ->from('donhang')
        ->join('vanchuyen', 'donhang.id_vanchuyen=vanchuyen.id')
        ->get();
        return $query->result();
    }
    //
    public function selectDanHangChiTiet($madonhang)
    {
        $query = $this->db->select('donhang.madonhang, donhang.tinhtrang as tinhtrang_donhang ,chitiet_donhang.soluong as qty, chitiet_donhang.madonhang, chitiet_donhang.id_monan , monan.*')
        ->from('chitiet_donhang')
        ->join('monan', 'chitiet_donhang.id_monan=monan.id')
        ->join('donhang','donhang.madonhang=chitiet_donhang.madonhang')
        ->where('chitiet_donhang.madonhang', $madonhang)
        ->get();
        return $query->result();
    }

    // in đơn hàng
    // public function InChiTietDonHang($madonhang)
    // {
    //     $query = $this->db->select('donhang.madonhang, donhang.tinhtrang as tinhtrang_donhang ,chitiet_donhang.soluong as qty, chitiet_donhang.madonhang, chitiet_donhang.id_monan , monan.*')
    //     ->from('chitiet_donhang')
    //     ->join('monan', 'chitiet_donhang.id_monan=monan.id')
    //     ->join('donhang','donhang.madonhang=chitiet_donhang.madonhang')
    //     ->where('chitiet_donhang.madonhang', $madonhang)
    //     ->get();
    //     return $query->result();
    // }
    
    //xóa đơn hang 
    public function DeLeTeDonHang($madonhang)
    {
        return $this->db->delete('donhang', ['madonhang' => $madonhang]); 
    }

    public function DeLeTeChiTietDonHang($madonhang)
    {
        return $this->db->delete('chitiet_donhang', ['madonhang' => $madonhang]); 
    }

    //Cập nhật đơn hàng sau khi xữ lý đơn hàng
    public function CapNhatDonHang($data, $madonhang)
    {
        return $this->db->update('donhang', $data , ['madonhang' => $madonhang]); 
    }

}
?>