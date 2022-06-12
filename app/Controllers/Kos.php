<?php

namespace App\Controllers;

use App\Models\KosanModel; //include akun model di dalam controller

class Kos extends BaseController
{
    // method tambah data
    public function add()
    {
        $kosan_model = model(KosanModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'nama_kos' => 'required|min_length[3]|max_length[50]',
                    'alamat_kos'  => 'required',
                    'telepon'  => 'required|numeric',
                ],
                [   //List Custom Pesan Error
                    'nama_kos' => [
                        'required' => 'Nama kos tidak boleh kosong',
                        'min_length' => 'Panjang nama kos tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama kos tidak boleh lebih dari 50',
                    ],
                    'alamat_kos' => [
                        'required' => 'Alamat kos tidak boleh kosong',
                    ],
                    'telepon' => [
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'numeric' => 'Nomor telepon harus angka'
                    ],
                ]
            )
        ) {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            $kosan_model->save([
                'nama' => $this->request->getPost('nama_kos'),
                'jenis_kos'  => $this->request->getPost('jenis_kos'),
                'alamat'  => $this->request->getPost('alamat_kos'),
                'telepon'  => $this->request->getPost('telepon'),
            ]);

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");

            // redirect ke daftar kosan
            return redirect()->to('kos/view');
        } else {
            echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view(
                'Kos/Add',
                [
                    'title' => 'Input Kosan',
                    'validation' => $this->validator,
                ]
            );
            echo view('Templates/FooterBootstrap');
        }
    }

    // method view daftar kosan
    public function view()
    {

        $kosan_model = model(KosanModel::class);
        $datakosan = $kosan_model->getKos();
        echo view('Templates/HeaderBootstrap');
        echo view('Templates/SidebarBootstrap');
        echo view(
            'Kos/View',
            [
                'title' => 'View Kosan',
                'datakosan' => $datakosan,
            ]
        );
        echo view('Templates/FooterBootstrap');
    }

    // method untuk menghapus kosan
    public function delete($id)
    {
        $kosan_model = model(KosanModel::class);
        $kosan_model->deleteKos($id);

        $session = session();
        $session->setFlashdata("status_dml", "Sukses Delete");

        return redirect()->to('kos/view');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id)
    {
        $kosan_model = model(KosanModel::class);
        $datakosan = $kosan_model->getKosBasedOnId($id);

        echo view('Templates/HeaderBootstrap');
        echo view('Templates/SidebarBootstrap');
        echo view(
            'Kos/Edit',
            [
                'title' => 'Ubah Kosan',
                'datakosan' => $datakosan,
            ]
        );
        echo view('Templates/FooterBootstrap');
    }

    // method untuk mengupdate data kos 
    public function update()
    {
        $kosan_model = model(KosanModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'nama_kos' => 'required|min_length[3]|max_length[50]',
                    'alamat_kos'  => 'required',
                    'telepon'  => 'required|numeric',
                ],
                [   //List Custom Pesan Error
                    'nama_kos' => [
                        'required' => 'Nama kos tidak boleh kosong',
                        'min_length' => 'Panjang nama kos tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama kos tidak boleh lebih dari 50',
                    ],
                    'alamat_kos' => [
                        'required' => 'Alamat kos tidak boleh kosong',
                    ],
                    'telepon' => [
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'numeric' => 'Nomor telepon harus angka'
                    ],
                ]
            )
        ) {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $kosan_model->updateKosan();

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('kos/view');
        } else {
            echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $datakosan = $kosan_model->getKosBasedOnId($_POST['id_kos']);
            echo view(
                'Kos/Edit',
                [
                    'title' => 'Ubah Kosan',
                    'datakosan' => $datakosan,
                    'validation' => $this->validator,
                ]
            );
            echo view('Templates/FooterBootstrap');
        }
    }
}
