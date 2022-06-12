<?php

namespace App\Controllers;

use App\Models\KuitansiPembayaranModel;

class KuitansiPembayaran extends BaseController
{
    // method tambah data
    public function viewKuitansi()
    {
        $kuitansi_pembayaran_model = new KuitansiPembayaranModel();
        $data['pembayaran'] = $kuitansi_pembayaran_model->getInfoPembayaran();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Kuitansi/KuitansiPembayaran', $data);
        echo view('Layout/Footer');
    }

    // cetak ke pdf
    public function cetakKuitansi($id_pembayaran)
    {

        $kuitansi_pembayaran_model = new KuitansiPembayaranModel();
        $data['kuitansi'] = $kuitansi_pembayaran_model->getInfoPembayaranById($id_pembayaran);

        $dompdf = new \Dompdf\Dompdf();
        $html = view('Kuitansi/CetakKuitansiPembayaran', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
