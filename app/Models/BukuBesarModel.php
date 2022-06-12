<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuBesarModel extends Model
{
    public function getNamaAkun()
    {
        $db = db_connect();
        $sql = "SELECT b.kode_akun, a.nama_akun
                FROM coa a
                JOIN jurnal b on (a.kode_akun=b.kode_akun)
                GROUP BY b.kode_akun, a.nama_akun
                ORDER BY a.kode_akun, b.kode_akun ASC";
        $dbResult = $db->query($sql);
        return $dbResult->getResult('array');
    }

    public function bukubesar($tahun, $bulan, $kodecoa)
    {
        $db = db_connect();

        $sql = "SELECT jurnal.no_transaksi, jurnal.tanggal_jurnal, jurnal.debit_kredit, jurnal.nominal_jurnal, jurnal.kode_akun, coa.nama_akun
        FROM jurnal JOIN coa 
        ON jurnal.kode_akun=coa.kode_akun
        WHERE  year(jurnal.tanggal_jurnal) = ? AND DATE_FORMAT(jurnal.tanggal_jurnal,'%m') = ? AND coa.kode_akun = ?
        ORDER BY jurnal.no_transaksi, jurnal.debit_kredit ASC";
        $dbResult = $db->query($sql, array($tahun, $bulan, $kodecoa));
        return $dbResult->getResult('array');
    }

    public function getPosisiSaldoNormal($akun)
    {
        //lihat posisi saldo awal normal
        $db = db_connect();
        $sql = "SELECT debit_kredit
                FROM coa 
                WHERE kode_akun = ?";

        $dbResult = $db->query($sql, array($akun));
        $hasil = $dbResult->getResult('array');
        foreach ($hasil as $cacah) :
            $posisi_saldo_normal = $cacah['debit_kredit'];
        endforeach;
        return $posisi_saldo_normal;
    }

    public function getSaldoAwal($tahun, $bulan, $akun)
    {
        $db = db_connect();
        $posisi_saldo_normal = $this->getPosisiSaldoNormal($akun); //dapatkan posisi saldo normal
        $waktu = $tahun . "-" . $bulan;

        $sql = "SELECT tbl1.debit_kredit ,ifnull(tbl2.total,0) as nominal FROM
        (
            SELECT 'Kredit' debit_kredit
            UNION
            SELECT 'Debit' debit_kredit
        ) tbl1
        LEFT OUTER JOIN
        (
            SELECT debit_kredit,sum(nominal_jurnal) as total 
            FROM
            (
                SELECT a.*,b.nama_akun
                FROM jurnal a
                JOIN coa b ON (a.kode_akun=b.kode_akun)
                WHERE date_format(a.tanggal_jurnal,'%Y-%m') < ?
                AND a.kode_akun = ?
                ORDER BY tanggal_jurnal, debit_kredit DESC
            )
            tbl3
            GROUP BY debit_kredit    
        ) tbl2
        ON (tbl1.debit_kredit = tbl2.debit_kredit)";
        $dbResult = $db->query($sql, array($waktu, $akun));

        $hasil = $dbResult->getResult('array');

        $saldo_debit = 0;
        $saldo_kredit = 0;
        foreach ($hasil as $cacah) :
            if (strcmp($cacah['debit_kredit'], 'Debit') == 0) {
                $saldo_debit = $saldo_debit + $cacah['nominal'];
            } else {
                $saldo_kredit = $saldo_kredit + $cacah['nominal'];
            }
        endforeach;

        if (strcmp($posisi_saldo_normal, 'Debit') == 0) {
            $saldo = $saldo_debit - $saldo_kredit;
        } else {
            $saldo =  $saldo_kredit - $saldo_debit;
        }
        return $saldo;
    }

    public function getPeriodeTahun()
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT(YEAR(tanggal_jurnal)) as tahun FROM `jurnal` ORDER BY 1";
        $dbResult = $db->query($sql);
        return $dbResult->getResult('array');
    }
};
