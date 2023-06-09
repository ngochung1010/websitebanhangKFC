<?php
class LienHeModel extends CI_Model{
    // public function insertSlider($data){
    //     return $this->db->insert('slider',$data); //THÊM DATA VÀO ĐÚNG BẲNG DANHMUC.
    // }
    // //list danh muc 
    public function selectLienHe(){
        $query = $this->db->get('lienhe'); //get('danhmuc') lấy toàn bộ.
        return $query->result();
    }
    // //select
    // public function selectSlideryId($id){
    //    $query = $this->db->get_where('slider',['id'=>$id]);
    //    return $query->row();
    // }
    // // //update
    // public function updateSlider($data, $id){
    //     return $this->db->update('slider',$data,['id'=>$id]);
    // }

    //delete
    public function deleteLienHe($id){
        return $this->db->delete('lienhe', ['id'=>$id]);
    }

    public function uploadLienHe($id)
    {
        return $this->db->delete('lienhe', ['id'=>$id]);
    }
}
?>