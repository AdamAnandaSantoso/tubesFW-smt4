<?php

namespace App\Controllers;

use App\Models\KuitansiPenggajianModel;

class KuitansiPenggajian extends BaseController
{
    // method tambah data
    public function viewKuitansi()
    {
        $kuitansi_gaji_model = new KuitansiPenggajianModel();
        $data['penggajian'] = $kuitansi_gaji_model->getInfoPenggajian();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Kuitansi/KuitansiPenggajian', $data);
        echo view('Layout/Footer');
    }

    // cetak ke pdf
    public function cetakKuitansi($id_gaji)
    {

        $kuitansi_gaji_model = new KuitansiPenggajianModel();
        $data['kuitansi'] = $kuitansi_gaji_model->getInfoPenggajianById($id_gaji);

        $dompdf = new \Dompdf\Dompdf();
        $html = view('Kuitansi/CetakKuitansiPenggajian', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'Landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
