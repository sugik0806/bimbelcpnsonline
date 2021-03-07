<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    
      public function getPendapatan($tgl_awal, $tgl_akhir, $rekening)
    {
        $this->datatables->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, m.rekening,(k.harga - m.angka_unik - m.diskon - m.referal_fee) as net,m.tanggal_daftar ,(SELECT SUM(net) as total FROM mahasiswa INNER JOIN kelas ON mahasiswa.kelas_id = kelas.id_kelas INNER JOIN users ON users.email = mahasiswa.email WHERE mahasiswa.id_mahasiswa NOT IN (1)) as total');
        $this->datatables->from('mahasiswa m');
        $this->datatables->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->datatables->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->where('m.tanggal_daftar >=', $tgl_awal);
        $this->db->where('m.tanggal_daftar <=', $tgl_akhir);
        if ($rekening != 0) {
            $this->db->where('m.rekening', $rekening);
        }
        
        $this->db->order_by('m.id_mahasiswa', 'asc');

        return $this->datatables->generate();
    }

    public function getPendapatanReport($tgl_awal, $tgl_akhir, $rekening)
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, m.rekening, (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->where('m.tanggal_daftar >=', $tgl_awal);
        $this->db->where('m.tanggal_daftar <=', $tgl_akhir);
        if ($rekening != 0) {
            $this->db->where('m.rekening', $rekening);
        }
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

    public function getFee($tgl_awal, $tgl_akhir, $penerima_fee)
    {
        $this->datatables->select('
            m.id_mahasiswa, m.nama, 
            k.nama_kelas, 
            k.harga, 
            m.angka_unik, 
            m.diskon, 
            (k.harga) as net, 
            m.referal_fee as fee, 
            (SELECT nama_marketing FROM v_referal INNER JOIN mahasiswa ON mahasiswa.referal = v_referal.referal where mahasiswa.id_mahasiswa = m.id_mahasiswa) as penerima_fee, 
            (SELECT SUM(net) as total FROM mahasiswa INNER JOIN kelas ON mahasiswa.kelas_id = kelas.id_kelas INNER JOIN users ON users.email = mahasiswa.email WHERE mahasiswa.id_mahasiswa NOT IN (1)) as total
            ');
        $this->datatables->from('mahasiswa m');
        $this->datatables->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->datatables->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->where('m.tanggal_daftar >=', $tgl_awal);
        $this->db->where('m.tanggal_daftar <=', $tgl_akhir);
        if ($penerima_fee != '0') {
            $this->db->where('m.referal', $penerima_fee);
        }
        $this->db->order_by('m.id_mahasiswa', 'asc');

        return $this->datatables->generate();
    }

    public function getFeeReport($tgl_awal, $tgl_akhir, $penerima_fee)
    {
        ///print_r($penerima_fee);
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, k.harga, m.referal_fee, (SELECT nama_marketing FROM v_referal INNER JOIN mahasiswa ON mahasiswa.referal = v_referal.referal where mahasiswa.id_mahasiswa = m.id_mahasiswa) as penerima_fee');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->where('m.tanggal_daftar >=', $tgl_awal);
        $this->db->where('m.tanggal_daftar <=', $tgl_akhir);
        if ($penerima_fee != '0') {
            $this->db->where('m.referal', $penerima_fee);
        }
        $this->db->order_by('m.id_mahasiswa', 'asc');


        return $this->db->get()->result();
    }


}


