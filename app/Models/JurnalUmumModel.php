<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalUmumModel extends Model
{
    public function jurnalumum($tahun, $bulan)
    {
        $db = db_connect();

        $sql = "SELECT jurnal.no_transaksi, jurnal.tanggal_jurnal, jurnal.debit_kredit, jurnal.nominal_jurnal, jurnal.kode_akun, coa.nama_akun
                FROM jurnal JOIN coa ON jurnal.kode_akun=coa.kode_akun
                WHERE  year(jurnal.tanggal_jurnal) = ? AND DATE_FORMAT(jurnal.tanggal_jurnal,'%m') = ?
                ORDER BY jurnal.no_transaksi, jurnal.debit_kredit ASC";
        $dbResult = $db->query($sql, array($tahun, $bulan));
        return $dbResult->getResult('array');
    }

    public function getPeriodeTahun()
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT(YEAR(tanggal_jurnal)) as tahun FROM `jurnal` ORDER BY 1";
        $dbResult = $db->query($sql);
        return $dbResult->getResult('array');
    }
};
