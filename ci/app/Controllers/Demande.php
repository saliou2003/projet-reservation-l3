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
    public function afficher($code = null)
    {
        $model = model(Db_model::class);
        if ($code == null)
        {
         return redirect()->to('/');
        }
        else{
            $data['titre'] = 'Suivi de Demande :';
            $data['demande'] = $model->get_demande($code);
            
            return view('templates/haut', $data)
            . view('affichage_demande')
            . view('templates/bas');
        }
    }

    public function enregistrer()
    {
        helper('form');
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST")
        {
        if (! $this->validate([
        'titre' => 'required|max_length[255]|min_length[3]',
        'contenu' => 'required|max_length[255]|min_length[10]',
        'mail' => 'required|max_length[255]|min_length[8]'
        ],
        [ // Configuration des messages d’erreurs
            'titre' => [
            'required' => 'Veuillez entrer un titre pour le message !',
            'min_length' => 'Le titre saisi est trop court !',
            ],
            'contenu' => [
            'required' => 'Veuillez entrer le texte du message !',
            'min_length' => 'Le  message saisi est trop court !',
            ],
            'mail' => [
            'required' => 'Veuillez entrer un adresse mail valide !',
            'min_length' => 'Adresse mail saisie est trop courte !',
            ],
        ] 
        ))
        {
        // La validation du formulaire a échoué, retour au formulaire !
        return view('templates/haut', ['titre' => 'Remplir le formulaire'])
        . view('message/formulaire')
        . view('templates/bas_visit');
        }
        // La validation du formulaire a réussi, traitement du formulaire
        $recuperation = $this->validator->getValidated();
        $model->set_message($recuperation);
        $data['code']=$model->get_code();
        $data['le_message']="Merci nous avons bien reçu votre message, nous n'allons pas tarder à vous répondre.Voici votre code de suivi : ";
        
        return view('templates/haut', $data)
        . view('message/message_succes')
        . view('templates/bas_visit');
        }
        
        // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut', ['titre' => 'Remplir le formulaire'])
        . view('message/formulaire')
        . view('templates/bas_visit');
    }
    
    public function verifier()
    {
        helper('form');
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST")
        {
            if (! $this->validate([
            'code' => 'required|exact_length[20]|is_not_unique[t_message_msg.msg_code]'
          
            ],
            [ // Configuration des messages d’erreurs
                'code' => [
                'required' => 'Veuillez entrer un code !',
                'exact_length' => 'Le code doit contenir exactement 20 caractères !',
                'is_not_unique' => 'Ce code n\'existe pas dans notre base de données !'
                ],
            ] 
            ))
            {
            // La validation du formulaire a échoué, retour au formulaire !
            return view('templates/haut', ['titre' => 'Entrez un code valide'])
            . view('message/suivi')
            . view('templates/bas_visit');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            
            $data['titre']="Votre question :";
            $data['demande']=$model->get_message($recuperation);
            
            
            return view('templates/haut', $data)
            . view('message/suivi_succes')
            . view('templates/bas_visit');
        }
        
        // L’utilisateur veut afficher le formulaire pour saisir son code
        return view('templates/haut', ['titre' => 'Remplir le formulaire'])
        . view('message/suivi')
        . view('templates/bas_visit');
    }

    

}