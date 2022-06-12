<?php

namespace App\Models;

use CodeIgniter\Model;

class KuitansiPembayaranModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'pembayaran';

    //method untuk menampilkan informasi data pembayaran
    public function getInfoPembayaran()
    {
        $db = db_connect();
        $sql = "SELECT pembayaran.id_pembayaran, pasien.nama_pasien, kamar.nama_kamar, jenis_kamar.nama_jenis_kamar, pembayaran.tanggal_bayar, pemesanan.status_pemesanan, pembayaran.nominal_pembayaran,pembayaran.kuitansi_pembayaran
        FROM pembayaran 
        JOIN pemesanan
        ON pembayaran.id_pemesanan=pemesanan.id_pemesanan
        JOIN pasien
        ON pemesanan.id_pasien=pasien.id_pasien
        JOIN jenis_kamar
        ON pemesanan.id_jenis_kamar=jenis_kamar.id_jenis_kamar
        JOIN kamar
        ON pemesanan.id_kamar=kamar.id_kamar";
        $dbResult = $db->query($sql);
        return $dbResult->getResult();
    }

    //method untuk menampilkan informasi data pembayaran
    public function getInfoPembayaranById($id_pembayaran)
    {
        $db = db_connect();
        $sql = "SELECT pembayaran.id_pembayaran, pasien.nama_pasien, kamar.nama_kamar, jenis_kamar.nama_jenis_kamar, pembayaran.tanggal_bayar, pemesanan.status_pemesanan, pembayaran.nominal_pembayaran,pembayaran.kuitansi_pembayaran
        FROM pembayaran 
        JOIN pemesanan
        ON pembayaran.id_pemesanan=pemesanan.id_pemesanan
        JOIN pasien
        ON pemesanan.id_pasien=pasien.id_pasien
        JOIN jenis_kamar
        ON pemesanan.id_jenis_kamar=jenis_kamar.id_jenis_kamar
        JOIN kamar
        ON pemesanan.id_kamar=kamar.id_kamar
        WHERE pembayaran.id_pembayaran = ?";
        $dbResult = $db->query($sql, array($id_pembayaran));
        return $dbResult->getResult();
    }
}
