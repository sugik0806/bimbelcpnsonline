<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    
      public function getPendapatan()
    {
        $this->datatables->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net, (SELECT SUM(net) as total FROM mahasiswa INNER JOIN kelas ON mahasiswa.kelas_id = kelas.id_kelas INNER JOIN users ON users.email = mahasiswa.email WHERE mahasiswa.id_mahasiswa NOT IN (1)) as total');
        $this->datatables->from('mahasiswa m');
        $this->datatables->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->datatables->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->order_by('m.id_mahasiswa', 'asc');

        return $this->datatables->generate();
    }

    public function getPendapatanReport()
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->order_by('m.id_mahasiswa', 'asc');


        return $this->db->get()->result();
    }

    public function getPendapatanReportbyID($id)
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, m.referal_fee, m.tanggal_daftar, (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where(['id_mahasiswa' => $id]);


        return $this->db->get()->result();
    }

    public function getFee()
    {
        $this->datatables->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, (k.harga) as net, m.referal_fee as fee, (SELECT nama_marketing FROM v_referal INNER JOIN mahasiswa ON mahasiswa.referal = v_referal.referal where mahasiswa.id_mahasiswa = m.id_mahasiswa) as penerima_fee, (SELECT SUM(net) as total FROM mahasiswa INNER JOIN kelas ON mahasiswa.kelas_id = kelas.id_kelas INNER JOIN users ON users.email = mahasiswa.email WHERE mahasiswa.id_mahasiswa NOT IN (1)) as total');
        $this->datatables->from('mahasiswa m');
        $this->datatables->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->datatables->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->order_by('m.id_mahasiswa', 'asc');

        return $this->datatables->generate();
    }

    public function getFeeReport()
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, k.harga, m.referal_fee, (SELECT nama_marketing FROM v_referal INNER JOIN mahasiswa ON mahasiswa.referal = v_referal.referal where mahasiswa.id_mahasiswa = m.id_mahasiswa) as penerima_fee');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->order_by('m.id_mahasiswa', 'asc');


        return $this->db->get()->result();
    }


}


