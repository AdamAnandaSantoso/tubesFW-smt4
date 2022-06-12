<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuModel extends Model
{
    protected $table = 'satu';

    //method untuk input data
    //dokumen dan gambar menjadi paramter inputan karena namanya sudah diganti
    public function insertData($dok, $gbr)
    {
        $input_text = $_POST['input_text'];
        $input_radio = $_POST['input_radio'];
        $input_check = $_POST['input_check'];
        $input_combo = $_POST['input_combo'];
        $input_tanggal = $_POST['input_tanggal'];
        $str = $_POST['input_uang'];
        $pattern = '/[^0-9 ]/i';
        $input_uang = preg_replace($pattern, '', $str);

        // $tgl = substr($_POST['waktu'],0,10); 
        //mengembalikan 2021-02-28
        // $wkt = substr($_POST['waktu'],11); 
        //mengembalikan  17:44
        // $tgl_wkt = $tgl."-".$wkt.":00"; 
        //mengembalikan 2021-02-28 17:44

        // proses insert data menggunakan query builder CI
        // array($tanggal, $tgl_wkt, $gender, $gbr, $dok)
        $db = db_connect();
        $builder = $db->table('satu');
        $data = [
            'input_text' => $input_text,
            'input_radio'  => $input_radio,
            'input_combo'  => $input_combo,
            'input_tanggal'  => $input_tanggal,
            'input_uang'  => $input_uang,
            'input_foto'  => $gbr,
            'input_dokumen'  => $dok,
        ];
        $builder->insert($data);

        //dapatkan id autoincrement dulu dari data yang tersimpan menggunakan native query
        $dbResult = $this->db->query("SELECT MAX(id_satu) as id_mak FROM satu");
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row) {
            $id_mak = $row->id_mak;
        }

        //karena hoby bisa banyak maka dilooping
        for ($i = 0; $i < count($input_check); $i++) {
            //input ke tabel detail menggunakan native query
            $hasil = $this->db->query("INSERT INTO satu_detail SET id_satu = ?, input_check=?", array($id_mak, $input_check[$i]));
        }

        return $hasil;
    }

    //mendapatkan data
    public function getData()
    {
        $sql = "SELECT a.*, 
        (SELECT group_concat(input_check separator '<br>') FROM satu_detail b WHERE a.id_satu=b.id_satu) as input_check 
        FROM satu a";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();
    }

    //mendapatkan data form input berdasarkan id untuk proses edit data
    public function getDataById($id)
    {
        $db = db_connect();
        $query   = $db->query('SELECT * FROM satu WHERE id_satu = ? ', array($id));
        $results = $query->getResult();
        return $results;
        // $sql = "SELECT * FROM satu WHERE id_satu = ?";
        // $dbResult = $this->db->query($sql, array($id));
        // return $dbResult->getResult();
    }

    //mendapatkan data form input detail berdasarkan id untuk proses edit data
    public function getDataDetailById($id)
    {
        $sql = "SELECT * FROM satu_detail WHERE id_satu = ?";
        $dbResult = $this->db->query($sql, array($id));
        return $dbResult->getResult();
    }

    //menghapus data
    public function deleteData($id)
    {
        //dapatkan data nama file berdasarkan id file
        $dbResult = $this->db->query("SELECT input_foto, input_dokumen FROM satu WHERE id_satu = ?", array($id));
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row) {
            $nama_file_gambar = $row->input_foto;
            $nama_file_dokumen = $row->input_dokumen;
        }

        //delete file di server
        if (is_file(FCPATH . 'dokumen/upload/' . $nama_file_dokumen)) {
            unlink(FCPATH . 'dokumen/upload/' . $nama_file_dokumen); //delete file dokumen
        }
        if (is_file(FCPATH . 'dokumen/upload/' . $nama_file_gambar)) {
            unlink(FCPATH . 'dokumen/upload/' . $nama_file_gambar); //delete file gambar
        }


        $hasil = $this->db->query("DELETE FROM satu_detail WHERE id_satu = ?", array($id));
        //hapus tabel induknya
        $hasil = $this->db->query("DELETE FROM satu WHERE id_satu = ?", array($id));

        //hapus tabel anaknya

    }

    //update data
    public function updateData($dok, $gbr)
    {
        $input_text = $_POST['input_text'];
        $input_radio = $_POST['input_radio'];
        $input_check = $_POST['input_check'];
        $input_combo = $_POST['input_combo'];
        $input_tanggal = $_POST['input_tanggal'];
        $str = $_POST['input_uang'];
        $pattern = '/[^0-9 ]/i';
        $input_uang = preg_replace($pattern, '', $str);

        $hasil = $this->db->query("UPDATE satu SET input_text = ?, input_radio=?, input_combo=?, input_tanggal=?, input_uang=?, input_foto=?, input_dokumen = ? WHERE id_satu=?", array($input_text, $input_radio, $input_combo, $input_tanggal, $input_uang, $gbr, $dok, $_POST['id_satu']));

        //delete dulu ditabel anak, baru dimasukkan lagi
        $hasil = $this->db->query("DELETE FROM satu_detail WHERE id_satu=?", array($_POST['id_satu']));


        //karena hoby bisa banyak maka dilooping
        for ($i = 0; $i < count($input_check); $i++) {
            //input ke tabel detail
            $hasil = $this->db->query("INSERT INTO satu_detail SET id_satu  = ?, input_check=?", array($_POST['id_satu'], $input_check[$i]));
        }

        return $hasil;
    }
}
