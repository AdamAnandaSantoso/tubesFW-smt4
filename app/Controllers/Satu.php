<?php

namespace App\Controllers;

use App\Models\SatuModel; //include akun model di dalam controller

class Satu extends BaseController
{
    // method tambah data
    public function add()
    {
        $satu_model = model(SatuModel::class);
        $validation =  \Config\Services::validation();
        if (
            $this->request->getMethod() === 'post' &&
            $this->validate(
                [
                    'input_text' => 'required',
                    'input_radio'  => 'required',
                    'input_combo'  => 'required',
                    'input_tanggal' => 'required',
                    'input_check'  => 'required',
                    'input_uang'  => 'required',
                    'input_foto' => [
                        'uploaded[input_foto]',
                        'mime_in[input_foto,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[input_foto,5120]', //maksimal 5 M
                    ],
                    'input_dokumen' => [
                        'uploaded[input_dokumen]',
                        'mime_in[input_dokumen,application/pdf]', //dibatasi haya pdf
                        'max_size[input_dokumen,10240]', //maksimal 10 M
                    ]
                ],
                [   //List Custom Pesan Error
                    'input_text' => [
                        'required' => 'Input Text Tidak Boleh Kosong',
                    ],
                    'input_radio' => [
                        'required' => 'Input Radio Tidak Boleh Kosong',
                    ],
                    'input_combo' => [
                        'required' => 'Input Combo Tidak Boleh Kosong',
                    ],
                    'input_tanggal' => [
                        'required' => 'Input Tanggal Tidak Boleh Kosong',
                    ],
                    'input_check' => [
                        'required' => 'Input Cek Tidak Boleh Kosong',
                    ],
                    'input_uang' => [
                        'required' => 'Input Uang Tidak Boleh Kosong',
                    ],
                    'input_foto' => [
                        'uploaded' => 'Input Foto Tidak Boleh Kosong',
                        'mime_in' => 'Jenis file yang dapat diterima adalah jpg atau png',
                        'max_size' => 'Ukuran file yang dapat diterima adalah 5M',
                    ],
                    'input_dokumen' => [
                        'uploaded' => 'Input Dokumen Tidak Boleh Kosong',
                        'mime_in' => 'Jenis file yang dapat diterima adalah pdf',
                        'max_size' => 'Ukuran file yang dapat diterima adalah 10M',
                    ],
                ]
            )
        ) {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            //proses upload file ke server dulu
            //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
            $fileName = uniqid();

            //mendapatkan nama file asli untuk gambar
            $namafileasli = $_FILES['input_foto']['name'];
            $pos = explode(".", $namafileasli); //mencacah nama file menjadi array dengan pemisah .
            $ekstensi_file_gbr_asli = $pos[count($pos) - 1]; //mendapatkan hasil array yang paling akhir
            $gbr = $fileName . '.' . $ekstensi_file_gbr_asli; //mendapatkan nama file lengkap dengan ekstensi aslinya

            //mendapatkan nama file asli untuk dokumen
            $namafileasli = $_FILES['input_dokumen']['name'];
            $pos = explode(".", $namafileasli); //mencacah nama file menjadi array dengan pemisah .
            $ekstensi_file_dokumen_asli = $pos[count($pos) - 1]; //mendapatkan hasil array yang paling akhir
            $dok = $fileName . '.' . $ekstensi_file_dokumen_asli; //mendapatkan nama file lengkap dengan ekstensi aslinya

            //mengupload ke server ke lokasi public/images/upload
            $avatar = $this->request->getFile('input_foto');
            $avatar->move(ROOTPATH . 'public/images/upload', $gbr); //namafile u12adsasds + . + jpg

            //mengupload ke server ke lokasi public/dokumen/upload
            $avatar = $this->request->getFile('input_dokumen');
            $avatar->move(ROOTPATH . 'public/dokumen/upload', $dok); //namafile u12adsasds + . + pdf

            //blok ini adalah blok jika sukses, yaitu panggil method insertData()
            $hasil = $satu_model->insertData($dok, $gbr);

            $session = session();
            $session->setFlashdata("status_dml", "Input Berhasil");

            // redirect ke daftar kosan
            return redirect()->to('Satu/view');
        } else {
            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view(
                'Satu/add',
                [
                    'title' => 'Input Satu',
                    'validation' => $this->validator,
                ]
            );
            echo view('Layout/Footer');
        }
    }

