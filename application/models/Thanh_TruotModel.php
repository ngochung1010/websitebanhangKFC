<?php
class Thanh_TruotModel extends CI_Model{
    public function insertSlider($data){
        return $this->db->insert('slider',$data); //THÊM DATA VÀO ĐÚNG BẲNG DANHMUC.
    }
    // //list danh muc 
    public function selectSlider(){
        $query = $this->db->get('slider'); //get('danhmuc') lấy toàn bộ.
        return $query->result();
    }
    //select
    public function selectSlideryId($id){
       $query = $this->db->get_where('slider',['id'=>$id]);
       return $query->row();
    }
    // //update
    public function updateSlider($data, $id){
        return $this->db->update('slider',$data,['id'=>$id]);
    }
    // //delete
    public function deleteSlider($id){
        return $this->db->delete('slider', ['id'=>$id]);
    }
}
?>