<?php

namespace App\Models;

use CodeIgniter\Model;

class TransPembayaranModel extends Model
{
    protected $table = 'pembayaran';

    public function getDataPemesanan($id_kamar, $id_jenis_kamar)
    {
        $db = db_connect();
        $query = $db->query('SELECT pasien.nama_pasien, pemesanan.id_pemesanan, pemesanan.tanggal_pemesanan 
        FROM pasien 
        JOIN pemesanan
        ON pasien.id_pasien=pemesanan.id_pasien
        WHERE pemesanan.status_pemesanan = "Belum Lunas" AND pemesanan.id_kamar = ? AND pemesanan.id_jenis_kamar = ?', array($id_kamar, $id_jenis_kamar));
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
        $query   = $db->query('SELECT kamar.id_kamar, kamar.nama_kamar, kamar.tarif, kamar.kapasitas, kamar.terpakai, jenis_kamar.nama_jenis_kamar, jenis_kamar.id_jenis_kamar FROM kamar JOIN jenis_kamar ON kamar.id_jenis_kamar=jenis_kamar.id_jenis_kamar WHERE kamar.nama_kamar = ?', array($id));
        $results = $query->getResult();
        return $results;
    }

    public function getKamarBasedOnId($id)
    {
        $db = db_connect();
        $query   = $db->query('SELECT kamar.tarif, kamar.id_kamar, kamar.nama_kamar, jenis_kamar.id_jenis_kamar, jenis_kamar.nama_jenis_kamar FROM kamar JOIN jenis_kamar ON kamar.id_jenis_kamar=jenis_kamar.id_jenis_kamar WHERE kamar.id_kamar = ? ', array($id));
        $results = $query->getResult('array');
        return $results;
    }

    public function inputPembayaran()
    {
        $db = db_connect();

        $d = "Debit";
        $k = "Kredit";
        $s = "Sudah Lunas";

        $id_kamar = $_POST['id_kamar'];
        $id_pemesanan = $_POST['id_pemesanan'];
        $total_rawat = $_POST['total_rawat'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $nominal_pembayaran = preg_replace('/[^0-9 ]/i', '', $_POST['nominal_pembayaran']);

        $sql = "SELECT * FROM pemesanan WHERE id_pemesanan = ?";
        $dbResult = $db->query($sql, array($id_pemesanan));
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row) {
            $id_pasien = $row->id_pasien;
        }
        $pasien = $id_pasien;

        $dbResult = $db->query("SELECT IFNULL(MAX(terpakai),0) as terpakai from kamar where id_kamar = " . $id_kamar . "  ");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $jumlah_terpakai = $row->terpakai;
        }
        $terpakai = $jumlah_terpakai - 1;

        $dbResult = $db->query("SELECT IFNULL(MAX(no_transaksi),0) as no_transaksi from transaksi");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $no_transaksi = $row->no_transaksi;
        }
        $transaksi = $no_transaksi + 1; //naikkan 1 untuk id baru

