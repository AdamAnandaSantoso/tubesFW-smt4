<?php
namespace App\Controllers;

use App\Models\Pembayaran2Model;


class Pembayaran2 extends BaseController
{
    
    // index
    public function index()
    {
        $pembayaran2_model = new Pembayaran2Model();
        $data['kosan']  = $pembayaran2_model->getListKosan();
    	echo view('Pembayaran2/list', $data);
	}

    // untuk mendapatkan token
    public function token(){
        $nama = $_POST['nama'];
        $byr = $_POST['byr'];
        \Midtrans\Config::$serverKey = '<<APP KEY ANDA>>';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // Required
        $transaction_details = array(
            'order_id' => rand(), // bisa diisi random atau angka tertentu
            'gross_amount' => $byr, // no decimal allowed for creditcard
        );
        // Optional
        $customer_details = array(
            'first_name'    => $nama,
            'last_name'     => "",
            'email'         => "toratelu@gmail.com", //ganti dengan email anda
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


    // untuk menginput ke database
    public function finish(){
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
        $pembayaran2_model = new Pembayaran2Model();
        $hasil = $pembayaran2_model->inputData($data);
       
        if($hasil){
			echo 'sukses';
		}else{
			echo 'gagal';
		}
        return redirect()->to('pembayaran2'); 
    }

    // untuk autorefresh
    public function autorefresh(){
        //query data transaksi yang masih pending	
        $pembayaran2_model = new Pembayaran2Model();
		$hasil = $pembayaran2_model->getStatus();
        $id = array();
		foreach($hasil as $ks){
			array_push($id,$ks->order_id);
		}
		for($i=0; $i<count($id); $i++){
			$ch = curl_init(); 
			$login = '<<APP KEY ANDA>>';
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
            $hasil = $pembayaran2_model->updateStatus($data, $orderid);
			
			/*looping per transaksi*/
		}	
        echo view('Pembayaran2/Autorefresh');
    }
}