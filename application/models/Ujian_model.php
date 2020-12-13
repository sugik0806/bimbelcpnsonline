<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_model extends CI_Model {
    
    public function getDataUjian($id)
    {

         // (SELECT COUNT(id) FROM tb_soal h WHERE h.matkul_id = a.matkul_id AND h.id_ujian = a.id_ujian) as total
        //case (a.terbit when 1 then "terbit" when 2 then "review" end) as terbit
        

        $this->datatables->select('(
            SELECT COUNT(id_soal) FROM tb_soal h WHERE h.matkul_id = a.matkul_id AND h.id_ujian = a.id_ujian) as total,
             a.id_ujian,
             a.token,
             a.nama_ujian,
             b.nama_matkul,
             a.jumlah_soal,
             CONCAT(a.tgl_mulai, " <br/> (", a.waktu, " Menit)") as waktu,
             a.jenis,
             a.terbit'
         );
        $this->datatables->from('m_ujian a');
        $this->datatables->join('matkul b', 'a.matkul_id = b.id_matkul');
        if($id!==null){
            $this->datatables->where('dosen_id', $id);
        }
        return $this->datatables->generate();
    }
    
    public function getListUjian($id, $kelas, $id_matkul)
    {
        $this->datatables->select("a.id_ujian, e.nama_dosen, d.nama_kelas, a.nama_ujian, b.nama_matkul, a.jumlah_soal, CONCAT(a.tgl_mulai, ' <br/> (', a.waktu, ' Menit)') as waktu, a.terlambat, (SELECT COUNT(id) FROM h_ujian h WHERE h.mahasiswa_id = {$id} AND h.ujian_id = a.id_ujian AND h.status = 'N') AS ada");
        $this->datatables->from('m_ujian a');
        $this->datatables->join('matkul b', 'a.matkul_id = b.id_matkul');
        $this->datatables->join('kelas_dosen c', "a.dosen_id = c.dosen_id");
        $this->datatables->join('kelas d', 'c.kelas_id = d.id_kelas');
        $this->datatables->join('dosen e', 'e.id_dosen = c.dosen_id');
        $this->datatables->where('d.id_kelas', $kelas);
        $this->datatables->where('b.id_matkul', $id_matkul);
        $this->datatables->where('a.terbit', true);
        return $this->datatables->generate();
    }

    public function getListUjianbox($id, $kelas, $id_matkul)
    {
        $this->db->select("a.id_ujian, e.nama_dosen, d.nama_kelas, a.nama_ujian, b.nama_matkul, a.jumlah_soal, CONCAT(a.tgl_mulai, ' <br/> (', a.waktu, ' Menit)') as waktu,  (SELECT COUNT(id) FROM h_ujian h WHERE h.mahasiswa_id = {$id} AND h.ujian_id = a.id_ujian AND h.status = 'N') AS ada");
        $this->db->from('m_ujian a');
        $this->db->join('matkul b', 'a.matkul_id = b.id_matkul');
        $this->db->join('kelas_dosen c', "a.dosen_id = c.dosen_id");
        $this->db->join('kelas d', 'c.kelas_id = d.id_kelas');
        $this->db->join('dosen e', 'e.id_dosen = c.dosen_id');
        $this->db->where('d.id_kelas', $kelas);
        $this->db->where('b.id_matkul', $id_matkul);
        $this->db->where('a.terbit', true);
        return $this->db->get()->result();

    }

    public function getUjianById($id)
    {
        $this->db->select('*');
        $this->db->from('m_ujian a');
        $this->db->join('dosen b', 'a.dosen_id=b.id_dosen');
        $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->where('id_ujian', $id);
        return $this->db->get()->row();
    }

        public function getUjianByIdMatkul($id)
    {
        $this->db->select('*');
        $this->db->from('m_ujian a');
        $this->db->join('dosen b', 'a.dosen_id=b.id_dosen');
        $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->where('a.matkul_id', $id);
        return $this->db->get()->result();
    }

        public function getUjianAll()
    {
        $this->db->select('*');
        $this->db->from('m_ujian a');
        $this->db->join('dosen b', 'a.dosen_id=b.id_dosen');
        $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->order_by('nama_ujian');
        return $this->db->get()->result();
    }

     public function getUjianTerbit()
    {
        $this->db->select('*');
        $this->db->from('m_ujian a');
        $this->db->join('dosen b', 'a.dosen_id=b.id_dosen');
        $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->order_by('nama_ujian');
        $this->db->where('a.terbit', 1);
        return $this->db->get()->result();
    }

    public function getIdDosen($nip)
    {
        $this->db->select('id_dosen, nama_dosen')->from('dosen')->where('nip', $nip);
        return $this->db->get()->row();
    }

    public function getJumlahSoal($dosen)
    {
        $this->db->select('COUNT(id_soal) as jml_soal');
        $this->db->from('tb_soal');
        $this->db->where('dosen_id', $dosen);
        return $this->db->get()->row();
    }

    public function getIdMahasiswa($nim)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa a');
        $this->db->join('kelas b', 'a.kelas_id=b.id_kelas');
        $this->db->join('jurusan c', 'b.jurusan_id=c.id_jurusan');
        $this->db->where('nim', $nim);
        return $this->db->get()->row();
    }

    public function HslUjian($id, $mhs)
    {
        $this->db->select('*, UNIX_TIMESTAMP(tgl_selesai) as waktu_habis');
        $this->db->from('h_ujian');
        $this->db->where('ujian_id', $id);
        $this->db->where('mahasiswa_id', $mhs);
        return $this->db->get();
    }

    public function HslUjianStatus($id, $mhs)
    {   
        $this->db->select('*');
        $this->db->from('h_ujian');
        $this->db->where('id', $id);
        $this->db->where('mahasiswa_id', $mhs);
        return $this->db->get()->row();
    }

    public function getPertanyaan($id, $mhs, $id_soal)
    {   
        $this->db->select('*');
        $this->db->from('pertanyaan_detail');
        $this->db->where('id_test', $id);
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('id_soal', $id_soal);
        return $this->db->get()->result();
    }

       public function getPertanyaanBy($id, $mhs)
    {   
        $this->db->select('*');
        $this->db->from('pertanyaan_detail');
        $this->db->where('id_test', $id);
        $this->db->where('id_mahasiswa', $mhs);
        return $this->db->get()->result();
    }

       public function getPertanyaanAll($id)
    {   
        $this->db->select('*, p.jawaban as jawaban_pertanyaan , (SELECT jawaban FROM tb_soal ts WHERE ts.id_soal =  p.id_soal ) as jawaban_benar');
        //soal, file, file_a, file_b, file_c ,file_d, file_e, p.id_soal, h.list_soal, h.list_jawaban, mu.nama_ujian, m.nama, p.created_date, p.answer_date, p.pertanyaan, p.jawaban, p.id_soal, p.id_test, p.id_mahasiswa

        //(SELECT soal FROM tb_soal ts WHERE ts.id_soal =  p.id_soal ) as soal,
        $this->db->from('pertanyaan_detail p');
        $this->db->join('mahasiswa m', 'p.id_mahasiswa=m.id_mahasiswa');
        $this->db->join('h_ujian h', 'h.id=p.id_test');
        $this->db->join('m_ujian mu', 'h.ujian_id=mu.id_ujian');
        $this->db->join('tb_soal ts', 'p.id_soal=ts.id_soal');
        $this->db->where('pertanyaan !=', "");
        if ($id == 2) {
           // print_r($id);
            $this->db->where('p.jawaban =', null);
        }else if ($id == 1){
            $this->db->where('p.jawaban !=', null);
        }
        
        //$this->db->where('id_test', $id);
        //$this->db->where('id_mahasiswa', $mhs);
        return $this->db->get()->result();
    }

