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

    // public function getDashboardPesertaSKD($id)
    // {
    //     //return $this->db->get('dashboard_peserta')->result();
    //     $this->db->select('*');
    //     $this->db->from('dashboard_peserta');
    //     $this->db->where('mahasiswa_id', $id);
    //     $this->db->where('matkul_id', 2);
    //     $this->db->order_by('id', 'desc');
    //     return $this->db->get()->result();
    // }

    public function getDashboardPesertaSKD($id)
    {
        $this->db->select("h.id, h.mahasiswa_id, '' AS `box`, h.nilai_bobot as total, mu.nama_ujian as title, '' AS `icon`, '' AS `url`, mu.matkul_id");
        $this->db->from('h_ujian h');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = h.mahasiswa_id');
        $this->db->join('m_ujian mu', "mu.id_ujian = h.ujian_id");
        $this->db->join('kelas d', 'm.kelas_id = d.id_kelas');
        $this->db->where('mu.matkul_id', 2);
        $this->db->where('m.id_mahasiswa', $id);
        return $this->db->get()->result();

    }

//     SELECT
//     `h_ujian`.`id` AS `id`,
//     `h_ujian`.`mahasiswa_id` AS `mahasiswa_id`,
//     '' AS `box`,
//     `h_ujian`.`nilai_bobot` AS `total`,
//     `m_ujian`.`nama_ujian` AS `title`,
//     '' AS `icon`,
//     '' AS `url`,
//     `m_ujian`.`matkul_id` AS `matkul_id` 
// FROM
//     (
//         (
//             ( `h_ujian` JOIN `mahasiswa` ON ( `h_ujian`.`mahasiswa_id` = `mahasiswa`.`id_mahasiswa` ) )
//             JOIN `kelas` ON ( `mahasiswa`.`kelas_id` = `kelas`.`id_kelas` ) 
//         )
//     JOIN `m_ujian` ON ( `h_ujian`.`ujian_id` = `m_ujian`.`id_ujian` ) 
//     ) 


    // public function getDashboardPesertaSKB($id)
    // {
    //     //return $this->db->get('dashboard_peserta')->result();
    //     $this->db->select('*');
    //     $this->db->from('dashboard_peserta');
    //     $this->db->where('mahasiswa_id', $id);
    //     $this->db->where('matkul_id', 1);
    //     $this->db->order_by('id', 'desc');
    //     return $this->db->get()->result();
    // }

    public function getDashboardPesertaSKB($id)
    {
        $this->db->select("h.id, h.mahasiswa_id, '' AS `box`, h.nilai_bobot as total, mu.nama_ujian as title, '' AS `icon`, '' AS `url`, mu.matkul_id");
        $this->db->from('h_ujian h');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = h.mahasiswa_id');
        $this->db->join('m_ujian mu', "mu.id_ujian = h.ujian_id");
        $this->db->join('kelas d', 'm.kelas_id = d.id_kelas');
        $this->db->where('mu.matkul_id', 1);
        $this->db->where('m.id_mahasiswa', $id);
        return $this->db->get()->result();

    }

    public function getDashboardPesertaGEO()
    {

        $this->db->select("p.nama_provinsi, COUNT(p.nama_provinsi) as total");
        $this->db->from('mahasiswa m');
        $this->db->join('m_provinsi p', 'p.id_provinsi = m.id_provinsi');
        $this->db->group_By("p.nama_provinsi");
        $this->db->order_By("p.nama_provinsi");
        return $this->db->get()->result();

    }

}