<?php

namespace App\Models;

use CodeIgniter\Model;

class KuitansiPemesananModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'pemesanan';

    //method untuk menampilkan informasi data pembayaran
    public function getInfoPemesanan()
    {
        $db = db_connect();
        $sql = "SELECT a.*, b.nama_kamar, c.nama_jenis_kamar, d.nama_pasien
        FROM pemesanan a 
        JOIN kamar b
        ON a.id_kamar=b.id_kamar
        JOIN jenis_kamar c
        ON a.id_jenis_kamar=c.id_jenis_kamar
        JOIN pasien d
        ON a.id_pasien=d.id_pasien";
        $dbResult = $db->query($sql);
        return $dbResult->getResult();
    }

    //method untuk menampilkan informasi data pembayaran
    public function getInfoPemesananById($id_pemesanan)
    {
        $db = db_connect();
        $sql = "SELECT a.*, b.nama_kamar, c.nama_jenis_kamar, d.nama_pasien, d.alamat_pasien, d.no_telp_pasien
        FROM pemesanan a 
        JOIN kamar b
        ON a.id_kamar=b.id_kamar
        JOIN jenis_kamar c
        ON a.id_jenis_kamar=c.id_jenis_kamar
        JOIN pasien d
        ON a.id_pasien=d.id_pasien
        WHERE a.id_pemesanan = ?";
        $dbResult = $db->query($sql, array($id_pemesanan));
        return $dbResult->getResult();
    }
}
