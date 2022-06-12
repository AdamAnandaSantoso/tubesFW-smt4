<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghuniModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'penghuni';
    protected $primaryKey = 'id';

    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['ktp', 'nama', 'email', 'telepon'];

    // method untuk mendapatkan seluruh data pada tabel kos
    public function getPenghuni(){
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deletePenghuni($id){
        $db = db_connect();
        $builder = $db->table('penghuni');
        $builder->delete(['id' => $id]);
    }

    // method untuk viewData berdasarkan id
    public function getPenghuniBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM penghuni WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData kosan
    public function updatePenghuni(){
        $db = db_connect();

        $data = [
            'ktp' => $_POST['ktp'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'nama'  => $_POST['nama'],
            'email'  => $_POST['email'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya
            'telepon'  => $_POST['telepon'],
        ];
        $builder = $db->table('penghuni');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
    
}