<?php

namespace App\Models;

use CodeIgniter\Model;

class KuitansiPenggajianModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'gaji';

    //method untuk menampilkan informasi data pembayaran
    public function getInfoPenggajian()
    {
        $db = db_connect();
        $sql = "SELECT gaji.id_gaji, petugas.nama_petugas, kamar.nama_kamar, jenis_kamar.nama_jenis_kamar, gaji.tanggal_gaji, gaji.nominal_gaji, gaji.kuitansi_gaji
        FROM gaji
        JOIN petugas
        ON gaji.id_petugas=petugas.id_petugas
        JOIN kamar
        ON petugas.id_kamar=kamar.id_kamar
        JOIN jenis_kamar 
        ON petugas.id_jenis_kamar=jenis_kamar.id_jenis_kamar
        ";
        $dbResult = $db->query($sql);
        return $dbResult->getResult();
    }

    //method untuk menampilkan informasi data pembayaran
    public function getInfoPenggajianById($id_gaji)
    {
        $db = db_connect();
        $sql = "SELECT gaji.id_gaji, petugas.nama_petugas, kamar.nama_kamar, jenis_kamar.nama_jenis_kamar, gaji.tanggal_gaji, gaji.nominal_gaji, gaji.kuitansi_gaji
        FROM gaji
        JOIN petugas
        ON gaji.id_petugas=petugas.id_petugas
        JOIN kamar
        ON petugas.id_kamar=kamar.id_kamar
        JOIN jenis_kamar 
        ON petugas.id_jenis_kamar=jenis_kamar.id_jenis_kamar
        WHERE gaji.id_gaji = ?";
        $dbResult = $db->query($sql, array($id_gaji));
        return $dbResult->getResult();
    }
}
