<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function total($table)
    {
        $query = $this->db->get($table)->num_rows();
        return $query;
    }

    public function get_where($table, $pk, $id, $join = null, $order = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($pk, $id);

        if($join !== null){
            foreach($join as $table => $field){
                $this->db->join($table, $field);
            }
        }
        
        if($order !== null){
            foreach($order as $field => $sort){
                $this->db->order_by($field, $sort);
            }
        }

        $query = $this->db->get();
        return $query;
    }

    public function getDashboardPesertaSKD($id)
    {
        //return $this->db->get('dashboard_peserta')->result();
        $this->db->select('*');
        $this->db->from('dashboard_peserta');
        $this->db->where('mahasiswa_id', $id);
        $this->db->where('matkul_id', 2);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }
    public function getDashboardPesertaSKB($id)
    {
        //return $this->db->get('dashboard_peserta')->result();
        $this->db->select('*');
        $this->db->from('dashboard_peserta');
        $this->db->where('mahasiswa_id', $id);
        $this->db->where('matkul_id', 1);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }
}