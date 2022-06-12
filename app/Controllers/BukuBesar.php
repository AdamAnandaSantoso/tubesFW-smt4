<?php

namespace App\Controllers;

use App\Models\BukuBesarModel;

class BukuBesar extends BaseController
{
    public function bukubesar()
    {
        $buku_besar_model = new BukuBesarModel();

        $data['tahun'] = $buku_besar_model->getPeriodeTahun();
        $data['akun'] = $buku_besar_model->getNamaAkun();

        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view('Laporan/BukuBesar', $data);
        echo view('Layout/Footer');
    }

    // view buku besar
    public function ambildatabukubesar($tahun, $bulan, $idakun, $namakun)
    {
        if ($this->request->isAJAX()) {
            $buku_besar_model = new BukuBesarModel();

            $data = [
                'namaakun' =>  $namakun,
                'idakun' => $idakun,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'bukubesar' => $buku_besar_model->bukubesar($tahun, $bulan, $idakun),
                'saldoawal' => $buku_besar_model->getSaldoAwal($tahun, $bulan, $idakun),
                'posisisaldonormal' => $buku_besar_model->getPosisiSaldoNormal($idakun),
            ];

            $msg = [
                'data' => view('Laporan/ViewBukuBesar', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
