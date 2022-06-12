<?php

namespace App\Controllers;

use App\Models\AkunModel; //include akun model di dalam controller
use App\Models\KosanModel; //include akun model di dalam controller

class Home extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        // return view('tes');

        $session = session();
        $session->destroy();
        //return redirect()->to('/login');

        return view('login'); // memanggil view di app/views/login.php
    }

    public function ceklogin()
    {
        // echo $_POST['username']."<br>";
        // echo $_POST['password']."<br>";
        // echo $_GET['username']."-".$_GET['password'];


        // load model akun model
        $akunmodel = model(AkunModel::class);
        $hasil = $akunmodel->cekUsernamePassword();
        foreach ($hasil as $row) {
            $jml = $row->jml; //atribut hasil query diberi alias jml
        }
        if ($jml == 0) {
            // artinya tidak ada pasangan username dan password yang cocok, kembalikan ke halaman login
            $data['pesan'] = "Pasangan username dan password tidak tepat";
            echo view('login', $data);
        } else {
            // artinya ada pasangan username dan password yang cocok, teruskan ke halaman welcome_message
            // return view('welcome_message');

            /* echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            echo view('Templates/BodyBootstrap');
            echo view('Templates/FooterBootstrap'); */

            // aktifkan session dan simpan username ke dalam session serta buat variabel logged_in
            $session = session();

            //dapatkan waktu last login
			$hasil = $akunmodel->getlastlogin($_POST['username']);
			//kembalikan hasil last_login yang tercatat di database
			foreach ($hasil as $row)
			{
				$lastlogin = $row->last_login;
			}

            // dapatkan kelompok user
			$hasil = $akunmodel->getGroupUser();
			foreach ($hasil as $row)
			{
				$kelompok = $row->user_group;
			}

            $ses_data = [
                'user_name'     => $_POST['username'],
                'logged_in'     => TRUE,
                'lastlogin' => $lastlogin,
                'kelompok' => $kelompok,
            ];
            $session->set($ses_data);

            // load data kos dan kirim ke view
            $kosan_model = model(KosanModel::class);
            $datakosan = $kosan_model->getKos();
            echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            echo view(
                'Kos/View',
                [
                    'title' => 'View Kosan',
                    'datakosan' => $datakosan,
                ]
            );
            echo view('Templates/FooterBootstrap');
        }
    }
}
