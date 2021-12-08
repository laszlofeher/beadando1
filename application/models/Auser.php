<?php

/**
 * Description of AUser
 *
 * @author feherlaszlo
 */
class Auser extends CI_Model{
    public function getUserByEmailPassword($email, $password){
        $password = hash('sha512',$password);
        $this->db->select('id, email, vezeteknev, utonev');
        $this->db->from('adminfelhasznalok');
        $this->db->where('email', $email);
        $this->db->where('jelszo', $password);
        $query = $this->db->get();
        if($query->num_rows() === 1){
            return $query->row_array();
        }
        return [];
    }
    
    public function getUserById($id){
        $id = (int)$id;
        $this->db->select('id, email, vezeteknev, utonev');
        $this->db->from('adminfelhasznalok');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() === 1){
            return $query->row_array();
        }
        return [];
    }
    
    public function update($id, $data){
        $id = (int)$id;
        $this->db->where('id', $id);
        $this->db->update('adminfelhasznalok', $data);
    }
}