public function getJumlahPertanyaan($id, $mhs, $id_soal)
    {   
        $this->db->select('COUNT(id_pertanyaan) as jml_pertanyaan');
        $this->db->from('pertanyaan_detail');
        $this->db->where('id_test', $id);
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('id_soal', $id_soal);
        $this->db->where('pertanyaan !=', "");
        return $this->db->get()->row();
    }





    public function getSoal($id)
    {
        $ujian = $this->getUjianById($id);
        $order = $ujian->jenis==="acak" ? 'rand()' : 'id_soal';

        $this->db->select('id_soal, soal, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $this->db->from('tb_soal');
        $this->db->where('dosen_id', $ujian->dosen_id);
        $this->db->where('matkul_id', $ujian->matkul_id);
        $this->db->where('tipe', 1);
        $this->db->where('id_ujian', $id);
        $this->db->order_by($order);
        //$this->db->limit($ujian->jumlah_soal);
        $this->db->limit(30);
        return $this->db->get()->result();
    }
    public function getSoalTIU($id)
    {
        $ujian = $this->getUjianById($id);
        $order = $ujian->jenis==="acak" ? 'rand()' : 'id_soal';

        $this->db->select('id_soal, soal, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $this->db->from('tb_soal');
        $this->db->where('dosen_id', $ujian->dosen_id);
        $this->db->where('matkul_id', $ujian->matkul_id);
        $this->db->where('tipe', 2);
        $this->db->where('id_ujian', $id);
        $this->db->order_by($order);
        //$this->db->limit($ujian->jumlah_soal);
        $this->db->limit(35);
        return $this->db->get()->result();
    }
    public function getSoalTKP($id)
    {
        $ujian = $this->getUjianById($id);
        $order = $ujian->jenis==="acak" ? 'rand()' : 'id_soal';

        $this->db->select('id_soal, soal, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $this->db->from('tb_soal');
        $this->db->where('dosen_id', $ujian->dosen_id);
        $this->db->where('matkul_id', $ujian->matkul_id);
        $this->db->where('tipe', 3);
        $this->db->where('id_ujian', $id);
        $this->db->order_by($order);
        //$this->db->limit($ujian->jumlah_soal);
        $this->db->limit(35);
        return $this->db->get()->result();
    }

    public function getSoalSKB($id)
    {
        $ujian = $this->getUjianById($id);
        $order = $ujian->jenis==="acak" ? 'rand()' : 'id_soal';

        $this->db->select('id_soal, soal, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $this->db->from('tb_soal');
        $this->db->where('dosen_id', $ujian->dosen_id);
        $this->db->where('matkul_id', 1);
        $this->db->where('tipe', 4);
        $this->db->where('id_ujian', $id);
        $this->db->order_by($order);
        $this->db->limit($ujian->jumlah_soal);
        return $this->db->get()->result();
    }


    public function ambilSoal($pc_urut_soal1, $pc_urut_soal_arr)
    {
        $this->db->select("*, {$pc_urut_soal1} AS jawabanpc");
        $this->db->from('tb_soal');
        $this->db->join('jenis j', 'tb_soal.tipe=j.id');
        $this->db->where('id_soal', $pc_urut_soal_arr);
        return $this->db->get()->row();
    }

    public function getJawaban($id_tes)
    {
        $this->db->select('list_jawaban');
        $this->db->from('h_ujian');
        $this->db->where('id', $id_tes);
        return $this->db->get()->row()->list_jawaban;
    }

    public function getHasilUjian($nip = null)
    {
        $this->datatables->select('b.id_ujian, b.nama_ujian, b.jumlah_soal, CONCAT(b.waktu, " Menit") as waktu, b.tgl_mulai');
        $this->datatables->select('c.nama_matkul, d.nama_dosen, a.mahasiswa_id');
        $this->datatables->from('h_ujian a');
        $this->datatables->join('m_ujian b', 'a.ujian_id = b.id_ujian');
        $this->datatables->join('matkul c', 'b.matkul_id = c.id_matkul');
        $this->datatables->join('dosen d', 'b.dosen_id = d.id_dosen');
        $this->datatables->group_by('b.id_ujian');
        if($nip !== null){
            $this->datatables->where('d.nip', $nip);
        }
        return $this->datatables->generate();
    }

    public function getHasilUjianMhs($mahasiswa_id)
    {
        $this->datatables->select('b.id_ujian, b.nama_ujian, b.jumlah_soal, CONCAT(b.waktu, " Menit") as waktu, b.tgl_mulai');
        $this->datatables->select('c.nama_matkul, d.nama_dosen, a.mahasiswa_id');
        $this->datatables->from('h_ujian a');
        $this->datatables->join('m_ujian b', 'a.ujian_id = b.id_ujian');
        $this->datatables->join('matkul c', 'b.matkul_id = c.id_matkul');
        $this->datatables->join('dosen d', 'b.dosen_id = d.id_dosen');
        $this->datatables->group_by('b.id_ujian');

        if($mahasiswa_id !== null){
            $this->datatables->where('a.mahasiswa_id', $mahasiswa_id);
        }
        return $this->datatables->generate();
    }

    public function getHasilUjianAdm()
    {
        $this->datatables->select('b.id_ujian, b.nama_ujian, b.jumlah_soal, CONCAT(b.waktu, " Menit") as waktu, b.tgl_mulai');
        $this->datatables->select('c.nama_matkul, d.nama_dosen, a.mahasiswa_id');
        $this->datatables->from('h_ujian a');
        $this->datatables->join('m_ujian b', 'a.ujian_id = b.id_ujian');
        $this->datatables->join('matkul c', 'b.matkul_id = c.id_matkul');
        $this->datatables->join('dosen d', 'b.dosen_id = d.id_dosen');
        $this->datatables->group_by('b.id_ujian');


        return $this->datatables->generate();
    }

    public function HslUjianById($id, $dt=false)
    {
        if($dt===false){
            $db = "db";
            $get = "get";
        }else{
            $db = "datatables";
            $get = "generate";
        }
        
        $this->$db->select('d.id, a.nama, b.nama_kelas, c.nama_jurusan, d.jml_benar, d.twk, d.tiu, d.tkp, d.nilai');
        $this->$db->from('mahasiswa a');
        $this->$db->join('kelas b', 'a.kelas_id=b.id_kelas');
        $this->$db->join('jurusan c', 'b.jurusan_id=c.id_jurusan');
        $this->$db->join('h_ujian d', 'a.id_mahasiswa=d.mahasiswa_id');
        $this->$db->where(['d.ujian_id' => $id]);
        return $this->$db->$get();
    }

    public function bandingNilai($id)
    {
        $this->db->select_min('nilai', 'min_nilai');
        $this->db->select_max('nilai', 'max_nilai');
        $this->db->select_avg('FORMAT(FLOOR(nilai),0)', 'avg_nilai');
        $this->db->where('ujian_id', $id);
        return $this->db->get('h_ujian')->row();
    }

     public function updateStatus($input, $where)
    {
        $this->db->set('review', $input{'review'});
        $this->db->where('ujian_id', $where{'ujian_id'});
        $this->db->where('mahasiswa_id', $where['mahasiswa_id']);
        $this->db->update('h_ujian'); 
        // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }

     public function modeNormal($input, $where)
    {
        $this->db->set('review', $input{'review'});
        $this->db->set('status', $input{'status'});
        $this->db->set('tgl_selesai', $input{'tgl_selesai'});
        
        $this->db->where('ujian_id', $where{'ujian_id'});
        $this->db->update('h_ujian'); 
        // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }

     public function updatePertanyaan($input, $where)
    {
        $this->db->set('pertanyaan', $input{'pertanyaan'});
        $this->db->set('created_date', $input{'created_date'});
        
        $this->db->where('id_soal', $where{'id_soal'});
        $this->db->where('id_test', $where['id_test']);
        $this->db->where('id_mahasiswa', $where['id_mahasiswa']);
        $this->db->update('pertanyaan_detail'); 
        // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }

     public function updatePertanyaan1($input, $where)
    {
        $this->db->set('jawaban', $input{'jawaban'});
        $this->db->set('answer_date', $input{'answer_date'});
        
        $this->db->where('id_pertanyaan', $where{'id_pertanyaan'});
        $this->db->update('pertanyaan_detail'); 
        // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }

}