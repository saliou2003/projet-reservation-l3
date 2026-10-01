<?php
    namespace App\Controllers;
    use App\Models\Db_model;
    use CodeIgniter\Exceptions\PageNotFoundException;
    class Accueil extends BaseController
    {
    public function afficher()
    {
        $model = model(Db_model::class);
        $data['titre']="Les actualités";
        $data['actus'] =$model->get_all_actualite();

         return  view('templates/haut', $data)
                . view('affichage_accueil')
                . view('templates/bas');
    } 
    }
?>