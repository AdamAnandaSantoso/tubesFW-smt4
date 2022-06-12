<?php

namespace App\Controllers;

class Dashboard extends BaseController {
    public function Dashboard() {
        
if(isset($_POST["submit"])) {
    $kota = $_POST['kota'];
    $json = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.$kota.'&units=imperial&appid=3f82914a6c24b70b7f91331eeb7fbc0d');
} else {
    $json = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=bandung&units=imperial&appid=3f82914a6c24b70b7f91331eeb7fbc0d'); 
}

        // $json = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=bandung&units=imperial&appid=3f82914a6c24b70b7f91331eeb7fbc0d'); 

        echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');
            echo view(
                'Dashboard/Dashboard',
                [
                    'title' => 'ApiWeather', 
                    'apiweather' => json_decode($json),
                ]
            );
            echo view('Layout/Footer');
    }

    // public function getWeather(){
    //     $json = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=bandung&units=imperial&appid=3f82914a6c24b70b7f91331eeb7fbc0d'); 

    //     echo view('Layout/Header');
    //         echo view('Layout/Sidebar');
    //         echo view('Layout/Body');
    //         echo view(
    //             'Dashboard/Dashboard', 
    //             [
    //                 'title' => 'ApiWeather', 
    //                 'apiweather' => json_decode($json),
    //             ]
    //         );
    //         echo view('Layout/Footer');
		
        // echo view('Berita',
        //             [
        //                 'title' => 'Dashboard/ApiWeather',
        //                 'berita' => json_decode($json),
        //             ]
        // ); 
}
