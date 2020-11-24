<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_model extends CI_Model {
    public function create($table, $data, $batch = false)
    {
        if($batch === false){
            $insert = $this->db->insert($table, $data);
        }else{
            $insert = $this->db->insert_batch($table, $data);
        }
        return $insert;
    }

    public function update($table, $data, $pk, $id = null, $batch = false)
    {
        if($batch === false){
            $insert = $this->db->update($table, $data, array($pk => $id));
        }else{
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }

    public function delete($table, $data, $pk)
    {
        $this->db->where_in($pk, $data);
        return $this->db->delete($table);
    }
    public function getDataSoal($id, $dosen)
    {
        $this->datatables->select('j.tipe, a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, b.nama_matkul, c.nama_dosen');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('matkul b', 'b.id_matkul=a.matkul_id');
        $this->datatables->join('dosen c', 'c.id_dosen=a.dosen_id');
        $this->datatables->join('jenis j', 'j.id=a.tipe');
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
        }elseif ($id == "TWK" || $id == "TIU" || $id == "TKP") {
            $this->datatables->where('j.tipe', $id);
        }

         // print_r($id);
         // print_r($dosen);
        return $this->datatables->generate();
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('tb_soal', ['id_soal' => $id])->row();
    }


}