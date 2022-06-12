<?php

namespace App\Models;

use CodeIgniter\Model;

class TransGajiModel extends Model
{
    protected $table = 'gaji';

    public function getDataPetugas($id_kamar, $id_jenis_kamar)
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM petugas
        WHERE id_kamar = ? AND id_jenis_kamar = ?', array($id_kamar, $id_jenis_kamar));
        $results = $query->getResult('array');
        return $results;
    }

    public function getDataKamar()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM kamar');
        $results = $query->getResult();
        return $results;
    }

    public function getDataJenisKamar($id)
    {
        $db = db_connect();
        $query   = $db->query('SELECT kamar.id_kamar, kamar.nama_kamar, kamar.tarif, jenis_kamar.nama_jenis_kamar, jenis_kamar.id_jenis_kamar
             FROM kamar 
             JOIN jenis_kamar 
            ON kamar.id_jenis_kamar=jenis_kamar.id_jenis_kamar WHERE kamar.nama_kamar = ?', array($id));
        $results = $query->getResult();
        return $results;
    }

    public function inputGaji()
    {
        $db = db_connect();

        $d = "Debit";
        $k = "Kredit";

        $id_petugas = $_POST['id_petugas'];
        $tanggal_gaji = $_POST['tanggal_gaji'];
        $nominal_gaji = preg_replace('/[^0-9 ]/i', '', $_POST['nominal_gaji']);

        $dbResult = $db->query("SELECT IFNULL(MAX(no_transaksi),0) as no_transaksi from transaksi");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $no_transaksi = $row->no_transaksi;
        }
        $transaksi = $no_transaksi + 1; //naikkan 1 untuk id baru

        $dbResult = $db->query("SELECT IFNULL(MAX(id_gaji),0) as id_gaji from gaji");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $id_gaji = $row->id_gaji;
        }
        $gaji = $id_gaji + 1; //naikkan 1 untuk id baru

        // Mengambil Nilai Kuitansi Pemesanan
        $sql = "SELECT substring_index(IFNULL(MAX(kuitansi_gaji),0),'-',-1)+0 as kuitansi_gaji 
                FROM gaji
                WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(kuitansi_gaji, '-', -2),'-',1) = " . $id_petugas . " 
                AND SUBSTRING(SUBSTRING_INDEX(kuitansi_gaji, '-', 2),5) = DATE_FORMAT(CURRENT_DATE,'%Y%m%d')";
        $dbResult = $db->query($sql);
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row) {
            $kuitansi_gaji = $row->kuitansi_gaji;
        }

        // Membuat Format Kuitansi dan Menaikkan Satu Angka Di belakangnya
        $kuitansi = "KWI-" . date("Ymd") . "-" . $id_petugas . "-" . str_pad(($kuitansi_gaji + 1), 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO transaksi SET no_transaksi = ?, tanggal_transaksi = ?, nominal_transaksi = ?";
        $hasil = $db->query($sql, array($transaksi, $tanggal_gaji, $nominal_gaji));

        $sql = "INSERT INTO jurnal(`no_transaksi`, `kode_akun`, `tanggaL_jurnal`, `nominal_jurnal`)
        SELECT transaksi.no_transaksi as transaksi, coa.kode_akun, transaksi.tanggal_transaksi, transaksi.nominal_transaksi
        FROM transaksi CROSS JOIN coa WHERE transaksi.no_transaksi = ? AND coa.kode_akun = 11111";
        $hasil = $db->query($sql, array($transaksi));

        $sql = "INSERT INTO jurnal(`no_transaksi`, `kode_akun`, `tanggaL_jurnal`, `nominal_jurnal`)
        SELECT transaksi.no_transaksi as transaksi, coa.kode_akun, transaksi.tanggal_transaksi, transaksi.nominal_transaksi
        FROM transaksi CROSS JOIN coa WHERE transaksi.no_transaksi = ? AND coa.kode_akun = 51111";
        $hasil = $db->query($sql, array($transaksi));

        $sql = "UPDATE jurnal SET `debit_kredit` = ? WHERE kode_akun = 51111 AND debit_kredit IS NULL";
        $hasil = $db->query($sql, array($d));

        $sql = "UPDATE jurnal SET `debit_kredit` = ? WHERE kode_akun = 11111 AND debit_kredit IS NULL";
        $hasil = $db->query($sql, array($k));

        $sql = "INSERT INTO gaji SET no_transaksi = ?, id_gaji = ?, kuitansi_gaji = ?, id_petugas = ?, tanggal_gaji = ?, nominal_gaji = ?";
        $hasil = $db->query($sql, array($transaksi, $gaji, $kuitansi, $id_petugas, $tanggal_gaji, $nominal_gaji));
    }
}
