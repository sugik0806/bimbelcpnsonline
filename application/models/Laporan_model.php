<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    
      public function getPendapatan()
    {
        $this->datatables->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, (k.harga - m.angka_unik - m.diskon) as net');
        $this->datatables->from('mahasiswa m');
        $this->datatables->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->datatables->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);

        return $this->datatables->generate();
    }

    public function getPendapatanReport()
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, (k.harga - m.angka_unik - m.diskon) as net');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);


        return $this->db->get()->result();
    }

    public function getPendapatanReportbyID($id)
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, m.tanggal_daftar, (k.harga - m.angka_unik - m.diskon) as net');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where(['id_mahasiswa' => $id]);


        return $this->db->get()->result();
    }

}


