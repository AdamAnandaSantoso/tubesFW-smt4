<?php

namespace App\Controllers;

use App\Models\KuitansiPemesananModel;

class KuitansiPemesanan extends BaseController
{
    // method tambah data
    public function viewKuitansi()
    {
        $kuitansi_pemesanan_model = new KuitansiPemesananModel();
        $data['pemesanan'] = $kuitansi_pemesanan_model->getInfoPemesanan();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Kuitansi/KuitansiPemesanan', $data);
        echo view('Layout/Footer');
    }

    // cetak ke pdf
    public function cetakKuitansi($id_pemesanan)
    {

        $kuitansi_pemesanan_model = new KuitansiPemesananModel();
        $data['kuitansi'] = $kuitansi_pemesanan_model->getInfoPemesananById($id_pemesanan);

        $dompdf = new \Dompdf\Dompdf();
        $html = view('Kuitansi/CetakKuitansiPemesanan', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
