<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AppModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    //pobieranie calej tabelki
    public function select($table) {
        $query = $this->db->get($table);
        return $query->result();
    }
    
    //dodawanie rekordów
    public function insert($table, $data) {
        $this->db->insert($table, $data);
    }
    
    //wyszukiwanie rekordu po czyms
    public function selectWhere($table, $where1, $where2) {
        $this->db->where($where1, $where2);
        
        $query = $this->db->get($table);
        return $query->result();
    }

    //wyszukiwanie rekordu po czyms i po czyms
    public function selectWhereWhere($table, $where1, $where2, $where3, $where4) {
        $this->db->where($where1, $where2);
        $this->db->where($where3, $where4);
        
        $query = $this->db->get($table);
        return $query->result();
    }

    //wyszukiwanie rekordu po czyms i po czyms i po czyms
    public function selectWhereWhereWhere($table, $where1, $where2, $where3, $where4, $where5, $where6) {
        $this->db->where($where1, $where2);
        $this->db->where($where3, $where4);
        $this->db->where($where5, $where6);
        
        $query = $this->db->get($table);
        return $query->result();
    }
    
    //update konkretnego rekordu
    public function updateWhere($table, $where1, $where2, $data) {
        $this->db->set($data);
        $this->db->where($where1, $where2);
        
        $this->db->update($table, $data);
    }
    
    //usuwanie konkretnego rekordu
    public function deleteWhere($table, $where1, $where2) {
        $this->db->where($where1, $where2);
        $this->db->delete($table);
    }
    
}
