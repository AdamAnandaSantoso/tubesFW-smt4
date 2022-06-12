<?php

namespace App\Controllers;

use App\Models\KosanModel;

class Kosan extends BaseController
{
    public function aksesdb()
    {
        $model = model(KosanModel::class);
        $data['datakosan'] = $model->getKos();
        return view('KosanView', $data);
        // echo "<pre>";
        // print_r($model->getKos());
        // echo "</pre>";
        // $data['news'] = $model->getKos();
    }
}
