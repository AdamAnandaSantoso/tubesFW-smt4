<?php

namespace App\Controllers;

use App\Models\LoginModel; //include akun model di dalam controller
use App\Models\CoaModel; //include akun model di dalam controller

class Login extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        // return view('tes');

        $session = session();
        $session->destroy();
        //return redirect()->to('/login');

        echo view('login'); // memanggil view di app/views/login.php
    }

    public function ceklogin()
    {
        // echo $_POST['username']."<br>";
        // echo $_POST['password']."<br>";
        // echo $_GET['username']."-".$_GET['password'];

        $json = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=bandung&units=imperial&appid=3f82914a6c24b70b7f91331eeb7fbc0d'); 

        // load model akun model
        $loginmodel = model(LoginModel::class);
        $hasil = $loginmodel->cekUsernamePassword();
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
			$hasil = $loginmodel->getlastlogin($_POST['username']);
			//kembalikan hasil last_login yang tercatat di database
			foreach ($hasil as $row)
			{
				$lastlogin = $row->last_login;
			}
				
             // dapatkan kelompok user
			$hasil = $loginmodel->getGroupUser();
			foreach ($hasil as $row)
			{
				$kelompok = $row->user_group;
			}

			$hasil = $loginmodel->getUser();
			foreach ($hasil as $row)
			{
				$user = $row->username;
			}

            $ses_data = [
                'user_name'     => $_POST['username'],
                'logged_in'     => TRUE,
                'lastlogin' => $lastlogin,
                'kelompok' => $kelompok,
                'user' => $user,
            ];
            $session->set($ses_data);

            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');
            echo view(
                'Dashboard/Dashboard', [
                'title' => 'ApiWeather', 
                    'apiweather' => json_decode($json),
                ]
            );
            echo view('Layout/Footer');
        }
    }
}
