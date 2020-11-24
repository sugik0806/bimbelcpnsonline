<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends CI_Model {
    
    public function getDataSoal($id, $dosen)
    {
        $this->datatables->select('j.tipe, a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, b.nama_matkul, c.nama_dosen');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('matkul b', 'b.id_matkul=a.matkul_id');
        $this->datatables->join('dosen c', 'c.id_dosen=a.dosen_id');
        $this->datatables->join('jenis j', 'j.id=a.tipe');
        $this->db->order_by('a.id_soal', 'desc');
        // if ($id!==null && $dosen===null) {
        //     //$this->datatables->where('j.tipe', $id);
        //     $this->datatables->where('a.matkul_id', $id);             
        // }else if($id!==null && $dosen!==null){
        //     $this->datatables->where('a.dosen_id', $dosen);
        // }

        if($dosen!==null){
            $this->datatables->where('a.dosen_id', $dosen);
        }

        if ($id == 1 || $id == 2) {
            $this->datatables->where('a.matkul_id', $id);
        }elseif ($id == "TWK" || $id == "TIU" || $id == "TKP" || $id == "SKB") {
            $this->datatables->where('j.tipe', $id);
        }

         // print_r($id);
         // print_r($dosen);
        return $this->datatables->generate();
    }

    public function cekduplikasi($nama)
    {   
        $this->db->select('*');
        $this->db->from('tb_soal');
        $this->db->like('soal', $nama);
        //$builder->like('body', 'match');
        return $this->db->get()->result();
    }

    

    public function getDataSoalByUjian($id_ujian, $id_tipe)
    {
        $this->datatables->select('j.tipe, a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, b.nama_matkul, c.nama_dosen');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('matkul b', 'b.id_matkul=a.matkul_id');
        $this->datatables->join('dosen c', 'c.id_dosen=a.dosen_id');
        $this->datatables->join('jenis j', 'j.id=a.tipe');
        $this->db->order_by('a.id_soal', 'desc');
        if ($id_ujian!=='all') {
        $this->datatables->where('a.id_ujian', $id_ujian);
            if ($id_tipe!== 'all') {
                $this->datatables->where('j.tipe', $id_tipe);
            }
        }
        return $this->datatables->generate();

        // $this->db->set('review', $input{'review'});
        // $this->db->where('ujian_id', $where{'ujian_id'});
        // $this->db->where('mahasiswa_id', $where['mahasiswa_id']);
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('tb_soal', ['id_soal' => $id])->row();
    }

    public function getSoalByMatkulId($id, $id_ujian)
    {

        $this->db->select('
            (SELECT COUNT(tipe) from tb_soal WHERE matkul_id = '.$id.' and id_ujian = '.$id_ujian.' and tipe = 1 ) AS total_twk,
            (SELECT COUNT(tipe) from tb_soal WHERE matkul_id = '.$id.' and id_ujian = '.$id_ujian.' and tipe = 2 ) AS total_tiu,
            (SELECT COUNT(tipe) from tb_soal WHERE matkul_id = '.$id.' and id_ujian = '.$id_ujian.' and tipe = 3 ) AS total_tkp
            ');

        return $this->db->get()->row();

        //return $this->db->get_where('tb_soal', ['matkul_id' => $id, 'id_ujian' => $id_ujian])->result();
    }

     public function getCountSoalAll()
    {

        $this->db->select('*,
            (SELECT COUNT(tipe) from tb_soal) AS total
            ');
        $this->db->from('tb_soal');
        return $this->db->get()->result();

        //return $this->db->get_where('tb_soal', ['matkul_id' => $id, 'id_ujian' => $id_ujian])->result();
    }



}