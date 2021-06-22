<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

    public function getDataDokumen($id, $kelas_id)
    {
         $this->datatables->select("*,  ($id) AS ada");
        $this->datatables->from('m_dokumen d');
        $this->datatables->join('matkul b', 'b.id_matkul=d.id_matkul');
        $this->datatables->join('jenis j', 'j.id=d.id_jenis');
        $this->datatables->where('d.aktif', 1);
        // if ($kelas_id == 1 && $id == 0) {
        //     $this->datatables->where('d.id_kelas', 1);
        // }
        
        $this->db->order_by('d.id_dokumen', 'asc');

        // SELECT * FROM `m_dokumen` `d` JOIN `matkul` `b` ON `b`.`id_matkul`=`d`.`id_dokumen` JOIN `jenis` `j` ON `j`.`id`=`d`.`id_dokumen` ORDER BY `d`.`id_dokumen` DESC, `nip` ASC LIMIT 10
        // if ($id!==null && $dosen===null) {
        //     //$this->datatables->where('j.tipe', $id);
        //     $this->datatables->where('a.matkul_id', $id);             
        // }else if($id!==null && $dosen!==null){
        //     $this->datatables->where('a.dosen_id', $dosen);
        // }

        // if($dosen!==null){
        //     $this->datatables->where('a.dosen_id', $dosen);
        // }

        // if ($id == 1 || $id == 2) {
        //     $this->datatables->where('a.matkul_id', $id);
        // }elseif ($id == "TWK" || $id == "TIU" || $id == "TKP") {
        //     $this->datatables->where('j.tipe', $id);
        // }

         // print_r($id);
         // print_r($dosen);
        return $this->datatables->generate();
    }

    public function getDokumenById($id)
    {
        return $this->db->get_where('m_dokumen', ['id_dokumen' => $id])->row();
    }

}