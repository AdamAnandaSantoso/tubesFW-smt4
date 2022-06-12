<?php

namespace App\Models;

use CodeIgniter\Model;

class GrafikModel extends Model
{

    // method untuk mengecek apakah username dan password dari $_POST sudah sesuai
    public function BarChart(){
        $db = db_connect();
        
        $sql = " SELECT DATE_FORMAT(`tanggal_pemesanan`,'%M') as bulan, SUM(nominal_pemesanan) as total1, IFNULL(SUM(nominal_pembayaran),0) as total2 FROM pemesanan LEFT outer JOIN pembayaran ON pemesanan.id_pemesanan=pembayaran.id_pemesanan GROUP BY DATE_FORMAT(`tanggal_pemesanan`,'%M') ORDER BY DATE_FORMAT(`tanggal_pemesanan`,'%m')";
        $query = $db->query($sql);
        $results = $query->getResult();  

        $hasil = array(); 
        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }

    public function PieChart(){
        $db = db_connect();
        
        $sql = "SELECT kamar.nama_kamar, jenis_kamar.nama_jenis_kamar, pemesanan.id_kamar, SUM(nominal_pemesanan) as total FROM pemesanan
        LEFT OUTER JOIN kamar
        ON pemesanan.id_kamar=kamar.id_kamar
        LEFT OUTer JOIN jenis_kamar
        ON pemesanan.id_jenis_kamar =jenis_kamar.id_jenis_kamar
        GROUP BY pemesanan.id_kamar";
        $query = $db->query($sql);
        $results = $query->getResult();  

        $hasil = array(); 
        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
          // SELECT id_kamar, SUM(nominal_pemesanan) as total FROM pemesanan
    // GROUP BY id_kamar
    }

    // grafik pie
    public function LineChart(){
        $sql = "SELECT DATE_FORMAT(`tanggal_pemesanan`,'%M') AS Bulan, COUNT(pemesanan.id_pemesanan) AS Total_Pemesanan, COUNT(pembayaran.id_pembayaran) AS Total_Pembayaran FROM pemesanan LEFT OUTER JOIN pembayaran
        ON pemesanan.id_pemesanan=pembayaran.id_pembayaran
        GROUP BY DATE_FORMAT(`tanggal_pemesanan`,'%M') ORDER BY DATE_FORMAT(`tanggal_pemesanan`,'%m')";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
        $hasil = array(); 
        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }

     
}