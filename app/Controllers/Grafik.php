<?php

namespace App\Controllers;
use App\Models\GrafikModel; //include akun model di dalam controller

class Grafik extends BaseController
{
    // contoh grafik batang
    public function BarChart()
    {
        $grafik_model = model(GrafikModel::class);
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Grafik/BarChart',[
            'title' => 'Bar Chart',
            'hasil' => $grafik_model->BarChart()
            ]
        );   
        echo view('Layout/Footer');
    }

    // contoh grafik pie
    public function PieChart(){
        $grafik_model = model(GrafikModel::class);
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Grafik/PieChart',[
            'title' => 'Pie Chart',
            'hasil' => $grafik_model->PieChart()
            ]
        );   
        echo view('Layout/Footer');
        
	}

    // contoh grafik line
    public function LineChart(){
        $grafik_model = model(GrafikModel::class);
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Grafik/LineChart',[
            'title' => 'Line Chart',
            'hasil' => $grafik_model->LineChart()
            ]
        ); 
        echo view('Layout/Footer'); 
	}

}