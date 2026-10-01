<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Demande extends BaseController
{
    public function __construct()
    {
    //...
    }
    public function faire_suivi($code = null)
    {
        $model = model(Db_model::class);
        if ($code == null)
        {
         return redirect()->to('/');
        }
        else{
            $data['titre'] = 'Suivi de Demande :';
            $data['demande'] = $model->get_message($code);
            
            return view('templates/haut', $data)
            . view('affichage_demande')
            . view('templates/bas');
        }
    }
}