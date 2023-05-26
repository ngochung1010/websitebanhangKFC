<?php
class comboModel extends CI_Model{
    public function insertCombo($data){
        return $this->db->insert('danhmuc',$data); //THÊM DATA VÀO ĐÚNG BẲNG DANHMUC.
    }
    //list danh muc 
    public function selectCombo(){
        $query = $this->db->get('danhmuc'); //get('danhmuc') lấy toàn bộ.
        return $query->result();
    }
    //select
    public function selectComboById($id){
       $query = $this->db->get_where('danhmuc',['id'=>$id]);
       return $query->row();
    }
    //update
    public function updateCombo($data, $id){
        return $this->db->update('danhmuc',$data,['id'=>$id]);
    }
    //delete
    public function deleteCombo($id){
        return $this->db->delete('danhmuc', ['id'=>$id]);
    }
}
?>