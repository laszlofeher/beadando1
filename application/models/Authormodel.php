<?php

/**
 * Description of Authormodel
 *
 * @author feherlaszlo
 */
class Authormodel extends CI_Model{

    public function getAllAuthors(){
        $this->db->select('id, titulus, vezeteknev, utonev');
        $this->db->from('szerzo');
        $query = $this->db->get();
        $data = $query->result_array();
        $returnData = [];
        foreach ($data as $row) {
            $returnData[] = [   $row['id'],
                                $row['titulus'],
                                $row['vezeteknev'],
                                $row['utonev']
                            ];
        }
        return $returnData;
    }
    
    public function insertAuthor($titulus, $vezeteknev, $utonev){
        $data = $this->fillData($titulus, $vezeteknev, $utonev);
        $this->db->insert('szerzo', $data);
    }
    
    public function deleteAuthor($id){
        $this->db->where('id', $id);
        $this->db->delete('szerzo');
    }
    
    public function updateAuthor($id, $titulus, $vezeteknev, $utonev){
        $data = $this->fillData($titulus, $vezeteknev, $utonev);
        $this->db->where('id', $id);
        $this->db->update('szerzo', $data);
    }
    
    private function fillData($titulus, $vezeteknev, $utonev){
        $data['titulus']    = $titulus;
        $data['vezeteknev'] = $vezeteknev;
        $data['utonev']     = $utonev;
        return $data;
    }
}