        $dbResult = $db->query("SELECT IFNULL(MAX(id_pembayaran),0) as id_pembayaran from pembayaran");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $id_pembayaran = $row->id_pembayaran;
        }
        $pembayaran = $id_pembayaran + 1; //naikkan 1 untuk id baru

        // Mengambil Nilai Kuitansi Pemesanan
        $sql = "SELECT substring_index(IFNULL(MAX(kuitansi_pembayaran),0),'-',-1)+0 as kuitansi_pembayaran 
                FROM pembayaran
                WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(kuitansi_pembayaran, '-', -2),'-',1) = " . $pasien . " 
                AND SUBSTRING(SUBSTRING_INDEX(kuitansi_pembayaran, '-', 2),5) = DATE_FORMAT(CURRENT_DATE,'%Y%m%d')";
        $dbResult = $db->query($sql);
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row) {
            $kuitansi_pembayaran = $row->kuitansi_pembayaran;
        }

        // Membuat Format Kuitansi dan Menaikkan Satu Angka Di belakangnya
        $kuitansi = "KWI-" . date("Ymd") . "-" . $pasien . "-" . str_pad(($kuitansi_pembayaran + 1), 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO transaksi SET no_transaksi = ?, tanggal_transaksi = ?, nominal_transaksi = ?";
        $hasil = $db->query($sql, array($transaksi, $tanggal_pembayaran, $nominal_pembayaran));

        $sql = "INSERT INTO jurnal(`no_transaksi`, `kode_akun`, `tanggaL_jurnal`, `nominal_jurnal`)
        SELECT transaksi.no_transaksi as transaksi, coa.kode_akun, transaksi.tanggal_transaksi, transaksi.nominal_transaksi
        FROM transaksi CROSS JOIN coa WHERE transaksi.no_transaksi = ? AND coa.kode_akun = 11111";
        $hasil = $db->query($sql, array($transaksi));

        $sql = "INSERT INTO jurnal(`no_transaksi`, `kode_akun`, `tanggaL_jurnal`, `nominal_jurnal`)
        SELECT transaksi.no_transaksi as transaksi, coa.kode_akun, transaksi.tanggal_transaksi, transaksi.nominal_transaksi
        FROM transaksi CROSS JOIN coa WHERE transaksi.no_transaksi = ? AND coa.kode_akun = 41111";
        $hasil = $db->query($sql, array($transaksi));

        $sql = "UPDATE jurnal SET `debit_kredit` = ? WHERE kode_akun = 11111 AND debit_kredit IS NULL";
        $hasil = $db->query($sql, array($d));

        $sql = "UPDATE jurnal SET `debit_kredit` = ? WHERE kode_akun = 41111 AND debit_kredit IS NULL";
        $hasil = $db->query($sql, array($k));

        $sql = "INSERT INTO pembayaran SET no_transaksi = ?, id_pembayaran = ?, id_pemesanan = ?, kuitansi_pembayaran = ?, tanggal_bayar = ?, total_rawat = ?, nominal_pembayaran = ?";
        $hasil = $db->query($sql, array($transaksi, $pembayaran, $id_pemesanan, $kuitansi, $tanggal_pembayaran, $total_rawat, $nominal_pembayaran));

        $sql = "UPDATE pemesanan SET `status_pemesanan` = ? WHERE id_pemesanan = ?";
        $hasil = $db->query($sql, array($s, $id_pemesanan));

        $sql = "UPDATE kamar SET terpakai = ?
        WHERE id_kamar = ?";
        $hasil = $db->query($sql, array($terpakai, $id_kamar));
    }

    // untuk query list dari tabel kosan
    public function getDataPembayaranMidTrans(){
        $db = db_connect();
        $builder = $db->table('midtrans_pembayaran');
        // Produces: SELECT * FROM tes_mitrans.kosan
        return $builder->get()->getResult();
    }
 
    // untuk menginputkan ke database
    public function inputPembayaranMidtarns($data){
        $db = db_connect();
        $hasil = $db->table('midtrans_pembayaran')->insert($data);

        $dbResult = $db->query("SELECT MAX(id_pembayaran) as id_pembayaran from pembayaran");
        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row) {
            $id_pembayaran = $row->id_pembayaran;
        }
        $pembayaran = $id_pembayaran ;
        //naikkan 1 untuk id baru
        
        $sql = "UPDATE midtrans_pembayaran SET `id_pembayaran` = ? WHERE id_pembayaran iS NULL";
        $hasil = $db->query($sql, array($pembayaran));
        return $hasil;
    }

    // untuk mendapatkan list kosan yang statusnya belum terupdate
    public function getStatusPembayaranMidtrans(){
        $db = db_connect();
        $builder = $db->table('midtrans_pembayaran')->where('status_code', '201');
        return $builder->get()->getResult();
    }

    // update status pembayaran
    public function updateStatusPembayaranMidtrans($data, $id){
        $db = db_connect();
        $hasil = $db->table('midtrans_pembayaran')->where('order_id', $id)->update($data);
        return $hasil;
    }

    public function getAllDataPembayaranMidTrans($id_kamar, $id_jenis_kamar) {
        $db = db_connect();
        $query = $db->query('
        SELECT pasien.id_pasien, pasien.nama_pasien, midtrans_pembayaran.order_id, midtrans_pembayaran.gross_amount, midtrans_pembayaran.payment_type, midtrans_pembayaran.transaction_time, midtrans_pembayaran.bank, midtrans_pembayaran.va_number, midtrans_pembayaran.status_code, midtrans_pembayaran.payment_time
        FROM midtrans_pembayaran
        join pembayaran
        ON midtrans_pembayaran.id_pembayaran=pembayaran.id_pembayaran
        JOIN pemesanan
        ON pembayaran.id_pemesanan=pemesanan.id_pemesanan
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

    // public function updateIdPembayaranMidTrans() {
    //     $db = db_connect();
    //     $dbResult = $db->query("SELECT IFNULL(MAX(id_pembayaran),0) as id_pembayaran from pembayaran");
    //     $hasil = $dbResult->getResult();
    //     //cacah hasilnya
    //     foreach ($hasil as $row) {
    //         $id_pembayaran = $row->id_pembayaran;
    //     }
    //     $pembayaran = $id_pembayaran + 1; 
    //     //naikkan 1 untuk id baru

        
    //     $sql = "UPDATE midtrans_pembayaran SET `id_pembayaran` = ? WHERE id_pembayaran iS NULL";
    //     $hasil = $db->query($sql, array($pembayaran));

    //     $sql = "UPDATE mid_trans_pembayaran SET id_pembayaran = ?
    //     WHERE id_kamar IS NULL;
    //     $hasil = $db->query($sql, array($pembayaran));
    // }

}