    // method view daftar kosan
    public function view()
    {


        //     public function hasilinputform()
        // {
        //     $forminput_model = model(ForminputModel::class);
        //     $data['form_input'] = $forminput_model->getData();
        //     echo view('Templates/HeaderBootstrap');
        //     echo view('Templates/SidebarBootstrap');
        //     echo view('ViewHasilFormInput', $data);
        //     echo view('Templates/FooterBootstrap');
        // }

        $satu_model = model(SatuModel::class);
        $datasatu = $satu_model->getData();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
        echo view(
            'Satu/View',
            [
                'title' => 'View Satu',
                'datasatu' => $datasatu,
            ]
        );
        echo view('Layout/Footer');
    }

    // method untuk menghapus kosan
    public function delete($id)
    {

        $satu_model = model(SatuModel::class);
        $satu_model->deleteData($id);

        // return redirect()->to(base_url('helloworld/hasilinputform'));

        // $satu_model = model(SatuModel::class);
        // $satu_model->deleteSatu($id);

        $session = session();
        $session->setFlashdata("status_dml", "Delete Berhasil");

        return redirect()->to('satu/View');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id)
    {

        // $forminput_model = model(ForminputModel::class);
        // $data['form_input'] = $forminput_model->getDataById($id);
        // $data['form_input_detail'] = $forminput_model->getDataDetailById($id);

        // echo view('Templates/HeaderBootstrap');
        // echo view('Templates/SidebarBootstrap');
        // echo view('ViewFormEdit', $data);
        // echo view('Templates/FooterBootstrap');


        $satu_model = model(SatuModel::class);
        $datasatu = $satu_model->getDataById($id);
        $datasatudetail = $satu_model->getDataDetailById($id);
        // $datasatu = $satu_model->getDataDetailById($id);
        // $datasatu['satu_model'] = $satu_model->getDataById($id);
        // $datasatu['satu_model_detail'] = $satu_model->getDataDetailById($id);

        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view(
            'Satu/Edit',
            [
                'title' => 'Edit satu',
                'datasatu' => $datasatu,
                'datasatudetail' => $datasatudetail,
            ]
        );
        echo view('Layout/Footer');
    }

