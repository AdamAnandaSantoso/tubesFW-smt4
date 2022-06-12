<?php

namespace App\Controllers;

use App\Models\PenghuniModel; //include akun model di dalam controller

class Penghuni extends BaseController
{
    // method tambah data
    public function add()
    {
        $penghuni_model = model(PenghuniModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'ktp' => 'required|numeric|exact_length[16]',
                    'nama'  => 'required|min_length[3]|max_length[50]',
                    'email'  => 'required|valid_email',
                    'telepon'  => 'required|numeric',
                ],
                [   //List Custom Pesan Error
                    'ktp' => [
                        'required' => 'Nomor ktp tidak boleh kosong',
                        'numeric' => 'Nomor ktp harus angka',
                        'exact_length' => 'Panjang nomor KTP harus 16 digit',
                    ],
                    'nama' => [
                        'required' => 'Nama tidak boleh kosong',
                        'min_length' => 'Panjang nama tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama tidak boleh lebih dari 50',
                    ],
                    'email' => [
                        'required' => 'Email tidak boleh kosong',
                        'valid_email' => 'Email harus valid cth: hendro@gmail.com',
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
            $penghuni_model->save([
                'ktp' => $this->request->getPost('ktp'),
                'nama'  => $this->request->getPost('nama'),
                'email'  => $this->request->getPost('email'),
                'telepon'  => $this->request->getPost('telepon'),
            ]);

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");

            // redirect ke daftar kosan
            return redirect()->to('penghuni/view');
        } else {
            echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view(
                'Penghuni/Add',
                [
                    'title' => 'Input Penghuni',
                    'validation' => $this->validator,
                ]
            );
            echo view('Templates/FooterBootstrap');
        }
    }

    // method view daftar kosan
    public function view()
    {

        $penghuni_model = model(PenghuniModel::class);
        $datapenghuni = $penghuni_model->getPenghuni();
        echo view('Templates/HeaderBootstrap');
        echo view('Templates/SidebarBootstrap');
        echo view(
            'Penghuni/View',
            [
                'title' => 'View Penghuni',
                'datapenghuni' => $datapenghuni,
            ]
        );
        echo view('Templates/FooterBootstrap');
    }

    // method untuk menghapus kosan
    public function delete($id)
    {
        $penghuni_model = model(PenghuniModel::class);
        $penghuni_model->deletePenghuni($id);

        $session = session();
        $session->setFlashdata("status_dml", "Sukses Delete");

        return redirect()->to('penghuni/view');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id)
    {
        $penghuni_model = model(PenghuniModel::class);
        $datapenghuni = $penghuni_model->getPenghuniBasedOnId($id);

        echo view('Templates/HeaderBootstrap');
        echo view('Templates/SidebarBootstrap');
        echo view(
            'Penghuni/Edit',
            [
                'title' => 'Ubah Penghuni',
                'datapenghuni' => $datapenghuni,
            ]
        );
        echo view('Templates/FooterBootstrap');
    }

    // method untuk mengupdate data kos 
    public function update()
    {
        $penghuni_model = model(PenghuniModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'ktp' => 'required|numeric|exact_length[16]',
                    'nama'  => 'required|min_length[3]|max_length[50]',
                    'email'  => 'required|valid_email',
                    'telepon'  => 'required|numeric',
                ],
                [   //List Custom Pesan Error
                    'ktp' => [
                        'required' => 'Nomor ktp tidak boleh kosong',
                        'numeric' => 'Nomor ktp harus angka',
                        'exact_length' => 'Panjang nomor KTP harus 16 digit',
                    ],
                    'nama' => [
                        'required' => 'Nama tidak boleh kosong',
                        'min_length' => 'Panjang nama tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama tidak boleh lebih dari 50',
                    ],
                    'email' => [
                        'required' => 'Email tidak boleh kosong',
                        'valid_email' => 'Email harus valid cth: hendro@gmail.com',
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
            $penghuni_model->updatePenghuni();

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('penghuni/view');
        } else {
            echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $datapenghuni = $penghuni_model->getPenghuniBasedOnId($_POST['id']);
            echo view(
                'Penghuni/Edit',
                [
                    'title' => 'Ubah Penghuni',
                    'datapenghuni' => $datapenghuni,
                    'validation' => $this->validator,
                ]
            );
            echo view('Templates/FooterBootstrap');
        }
    }
}
