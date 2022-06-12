<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'akun';

    // method untuk mengecek apakah username dan password dari $_POST sudah sesuai
    public function cekUsernamePassword(){
        $nama = $_POST['username'];
        $pwd = $_POST['password'];
        // query dengan bind parameter username dan pwd untuk mencegah sql injection
        $db = db_connect();
        $query   = $db->query('SELECT COUNT(*) as jml FROM akun WHERE username = ? AND pwd = ?', array($nama,md5($pwd)));
        $results = $query->getResult();
        return $results;
    }

    // untuk mendapatkan kelompok user
    public function getGroupUser(){
        $nama = $_POST['username'];
        $db = db_connect();
        $dbResult = $db->query("SELECT user_group FROM akun WHERE username = ?", array($nama));
        return $dbResult->getResult();
    }

    //untuk mendapatkan last login
    public function getlastlogin($nama){
        $db = db_connect();
        $dbResult = $db->query("SELECT last_login FROM akun WHERE username = ? ", array($nama));
        return $dbResult->getResult();
        
    }

    //untuk update last login ketika berhasil login
    public function updatelastlogin(){
        $db = db_connect();
        $nama = $_POST['username'];
        $hasil = $db->query("UPDATE akun SET last_login = now() WHERE username = ?", array($nama));
        return $hasil;
    }
}