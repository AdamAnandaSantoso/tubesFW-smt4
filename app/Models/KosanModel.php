<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;

class KosanModel extends Model
{
    protected $table = 'kos';
    protected $primaryKey = 'id_kos';

    protected $allowedFields = ['nama', 'jenis_kos', 'alamat', 'telepon'];

    public function getKos()
    {
        return $this->findAll();
    }

    public function getKosBasedOnId($id)
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM kos WHERE id_kos = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    public function updateKosan()
    {
        $db = db_connect();

        $data = [
            'nama' => $_POST['nama_kos'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'jenis_kos'  => $_POST['jenis_kos'],
            'alamat'  => $_POST['alamat_kos'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya
            'telepon'  => $_POST['telepon'],
        ];
        $builder = $db->table('kos');
        $builder->where('id_kos', $_POST['id_kos']);
        $builder->update($data);
    }

    public function deleteKos($id)
    {
        $db = db_connect();
        $builder = $db->table('kos');
        $builder->delete(['id_kos' => $id]);
    }
}
