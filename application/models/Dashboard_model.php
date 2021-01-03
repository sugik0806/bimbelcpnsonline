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


    public function getDashboardPesertaUjian($id, $id_matkul)
    {
        $this->db->select("h.id, h.mahasiswa_id, '' AS `box`, h.nilai_bobot as total, mu.nama_ujian as title, '' AS `icon`, '' AS `url`, mu.matkul_id");
        $this->db->from('h_ujian h');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = h.mahasiswa_id');
        $this->db->join('m_ujian mu', "mu.id_ujian = h.ujian_id");
        $this->db->join('kelas d', 'm.kelas_id = d.id_kelas');
        $this->db->where('mu.matkul_id', $id_matkul);
        $this->db->where('m.id_mahasiswa', $id);
        return $this->db->get()->result();

    }


    public function getDashboardPesertaGEO()
    {

        $this->db->select("p.nama_provinsi, COUNT(p.nama_provinsi) as total");
        $this->db->from('mahasiswa m');
        $this->db->join('m_provinsi p', 'p.id_provinsi = m.id_provinsi');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->group_By("p.nama_provinsi");
        $this->db->order_By("p.nama_provinsi");
        return $this->db->get()->result();

    }

    public function getDashboardPesertaRanking($id)
    {

        $this->db->select("mahasiswa.nama, ROUND(Avg(h_ujian.nilai)) as nilai_rata, m_provinsi.nama_provinsi");
        $this->db->from('mahasiswa');
        $this->db->join('m_provinsi', 'm_provinsi.id_provinsi = mahasiswa.id_provinsi');
        $this->db->join('h_ujian', 'h_ujian.mahasiswa_id = mahasiswa.id_mahasiswa');
        $this->db->where('mahasiswa.id_matkul', $id);
        $this->db->group_By("mahasiswa.nama");
        $this->db->order_By("nilai_rata", "desc");
        $this->db->limit(10);
        return $this->db->get()->result();

    }

}