<?php

namespace App\Controllers;

use App\Models\TransGajiModel;
use CodeIgniter\Commands\Utilities\Publish;

class TransGaji extends BaseController
{
    public function view()
    {
        $trans_gaji_model = model(TransGajiModel::class);
        $datakamar = $trans_gaji_model->getDataKamar();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
        echo view(
            'Gaji/view',
            [
                'title' => 'Pesan Kamar',
                'datakamar' => $datakamar,
            ]
        );
        echo view('Layout/Footer');
    }

    public function ViewKamar($id)
    {
        $satu_model = model(TransGajiModel::class);
        $datasatu = $satu_model->getDataJenisKamar($id);

        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view(
            'Gaji/ViewKamar',
            [
                'title' => 'Edit satu',
                'datasatu' => $datasatu,

            ]
        );
        echo view('Layout/Footer');
    }

    // method tambah data
    public function add($id_kamar, $nama_kamar, $nama_jenis_kamar, $id_jenis_kamar)
    {
        $trans_gaji_model = model(TransGajiModel::class);

        $validation =  \Config\Services::validation();

        // panggil function validate untuk memvalidasi inputan user yg dikirim via form input
        if (isset($_POST['id_petugas']) and isset($_POST['tanggal_gaji']) and isset($_POST['total_hari_kerja']) and isset($_POST['nominal_gaji'])) {
            // panggil validasi
            if (
                $this->request->getMethod() === 'post' &&
                $this->validate(
                    [
                        'id_petugas' => 'required',
                        'tanggal_gaji' => 'required',
                        'total_hari_kerja' => 'required',
                        'nominal_gaji' => 'required',
                    ],
                    [   // Errors
                        'id_petugas' => [
                            'required' => 'ID Petugas Tidak Boleh Kosong',
                        ],
                        'tanggal_gaji' => [
                            'required' => 'Tanggal Gaji Tidak Boleh Kosong'
                        ],
                        'total_hari_kerja' => [
                            'required' => 'Total Hari Kerja Tidak Boleh Kosong',
                        ],
                        'nominal_gaji' => [
                            'required' => 'Total Hari Kerja Tidak Boleh Kosong',
                        ],
                    ]
                )
            ) {
                // dijalankan kalau tidak ada eror
                $trans_gaji_model->inputGaji();

                $session = session();
                $session->setFlashdata("status_dml", "Sukses Input Pemesanan");

                return redirect()->to('TransGaji/view');
            } else {

                // disi kalau ada eror
                $data['id_kamar'] = $id_kamar;
                $data['nama_kamar'] = $nama_kamar;
                $data['nama_jenis_kamar'] = $nama_jenis_kamar;
                $data['id_jenis_kamar'] = $id_jenis_kamar;

                // $hasil = $trans_gaji_model->getKamarBasedOnId($id_kamar);
                // $ha = $trans_gaji_model->getDataPemesanan($id_kamar);

                // foreach ($hasil as $row) :
                //     $tarif = $row['tarif'];
                // endforeach;

                // $data['kamar'] = $hasil;
                // $data['id_kamar'] = $id_kamar; //id kosan
                // $data['nama_kamar'] = $nama_kamar;
                // $data['nama_jenis_kamar'] = $nama_jenis_kamar;
                // $data['id_jenis_kamar'] = $id_jenis_kamar;
                // $data['tarif'] = $tarif;

                $data['validation'] = $this->validator;
                // $data['datapasien'] = $trans_gaji_model->getDataPasien();
                $data['datapetugas'] = $trans_gaji_model->getDataPetugas($id_kamar, $id_jenis_kamar);
                echo view('Layout/Header');
                echo view('Layout/Sidebar');
                echo view('Layout/Body');
                echo view('Gaji/add', $data);
                echo view('Layout/Footer');
            }
            // akhir panggil validasi
        } else {
            //jangan palnggil validasi
            $data['id_kamar'] = $id_kamar;
            $data['nama_kamar'] = $nama_kamar;
            $data['nama_jenis_kamar'] = $nama_jenis_kamar;
            $data['id_jenis_kamar'] = $id_jenis_kamar;

            // $hasil = $trans_gaji_model->getKamarBasedOnId($id_kamar);
            // $ha = $trans_gaji_model->getDataPemesanan($id_kamar);

            // foreach ($hasil as $row) :
            //     $tarif = $row['tarif'];
            // endforeach;

            // $data['kamar'] = $hasil;
            // $data['id_kamar'] = $id_kamar; //id kosan
            // $data['nama_kamar'] = $nama_kamar;
            // $data['nama_jenis_kamar'] = $nama_jenis_kamar;
            // $data['id_jenis_kamar'] = $id_jenis_kamar;
            // $data['tarif'] = $tarif;

            $data['datapetugas'] = $trans_gaji_model->getDataPetugas($id_kamar, $id_jenis_kamar);
            // $data['datapasien'] = $trans_gaji_model->getDataPasien();
            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');

            echo view('Gaji/add', $data);
            echo view('Layout/Footer');
        }
    }
}
