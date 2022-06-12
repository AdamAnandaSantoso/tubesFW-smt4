<?php

namespace App\Models;

use CodeIgniter\Model;

class CoaModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'coa';

    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['kode_akun', 'nama_akun', 'header_akun'];

    // method untuk mendapatkan seluruh data pada tabel kos
    public function getCoa()
    {
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deleteCoa($id)
    {
        $db = db_connect();
        $builder = $db->table('coa');
        $builder->delete(['kode_akun' => $id]);
    }
    // method untuk viewData berdasarkan id
    public function getCoaBasedOnId($id)
    {
        $db = db_connect();
        $query   = $db->query('SELECT * FROM coa WHERE kode_akun = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData kosan
    public function updateCoa()
    {
        $db = db_connect();

        $data = [
            'nama_akun'  => $_POST['nama_akun'],
            'header_akun'  => $_POST['header_akun'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya
        ];
        $builder = $db->table('coa');
        $builder->where('kode_akun', $_POST['kode_akun']);
        $builder->update($data);
    }
}
