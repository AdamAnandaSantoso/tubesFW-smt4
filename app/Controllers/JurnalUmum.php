<?php

namespace App\Controllers;

use App\Models\JurnalUmumModel;

class JurnalUmum extends BaseController
{
    public function jurnalumum()
    {
        $coa_model = new JurnalUmumModel();
        $data['tahun'] = $coa_model->getPeriodeTahun();

        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Laporan/JurnalUmum', $data);
        echo view('Layout/Footer');
    }

    public function ambildatajurnalumum($tahun, $bulan)
    {
        if ($this->request->isAJAX()) {
            $jurnal_umum_model = new JurnalUmumModel();
            $data = [
                'datajurnal' => $jurnal_umum_model->jurnalumum($tahun, $bulan),
            ];

            $msg = [
                'data' => view('Laporan/ViewJurnalUmum', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
