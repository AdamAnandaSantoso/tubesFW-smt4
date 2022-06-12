<?php

namespace App\Controllers;

use App\Models\PenghuniModel; //include akun model di dalam controller

class Helloworld extends BaseController
{
    public function halamanawal()
    {
        // echo "ini adalah halaman awal web saya<br>";
        echo 'isi dari base_url = ' . base_url();
        echo "<br>";
        echo 'isi dari site_url = ' . site_url();
    }

    public function index()
    {
        // return view('welcome_message');
        echo view('Templates/Header');
        echo "ok";
    }

    // tes helper bawaan dari CI
    public function teshelpernumber()
    {
        // meload helper number
        helper('number');
        $angka = 12345678;
        echo "Format angka dalam pemisah ribuan = " . number_to_amount($angka);
        echo "<br>";
        echo "Format angka dalam ukuran bytes = " . number_to_size($angka);
    }

    // tes helper custom
    public function teshelpersendiri()
    {
        $angka = 15000000000;
        echo "Format angka dalam pemisah ribuan = " . format_rupiah($angka);
        echo "<br>";
        echo "Format angka dalam ukuran bytes = " . format_rupiah($angka);
    }

    // tes coba dom ganti warna tombol
    //mencoba DOM
    public function cobadomgantiwarna()
    {
        echo view('Templates/HeaderBootstrap');
        echo view('Templates/SidebarBootstrap');
        echo view('gantiwarna');
    }

    public function view($page = 'Body')
    {
        if (!is_file(APPPATH . 'Views/Templates/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('Templates/Header', $data);
        echo view('Templates/' . $page, $data);
        echo view('Templates/Footer', $data);
    }

    public function tesvalidasi()
    {
        $validation =  \Config\Services::validation();
        if (!$this->validate([
            'nama' => 'required',
        ])) {
            echo view('tes2', [
                'validation' => $this->validator,
            ]);
        } else {
            echo "Success";
        }
    }
}
