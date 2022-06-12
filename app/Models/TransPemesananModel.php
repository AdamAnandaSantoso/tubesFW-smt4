<?php

namespace App\Models;

use CodeIgniter\Model;

class TransPemesananModel extends Model
{
    protected $table = 'pemesanan';

    public function getDataPasien()
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM pasien
        WHERE id_pasien NOT IN (SELECT id_pasien FROM pemesanan WHERE status_pemesanan = 'Belum Lunas')
        ORDER BY nama_pasien ASC");
        $results = $query->getResult();
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
        $query   = $db->query('SELECT kamar.id_kamar, kamar.nama_kamar, kamar.tarif, kamar.kapasitas, kamar.terpakai, jenis_kamar.nama_jenis_kamar, jenis_kamar.id_jenis_kamar FROM kamar JOIN jenis_kamar ON kamar.id_jenis_kamar=jenis_kamar.id_jenis_kamar WHERE kamar.nama_kamar = ?', array($id));
        $results = $query->getResult();
        return $results;
    }

    public function getKamarBasedOnId($id)
    {
        $db = db_connect();
        $query   = $db->query('SELECT kamar.tarif, kamar.id_kamar, kamar.nama_kamar, jenis_kamar.id_jenis_kamar, jenis_kamar.nama_jenis_kamar FROM kamar JOIN jenis_kamar ON kamar.id_jenis_kamar=jenis_kamar.id_jenis_kamar WHERE kamar.id_kamar = ?', array($id));
        $results = $query->getResult('array');
        return $results;
    }

    public function getDataPemesanan($id_kamar, $id_jenis_kamar)
    {
        $db = db_connect();
        $query = $db->query('SELECT a.*, b.nama_kamar, c.nama_jenis_kamar, d.nama_pasien
        FROM pemesanan a
        JOIN kamar b ON a.id_kamar=b.id_kamar
        JOIN jenis_kamar c ON a.id_jenis_kamar=c.id_jenis_kamar
        JOIN pasien d ON a.id_pasien=d.id_pasien
        WHERE a.id_kamar = ? AND a.id_jenis_kamar = ?
        ORDER BY a.id_pemesanan DESC', array($id_kamar, $id_jenis_kamar));
        $results = $query->getResult('array');
        return $results;
    }

    // public function dataTrans() {
    //     $db = db_connect();

    //     $id_pasien = $_POST['id_pasien'];
    //     $dbResult = $db->query("SELECT * FROM pasien WHERE id_pasien = " . $id_pasien . " ");
    //     return $dbResult->getResult();
    // }

    public function inputPemesanan()
    {
        $db = db_connect();

        $d = "Debit";
        $k = "Kredit";
        $s = "Belum Lunas";

        $id_pasien = $_POST['id_pasien'];
        $id_kamar = $_POST['id_kamar'];
        $nama_jenis_kamar = $_POST['nama_jenis_kamar'];
        $id_jenis_kamar = $_POST['id_jenis_kamar'];
        $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
        $nominal_pemesanan = preg_replace('/[^0-9 ]/i', '', $_POST['nominal_pemesanan']);

        $dbResult = $db->query("SELECT IFNULL(MAX(no_transaksi),0) as no_transaksi from transaksi");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $no_transaksi = $row->no_transaksi;
        }
        $transaksi = $no_transaksi + 1; //naikkan 1 untuk id baru

        $dbResult = $db->query("SELECT IFNULL(MAX(id_pemesanan),0) as id_pemesanan from pemesanan");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $id_pemesanan = $row->id_pemesanan;
        }
        $pemesanan = $id_pemesanan + 1; //naikkan 1 untuk id baru

        $dbResult = $db->query("SELECT IFNULL(MAX(terpakai),0) as terpakai from kamar where id_kamar = " . $id_kamar . " ");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $jumlah_terpakai = $row->terpakai;
        }
        $terpakai = $jumlah_terpakai + 1;

        // Mengambil Nilai Kuitansi Pemesanan
        $sql = "SELECT substring_index(IFNULL(MAX(kuitansi_pemesanan),0),'-',-1)+0 as kuitansi_pemesanan FROM pemesanan
                WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(kuitansi_pemesanan, '-', -2),'-',1) = " . $id_pasien . " 
                AND SUBSTRING(SUBSTRING_INDEX(kuitansi_pemesanan, '-', 2),5) = DATE_FORMAT(CURRENT_DATE,'%Y%m%d')";
        $dbResult = $db->query($sql);
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row) {
            $kuitansi_pemesanan = $row->kuitansi_pemesanan;
        }

        // Membuat Format Kuitansi dan Menaikkan Satu Angka Di belakangnya
        $kuitansi = "KWI-" . date("Ymd") . "-" . $id_pasien . "-" . str_pad(($kuitansi_pemesanan + 1), 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO transaksi SET no_transaksi = ?, tanggal_transaksi = ?, nominal_transaksi = ?";
        $hasil = $db->query($sql, array($transaksi, $tanggal_pemesanan, $nominal_pemesanan));

        $sql = "INSERT INTO jurnal(`no_transaksi`, `kode_akun`, `tanggaL_jurnal`, `nominal_jurnal`)
        SELECT transaksi.no_transaksi as transaksi, coa.kode_akun, transaksi.tanggal_transaksi, transaksi.nominal_transaksi
        FROM transaksi CROSS JOIN coa WHERE transaksi.no_transaksi = ? AND coa.kode_akun = 11111";
        $hasil = $db->query($sql, array($transaksi));

        $sql = "INSERT INTO jurnal(`no_transaksi`, `kode_akun`, `tanggaL_jurnal`, `nominal_jurnal`)
        SELECT transaksi.no_transaksi as transaksi, coa.kode_akun, transaksi.tanggal_transaksi, transaksi.nominal_transaksi
        FROM transaksi CROSS JOIN coa WHERE transaksi.no_transaksi = ? AND coa.kode_akun = 41112";
        $hasil = $db->query($sql, array($transaksi));

        $sql = "UPDATE jurnal SET `debit_kredit` = ? WHERE kode_akun = 11111 AND debit_kredit IS NULL";
        $hasil = $db->query($sql, array($d));

        $sql = "UPDATE jurnal SET `debit_kredit` = ? WHERE kode_akun = 41112 AND debit_kredit IS NULL";
        $hasil = $db->query($sql, array($k));

        $sql = "INSERT INTO pemesanan SET no_transaksi = ?, id_pemesanan = ?, kuitansi_pemesanan = ?, id_pasien = ?, id_kamar = ?, id_jenis_kamar = ?, tanggal_pemesanan = ?, nominal_pemesanan = ?, status_pemesanan = ?";
        $hasil = $db->query($sql, array($transaksi, $pemesanan, $kuitansi, $id_pasien, $id_kamar, $id_jenis_kamar, $tanggal_pemesanan, $nominal_pemesanan, $s));

        $sql = "UPDATE kamar SET terpakai = ?
        WHERE id_kamar = ?";
        $hasil = $db->query($sql, array($terpakai, $id_kamar));
    }

    // untuk query list dari tabel kosan
    public function getDataPemesananMidTrans(){
        $db = db_connect();
        $builder = $db->table('midtrans_pemesanan');
        // Produces: SELECT * FROM tes_mitrans.kosan
        return $builder->get()->getResult();
    }

    // untuk menginputkan ke database
    public function inputPemesananMidtarns($data){
        $db = db_connect();
        $hasil = $db->table('midtrans_pemesanan')->insert($data);

        $dbResult = $db->query("SELECT MAX(id_pemesanan) as id_pemesanan from pemesanan");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $id_pemesanan = $row->id_pemesanan;
        }
        $pemesanan = $id_pemesanan ;
        //naikkan 1 untuk id baru
        
        $sql = "UPDATE midtrans_pemesanan SET `id_pemesanan` = ? WHERE id_pemesanan iS NULL";
        $hasil = $db->query($sql, array($pemesanan));
        return $hasil;
    }

    // untuk mendapatkan list kosan yang statusnya belum terupdate
    public function getStatusPemesananMidtrans(){
        $db = db_connect();
        $builder = $db->table('midtrans_pemesanan')->where('status_code', '201');
        // Produces: SELECT * FROM tes_mitrans.kosan WHERE status_code = '201'
        return $builder->get()->getResult();
    }

    // update status pembayaran
    public function updateStatusPemesananMidtrans($data, $id){
        $db = db_connect();
        $hasil = $db->table('midtrans_pemesanan')->where('order_id', $id)->update($data);
        return $hasil;
    }

    public function getAllDataPemesananMidTrans($id_kamar, $id_jenis_kamar)
    {
        $db = db_connect();
        $query = $db->query('
        SELECT pasien.id_pasien, pasien.nama_pasien, midtrans_pemesanan.order_id, midtrans_pemesanan.gross_amount, midtrans_pemesanan.payment_type, midtrans_pemesanan.transaction_time, midtrans_pemesanan.bank, midtrans_pemesanan.va_number, midtrans_pemesanan.status_code, midtrans_pemesanan.payment_time, pemesanan.status_pemesanan
        FROM midtrans_pemesanan
        join pemesanan
        ON midtrans_pemesanan.id_pemesanan=pemesanan.id_pemesanan
        JOIN pasien
        ON pemesanan.id_pasien=pasien.id_pasien
        JOIN kamar ON pemesanan.id_kamar=kamar.id_kamar
        JOIN jenis_kamar ON pemesanan.id_jenis_kamar=jenis_kamar.id_jenis_kamar
        WHERE pemesanan.id_kamar = ? AND pemesanan.id_jenis_kamar = ?
        ORDER BY pemesanan.id_pemesanan DESC'
        , array($id_kamar, $id_jenis_kamar));
        $results = $query->getResult('array');
        return $results;
    }

    
}