    // method untuk mengupdate data kos 
    public function update()
    {
        $foto_lama = $_POST['foto_lama']; //menyimpan nilai lama gambar
        $dokumen_lama = $_POST['dokumen_lama']; //menyimpan nilai lama dokumen

        $satu_model = model(SatuModel::class);
        $datasatu = $satu_model->getDataById($_POST['id_satu']);
        $datasatudetail = $satu_model->getDataDetailById($_POST['id_satu']);

        $validation =  \Config\Services::validation();

        //jika input gambar diisi oleh user
        if (!empty($_FILES["input_foto"]["name"]) and empty($_FILES["input_dokumen"]["name"])) {
            $input = $this->validate(
                [
                    'input_text' => 'required',
                    'input_radio'  => 'required',
                    'input_combo'  => 'required',
                    'input_tanggal' => 'required',
                    'input_check'  => 'required',
                    'input_uang'  => 'required',
                    'input_foto' => [
                        'uploaded[input_foto]',
                        'mime_in[input_foto,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[input_foto,5120]', //maksimal 5 M
                    ],

                ],
                [   //List Custom Pesan Error
                    'input_text' => [
                        'required' => 'Input Text Tidak Boleh Kosong',
                    ],
                    'input_radio' => [
                        'required' => 'Input Radio Tidak Boleh Kosong',
                    ],
                    'input_combo' => [
                        'required' => 'Input Combo Tidak Boleh Kosong',
                    ],
                    'input_tanggal' => [
                        'required' => 'Input Tanggal Tidak Boleh Kosong',
                    ],
                    'input_check' => [
                        'required' => 'Input Cek Tidak Boleh Kosong',
                    ],
                    'input_uang' => [
                        'required' => 'Input Uang Tidak Boleh Kosong',
                    ],
                    'input_foto' => [
                        'uploaded' => 'Input Foto Tidak Boleh Kosong',
                        'mime_in' => 'Jenis file yang dapat diterima adalah jpg atau png',
                        'max_size' => 'Ukuran file yang dapat diterima adalah 5M',
                    ],

                ]
            );
        }
        //jika input dokumen diisi oleh user
        if (!empty($_FILES["input_dokumen"]["name"]) and empty($_FILES["input_foto"]["name"])) {
            $input = $this->validate(
                [
                    'input_text' => 'required',
                    'input_radio'  => 'required',
                    'input_combo'  => 'required',
                    'input_tanggal' => 'required',
                    'input_check'  => 'required',
                    'input_uang'  => 'required',

                    'input_dokumen' => [
                        'uploaded[input_dokumen]',
                        'mime_in[input_dokumen,application/pdf]', //dibatasi haya pdf
                        'max_size[input_dokumen,10240]', //maksimal 10 M
                    ]
                ],
                [   //List Custom Pesan Error
                    'input_text' => [
                        'required' => 'Input Text Tidak Boleh Kosong',
                    ],
                    'input_radio' => [
                        'required' => 'Input Radio Tidak Boleh Kosong',
                    ],
                    'input_combo' => [
                        'required' => 'Input Combo Tidak Boleh Kosong',
                    ],
                    'input_tanggal' => [
                        'required' => 'Input Tanggal Tidak Boleh Kosong',
                    ],
                    'input_check' => [
                        'required' => 'Input Cek Tidak Boleh Kosong',
                    ],
                    'input_uang' => [
                        'required' => 'Input Uang Tidak Boleh Kosong',
                    ],

                    'input_dokumen' => [
                        'uploaded' => 'Input Dokumen Tidak Boleh Kosong',
                        'mime_in' => 'Jenis file yang dapat diterima adalah pdf',
                        'max_size' => 'Ukuran file yang dapat diterima adalah 10M',
                    ],
                ]
            );
        }
        //jika input gambar dan dokumen diisi oleh user
        if (!empty($_FILES["input_dokumen"]["name"]) and !empty($_FILES["input_foto"]["name"])) {
            $input = $this->validate(
                [
                    'input_text' => 'required',
                    'input_radio'  => 'required',
                    'input_combo'  => 'required',
                    'input_tanggal' => 'required',
                    'input_check'  => 'required',
                    'input_uang'  => 'required',
                    'input_foto' => [
                        'uploaded[input_foto]',
                        'mime_in[input_foto,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[input_foto,5120]', //maksimal 5 M
                    ],
                    'input_dokumen' => [
                        'uploaded[input_dokumen]',
                        'mime_in[input_dokumen,application/pdf]', //dibatasi haya pdf
                        'max_size[input_dokumen,10240]', //maksimal 10 M
                    ]
                ],
                [   //List Custom Pesan Error
                    'input_text' => [
                        'required' => 'Input Text Tidak Boleh Kosong',
                    ],
                    'input_radio' => [
                        'required' => 'Input Radio Tidak Boleh Kosong',
                    ],
                    'input_combo' => [
                        'required' => 'Input Combo Tidak Boleh Kosong',
                    ],
                    'input_tanggal' => [
                        'required' => 'Input Tanggal Tidak Boleh Kosong',
                    ],
                    'input_check' => [
                        'required' => 'Input Cek Tidak Boleh Kosong',
                    ],
                    'input_uang' => [
                        'required' => 'Input Uang Tidak Boleh Kosong',
                    ],
                    'input_foto' => [
                        'uploaded' => 'Input Foto Tidak Boleh Kosong',
                        'mime_in' => 'Jenis file yang dapat diterima adalah jpg atau png',
                        'max_size' => 'Ukuran file yang dapat diterima adalah 5M',
                    ],
                    'input_dokumen' => [
                        'uploaded' => 'Input Dokumen Tidak Boleh Kosong',
                        'mime_in' => 'Jenis file yang dapat diterima adalah pdf',
                        'max_size' => 'Ukuran file yang dapat diterima adalah 10M',
                    ],
                ]
            );
        } else {
            $input = $this->validate(
                [
                    'input_text' => 'required',
                    'input_radio'  => 'required',
                    'input_combo'  => 'required',
                    'input_tanggal' => 'required',
                    'input_check'  => 'required',
                    'input_uang'  => 'required',

                ],
                [   //List Custom Pesan Error
                    'input_text' => [
                        'required' => 'Input Text Tidak Boleh Kosong',
                    ],
                    'input_radio' => [
                        'required' => 'Input Radio Tidak Boleh Kosong',
                    ],
                    'input_combo' => [
                        'required' => 'Input Combo Tidak Boleh Kosong',
                    ],
                    'input_tanggal' => [
                        'required' => 'Input Tanggal Tidak Boleh Kosong',
                    ],
                    'input_check' => [
                        'required' => 'Input Cek Tidak Boleh Kosong',
                    ],
                    'input_uang' => [
                        'required' => 'Input Uang Tidak Boleh Kosong',
                    ],

                ]
            );
        }



        ///////////////
        // jika tidak valid
        if (!$input) {
            //kembalikan list error ke views
            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');
            echo view('Satu/edit', [
                'validation' => $this->validator,
                'datasatu' => $datasatu,
                'datasatudetail' => $datasatudetail
            ]);
            echo view('Layout/Footer');
        } else {
            //proses upload file ke server dulu
            //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
            $fileName = uniqid();

            //cek apakah file dokumen diupdate
            if (!empty($_FILES["input_foto"]["name"])) {
                //mendapatkan nama file asli untuk gambar
                $namafileasli = $_FILES['input_foto']['name'];
                $pos = explode(".", $namafileasli); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_gbr_asli = $pos[count($pos) - 1]; //mendapatkan hasil array yang paling akhir
                $gbr = $fileName . '.' . $ekstensi_file_gbr_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('input_foto');
                $avatar->move(ROOTPATH . 'public/images/upload', $gbr); //namafile u12adsasds + . + jpg
            } else {
                $gbr = $foto_lama;
            }

            if (!empty($_FILES["input_dokumen"]["name"])) {
                //mendapatkan nama file asli untuk dokumen
                $namafileasli = $_FILES['input_dokumen']['name'];
                $pos = explode(".", $namafileasli); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_dokumen_asli = $pos[count($pos) - 1]; //mendapatkan hasil array yang paling akhir
                $dok = $fileName . '.' . $ekstensi_file_dokumen_asli;

                //mengupload ke server ke lokasi public/dokumen/upload
                $avatar = $this->request->getFile('input_dokumen');
                $avatar->move(ROOTPATH . 'public/dokumen/upload', $dok); //namafile u12adsasds + . + pdf
            } else {
                $dok = $dokumen_lama;
            }

            //validasi tidak menemukan error sehingga bisa langsung di submit ke database
            //blok ini adalah blok jika sukses, yaitu panggil method insertData()
            $hasil = $satu_model->updateData($dok, $gbr);
            // return redirect()->to('Satu/view');
            return redirect()->to(base_url('Satu/view'));
        }
    }
}
