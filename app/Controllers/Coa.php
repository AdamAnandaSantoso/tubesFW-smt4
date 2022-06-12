<?php

namespace App\Controllers;

use App\Models\CoaModel; //include akun model di dalam controller

class Coa extends BaseController
{
    // method tambah data
    public function add()
    {
        $coa_model = model(CoaModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'kode_akun' => 'required|numeric|max_length[5]',
                    'nama_akun'  => 'required|min_length[3]|max_length[30]',
                    'header_akun'  => 'required|numeric|max_length[3]',
                ],
                [   //List Custom Pesan Error
                    'kode_akun' => [
                        'required' => 'Kode Akun Tidak Boleh Kosong',
                        'numeric' => 'Kode Akun Harus Angka',
                        'max_length' => 'Panjang Maksimal Kode Akun Adalah 5',
                    ],
                    'nama_akun' => [
                        'required' => 'Nama Akun Tidak Boleh Kosong',
                        'min_length' => 'Panjang Minimal Nama Akun Adalah 3',
                        'max_length' => 'Panjang Maksimal Nama Akun Adalah 30',
                    ],
                    'header_akun' => [
                        'required' => 'Header Akun Tidak Boleh Kosong',
                        'numeric' => 'Header Akun Harus Angka',
                        'max_length' => 'Panjang Maksimal Header Akun Adalah 3',
                    ],
                ]
            )
        ) {

            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            $coa_model->save([
                'kode_akun' => $this->request->getPost('kode_akun'),
                'nama_akun'  => $this->request->getPost('nama_akun'),
                'header_akun'  => $this->request->getPost('header_akun'),
            ]);

            $session = session();
            $session->setFlashdata("status_dml", "Input Berhasil");

            // redirect ke daftar kosan
            return redirect()->to('Coa/view');
        } else {
            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view(
                'Coa/add',
                [
                    'title' => 'Input COA',
                    'validation' => $this->validator,
                ]
            );
            echo view('Layout/Footer');
        }
    }

    // method view daftar kosan
    public function view()
    {

        $coa_model = model(CoaModel::class);
        $datacoa = $coa_model->getCoa();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
        echo view(
            'Coa/View',
            [
                'title' => 'View COA',
                'datacoa' => $datacoa,
            ]
        );
        echo view('Layout/Footer');
    }

    // method untuk menghapus kosan
    public function delete($id)
    {
        $coa_model = model(CoaModel::class);
        $coa_model->deleteCoa($id);

        $session = session();
        $session->setFlashdata("status_dml", "Delete Berhasil");

        return redirect()->to('Coa/View');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id)
    {
        $satu_model = model(CoaModel::class);
        $datasatu = $satu_model->getCoaBasedOnId($id);
        // $datasatu = $satu_model->getDataDetailById($id);
        // $datasatu['satu_model'] = $satu_model->getDataById($id);
        // $datasatu['satu_model_detail'] = $satu_model->getDataDetailById($id);

        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view(
            'Coa/Edit',
            [
                'title' => 'Edit Coa',
                'datacoa' => $datasatu,

            ]
        );
        echo view('Layout/Footer');

        // $coa_model = model(CoaModel::class);
        // $datacoa = $coa_model->getCoaBasedOnId($id);

        // echo view('Layout/Header');
        // echo view('Layout/Sidebar');
        // echo view('Layout/Body');
        // echo view(
        //     'Coa/Edit',
        //     [
        //         'title' => 'Ubah Coa',
        //         'datacoa' => $datacoa,
        //     ]
        // );
        // echo view('Layout/Footer');
    }

    // method untuk mengupdate data kos 
    public function update()
    {
        $coa_model = model(CoaModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'kode_akun' => 'required|numeric|max_length[5]',
                    'nama_akun'  => 'required|min_length[3]|max_length[30]',
                    'header_akun'  => 'required|numeric|max_length[5]',
                ],
                [   //List Custom Pesan Error
                    'kode_akun' => [
                        'required' => 'Kode Akun Tidak Boleh Kosong',
                        'numeric' => 'Kode Akun Harus Angka',
                        'max_length' => 'Panjang Maksimal Kode Akun Adalah 5',
                    ],
                    'nama_akun' => [
                        'required' => 'Nama Akun Tidak Boleh Kosong',
                        'min_length' => 'Panjang Minimal Nama Akun Adalah 3',
                        'max_length' => 'Panjang Maksimal Nama Akun Adalah 30',
                    ],
                    'header_akun' => [
                        'required' => 'Header Akun Tidak Boleh Kosong',
                        'numeric' => 'Header Akun Harus Angka',
                        'max_length' => 'Panjang Maksimal Header Akun Adalah 3',
                    ],
                ]
            )
        ) {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $coa_model->updateCoa();

            $session = session();
            $session->setFlashdata("status_dml", "Update Berhasil");
            // redirect ke daftar kosan
            return redirect()->to('Coa/view');
        } else {
            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $datacoa = $coa_model->getCoaBasedOnId($_POST['kode_akun']);
            echo view(
                'Coa/edit',
                [
                    'title' => 'Ubah COA',
                    'datacoa' => $datacoa,
                    'validation' => $this->validator,
                ]
            );
            echo view('Layout/Footer');
        }
    }
}
