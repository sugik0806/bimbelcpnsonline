<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    
      public function getPendapatan($tgl_awal, $tgl_akhir, $rekening, $statusTransfer)
    {
        // $this->datatables->select('
        //     m.id_mahasiswa, 
        //     m.nama, 
        //     k.nama_kelas, 
        //     k.harga, 
        //     m.angka_unik, 
        //     m.diskon, 
        //     m.rekening,
        //     (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net,
        //     m.tanggal_konfirmasi, 
        //     m.jumlah_bayar, 
        //     m.bayar_upgrade,
        //     (SELECT SUM(net) as total FROM mahasiswa INNER JOIN kelas ON mahasiswa.kelas_id = kelas.id_kelas INNER JOIN users ON users.email = mahasiswa.email WHERE mahasiswa.id_mahasiswa NOT IN (1)) as total'
        // );

        $this->datatables->select('
            m.id_mahasiswa, 
            m.nama, 
            k.nama_kelas, 
            k.harga, 
            m.angka_unik, 
            m.diskon, 
            m.rekening,
            (t.jumlah_bayar - m.referal_fee) as net,
            (t.tanggal_bayar) as tanggal_konfirmasi, 
            (SELECT SUM(net) as total FROM mahasiswa INNER JOIN kelas ON mahasiswa.kelas_id = kelas.id_kelas INNER JOIN users ON users.email = mahasiswa.email WHERE mahasiswa.id_mahasiswa NOT IN (1)) as total'
        );
        $this->datatables->from('mahasiswa m');
        $this->datatables->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->datatables->join('users u', 'u.email = m.email');
        $this->datatables->join('t_pembayaran t', 't.id_mahasiswa = m.id_mahasiswa');
        $this->datatables->where('t.id_mahasiswa !=', 1);
        $this->datatables->where('t.tanggal_bayar >=', $tgl_awal);
        $this->datatables->where('t.tanggal_bayar <=', $tgl_akhir);
        if ($rekening != 0) {
            $this->datatables->where('t.rekening', $rekening);
        }
        if ($statusTransfer != 'all') {
            $this->datatables->where('t.status_transfer', $statusTransfer);
        }
        
        $this->db->order_by('t.tanggal_bayar', 'asc');

        return $this->datatables->generate();
    }

    public function getPendapatanReport($tgl_awal, $tgl_akhir, $rekening)
    {
        //$this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, m.rekening, (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net');
        $this->db->select('
            m.id_mahasiswa,
            m.nama, 
            k.nama_kelas, 
            k.harga, 
            m.angka_unik, 
            m.diskon, 
            m.rekening, 
            (t.jumlah_bayar - m.referal_fee) as net
            ');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->join('t_pembayaran t', 't.id_mahasiswa = m.id_mahasiswa');
        $this->db->where_not_in('t.id_mahasiswa', 1);
        $this->db->where('t.tanggal_bayar >=', $tgl_awal);
        $this->db->where('t.tanggal_bayar <=', $tgl_akhir);
        if ($rekening != 0) {
            $this->db->where('t.rekening', $rekening);
        }
        $this->db->order_by('t.tanggal_bayar', 'asc');


        return $this->db->get()->result();
    }

    public function getPendapatanReportbyID($id)
    {
        $this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, m.referal_fee, m.tanggal_konfirmasi, (k.harga - m.angka_unik - m.diskon - m.referal_fee) as net');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where(['id_mahasiswa' => $id]);


        return $this->db->get()->result();
    }

        public function getPengeluaran($tgl_awal, $tgl_akhir, $rekening)
    {
        $this->db->select('*');
        $this->db->from('pengeluaran m');
        $this->db->where('m.tanggal_pengeluaran >=', $tgl_awal);
        $this->db->where('m.tanggal_pengeluaran <=', $tgl_akhir);
        $this->db->where('m.status_pengurangan', 0);
        if ($rekening != 0) {
            $this->db->where('m.rekening', $rekening);
        }
        $this->db->order_by('m.nama_pengeluaran', 'asc');

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
        $this->datatables->where('m.id_mahasiswa !=', 1);
        $this->datatables->where('m.tanggal_konfirmasi >=', $tgl_awal);
        $this->datatables->where('m.tanggal_konfirmasi <=', $tgl_akhir);
        $this->datatables->where('m.referal_fee >', 0);
        if ($penerima_fee != '0') {
            $this->datatables->where('m.referal', $penerima_fee);
        }
        $this->db->order_by('m.id_mahasiswa', 'asc');

        return $this->datatables->generate();
    }

    public function getFeeReport($tgl_awal, $tgl_akhir, $penerima_fee)
    {
        ///print_r($penerima_fee);
        //$this->db->select('m.id_mahasiswa, m.nama, k.nama_kelas, k.harga, m.angka_unik, m.diskon, k.harga, m.referal_fee, (SELECT nama_marketing FROM v_referal INNER JOIN mahasiswa ON mahasiswa.referal = v_referal.referal where mahasiswa.id_mahasiswa = m.id_mahasiswa) as penerima_fee');
        $this->db->select('
            m.id_mahasiswa, 
            m.nama, 
            k.nama_kelas, 
            k.harga, 
            m.angka_unik, 
            m.diskon, 
            k.harga, 
            m.referal_fee, 
            (SELECT nama_marketing FROM v_referal INNER JOIN mahasiswa ON mahasiswa.referal = v_referal.referal where mahasiswa.id_mahasiswa = m.id_mahasiswa) as penerima_fee
            ');
        $this->db->from('mahasiswa m');
        $this->db->join('kelas k', 'k.id_kelas = m.kelas_id');
        $this->db->join('users u', 'u.email = m.email');
        $this->db->where_not_in('m.id_mahasiswa', 1);
        $this->db->where('m.tanggal_konfirmasi >=', $tgl_awal);
        $this->db->where('m.tanggal_konfirmasi <=', $tgl_akhir);
        $this->db->where('m.referal_fee >', 0);
        if ($penerima_fee != '0') {
            $this->db->where('m.referal', $penerima_fee);
        }
        $this->db->order_by('m.id_mahasiswa', 'asc');


        return $this->db->get()->result();
    }


    /**
    * Data pengeluaran
    */

    public function getDataPengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->datatables->select('id_pengeluaran,tanggal_pengeluaran,nama_pengeluaran, nominal,rekening');
        $this->datatables->from('pengeluaran');
        $this->db->order_by('id_pengeluaran');
        $this->db->where('tanggal_pengeluaran >=', $tgl_awal);
        $this->db->where('tanggal_pengeluaran <=', $tgl_akhir);
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'id_pengeluaran, nama_pengeluaran, nominal');
        return $this->datatables->generate();
    }

    public function getPengeluaranById($id)
    {
        $this->db->where_in('id_pengeluaran', $id);
        $this->db->order_by('nama_pengeluaran');
        $query = $this->db->get('pengeluaran')->result();
        return $query;
    }


}


