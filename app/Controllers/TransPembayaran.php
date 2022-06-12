<?php

namespace App\Controllers;

use App\Models\TransPembayaranModel;
use CodeIgniter\Commands\Utilities\Publish;

class TransPembayaran extends BaseController
{
    public function view()
    {
        $trans_pembayaran_model = model(TransPembayaranModel::class);
        $datakamar = $trans_pembayaran_model->getDataKamar();
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
        echo view(
            'Pembayaran/view',
            [
                'title' => 'Pesan Kamar',
                'datakamar' => $datakamar,
            ]
        );
        echo view('Layout/Footer');
    }

    public function ViewKamar($id)
    {
        $satu_model = model(TransPembayaranModel::class);
        $datasatu = $satu_model->getDataJenisKamar($id);

        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        echo view(
            'Pembayaran/ViewKamar',
            [
                'title' => 'Edit satu',
                'datasatu' => $datasatu,

            ]
        );
        echo view('Layout/Footer');
    }

    public function token(){
        $id_pemesanan = $_POST['id_pemesanan'];
        $nominal_pembayaran = preg_replace('/[^0-9 ]/i', '', $_POST['nominal_pembayaran']);
        \Midtrans\Config::$serverKey = 'SB-Mid-server-F--uLdPkc_4srItwuSYD1Ixf';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // Required
        $transaction_details = array(
            'order_id' => rand(), // bisa diisi random atau angka tertentu
            'gross_amount' => $nominal_pembayaran, // no decimal allowed for creditcard
        );
        // Optional
        $customer_details = array(
            'first_name'    => $id_pemesanan,
            'last_name'     => "",
            'email'         => "adam@gmail.com", //ganti dengan email anda
            'phone'         => ""
        );
        // Fill transaction details
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );
        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        echo $snapToken;
    }

    // method tambah data
    public function add($id_kamar, $nama_kamar, $nama_jenis_kamar, $id_jenis_kamar)
    {
        $trans_pembayaran_model = model(TransPembayaranModel::class);

        $validation =  \Config\Services::validation();

        // panggil function validate untuk memvalidasi inputan user yg dikirim via form input
        if (isset($_POST['id_pemesanan']) and isset($_POST['tanggal_pembayaran']) and isset($_POST['total_rawat']) and isset($_POST['nilai_pembayaran']) and isset($_POST['nominal_pembayaran'])) {
            // panggil validasi
            if (
                $this->request->getMethod() === 'post' &&
                $this->validate(
                    [
                        'id_pemesanan' => 'required',
                        'tanggal_pembayaran' => 'required',
                        'total_rawat' => 'required',
                        'nominal_pembayaran' => 'required',
                    ],
                    [   // Errors
                        'id_pemesanan' => [
                            'required' => 'ID Pemesanan Tidak Boleh Kosong',
                        ],
                        'tanggal_pembayaran' => [
                            'required' => 'Tanggal Pembayaran Tidak Boleh Kosong'
                        ],
                        'total_rawat' => [
                            'required' => 'Total Rawat Tidak Boleh Kosong',
                        ],
                        'nominal_pembayaran' => [
                            'required' => 'Nominal Pembayaran Tidak Boleh Kosong'
                        ],
                    ]
                )
            ) {
                // dijalankan kalau tidak ada eror
                $trans_pembayaran_model->inputPembayaran();

                $result = json_decode($_POST['result_data'], true); // array asosiatif        
        
                //besar bayar dibuat 0 sampai ybs melakukan pembayaran
                
                $data = array(
                    'order_id' => $result['order_id'],	
                    'gross_amount' => $result['gross_amount'],	
                    'payment_type' => $result['payment_type'],
                    'transaction_time' => $result['transaction_time'],
                    'bank' => isset($result['va_numbers'][0]['bank']) ? $result['va_numbers'][0]['bank']: '-',
                    'va_number' => isset($result['va_numbers'][0]['va_number']) ? $result['va_numbers'][0]['va_number']: '-',
                    'pdf_url' => $result['pdf_url'],
                    'status_code' => $result['status_code']
                );
                // inputkan ke database
                $hasil = $trans_pembayaran_model->inputPembayaranMidtarns($data);
               
                if($hasil){
                    echo 'sukses';
                }else{
                    echo 'gagal';
                }


                // $session = session();
                // $session->setFlashdata("status_dml", "Sukses Input Pemesanan");
                // $nama = $nama_kamar;
                return redirect()->to('http://localhost:8080/TransPembayaran/autoRefresh');
                // return redirect()->to('pembayaran2'); 
            } else {

                // disi kalau ada eror
                $data['id_kamar'] = $id_kamar;
                $data['nama_kamar'] = $nama_kamar;
                $data['nama_jenis_kamar'] = $nama_jenis_kamar;
                $data['id_jenis_kamar'] = $id_jenis_kamar;

                $hasil = $trans_pembayaran_model->getKamarBasedOnId($id_kamar);
                // $ha = $trans_pembayaran_model->getDataPemesanan($id_kamar);

                foreach ($hasil as $row) :
                    $tarif = $row['tarif'];
                endforeach;

                $data['kamar'] = $hasil;
                // $data['id_kamar'] = $id_kamar; //id kosan
                // $data['nama_kamar'] = $nama_kamar;
                // $data['nama_jenis_kamar'] = $nama_jenis_kamar;
                // $data['id_jenis_kamar'] = $id_jenis_kamar;
                $data['tarif'] = $tarif;

                $data['validation'] = $this->validator;
                // $data['datapasien'] = $trans_pembayaran_model->getDataPasien();
                $data['datapemesanan'] = $trans_pembayaran_model->getDataPemesanan($id_kamar, $id_jenis_kamar);
                echo view('Layout/Header');
                echo view('Layout/Sidebar');
                echo view('Layout/Body');
                echo view('Pembayaran/add', $data);
                echo view('Layout/Footer');
            }
            // akhir panggil validasi
        } else {
            //jangan palnggil validasi
            $data['id_kamar'] = $id_kamar;
            $data['nama_kamar'] = $nama_kamar;
            $data['nama_jenis_kamar'] = $nama_jenis_kamar;
            $data['id_jenis_kamar'] = $id_jenis_kamar;

            $hasil = $trans_pembayaran_model->getKamarBasedOnId($id_kamar);
            // $ha = $trans_pembayaran_model->getDataPemesanan($id_kamar);

            foreach ($hasil as $row) :
                $tarif = $row['tarif'];
            endforeach;


            $data['kamar'] = $hasil;
            // $data['id_kamar'] = $id_kamar; //id kosan
            // $data['nama_kamar'] = $nama_kamar;
            // $data['nama_jenis_kamar'] = $nama_jenis_kamar;
            // $data['id_jenis_kamar'] = $id_jenis_kamar;
            $data['tarif'] = $tarif;

            $data['datapemesanan'] = $trans_pembayaran_model->getDataPemesanan($id_kamar, $id_jenis_kamar);
            // $data['datapasien'] = $trans_pembayaran_model->getDataPasien();
            echo view('Layout/Header');
            echo view('Layout/Sidebar');
            echo view('Layout/Body');

            echo view('Pembayaran/add', $data);
            echo view('Layout/Footer');
        }
    }

    public function autoRefresh(){
        // $satu_model = model(TransPemesananModel::class);
        // $datasatu = $satu_model->getDataJenisKamar($nama_kamar);

        //query data transaksi yang masih pending	
        $pembayaran2_model = new TransPembayaranModel();
		$hasil = $pembayaran2_model->getStatusPembayaranMidtrans();
        $id = array();
		foreach($hasil as $ks){
			array_push($id,$ks->order_id);
		}
		for($i=0; $i<count($id); $i++){
			$ch = curl_init(); 
			$login = 'SB-Mid-server-F--uLdPkc_4srItwuSYD1Ixf';
			$password = '';
			$orderid = $id[$i];
			$URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
			$output = curl_exec($ch); 
			curl_close($ch);    
			$outputjson = json_decode($output, true);
			if($outputjson['status_code']==200){
				$data = array(
					'status_code' => $outputjson['status_code'],
					'payment_time' => $outputjson['settlement_time']
				);
			}else{
				$data = array(
					'status_code' => $outputjson['status_code']
				);
			}
            $hasil = $pembayaran2_model->updateStatusPembayaranMidtrans($data, $orderid);
			
			/*looping per transaksi*/
		}	
        $session = session();
        $session->setFlashdata("status_dml", "Sukses Input Pembayaran");
        return redirect()->to("http://localhost:8080/TransPembayaran/view");
    }

    public function ViewData($id_kamar, $id_jenis_kamar)
    {
        $data_pembayaran_model = model(TranspembayaranModel::class);
        $datapembayaran = $data_pembayaran_model->getAllDatapembayaranMidTrans($id_kamar, $id_jenis_kamar);
        echo view('Layout/Header');
        echo view('Layout/Sidebar');
        echo view('Layout/Body');
        // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
        echo view(
            'pembayaran/ViewData',
            [
                'title' => 'Pesan Kamar',
                'datapembayaran' => $datapembayaran,
            ]
        );
        echo view('Layout/Footer');
    }
}
