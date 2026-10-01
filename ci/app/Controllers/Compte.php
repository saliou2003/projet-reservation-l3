<?php
 namespace App\Controllers;
 use App\Models\Db_model;
 use CodeIgniter\Exceptions\PageNotFoundException;
 class Compte extends BaseController
 {
     public function __construct()
    {
    
      helper('form');
      $this->model = model(Db_model::class);
    }
    public function lister()
    {
        $session=session();
        if (!$session->has('user'))
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
        $login=session()->get('user');
        $statut=$this->model->get_statut($login);

        if($statut->cpt_role == 'A'){
                    
                $data['compte']="Le nombre de comptes est :";
                $data['nbCompte']=$this->model->get_nb_comptes();
                $data['titre']="Liste de tous les comptes";
                $data['logins'] = $this->model->get_all_compte();
                return view('templates/haut_visit', $data)
                . view('affichage_comptes')
                . view('templates/bas');
        }
        else{
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
         }        
    }

    public function creer(){
       // helper('form');
        //$model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        $session=session();
        if (!$session->has('user'))
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');

        }
        $login=session()->get('user');
        $statut=$this->model->get_statut($login);

        if($statut->cpt_role == 'A'){
                    
                    if ($this->request->getMethod()=="POST")
                    {
                    if (! $this->validate([
                    'pseudo' => 'required|max_length[255]|min_length[2]|is_unique[t_compte_cpt.cpt_pseudo]',
                    'mdp' => 'required|max_length[255]|min_length[8]'
                    ],
                    [ // Configuration des messages d’erreurs
                        'pseudo' => [
                        'required' => 'Veuillez entrer un pseudo pour le compte !',
                        'min_length' => 'Le pseudo saisi est trop court !',
                        'is_unique' => 'Votre pseudo existe déjà !',
                        ],
                        'mdp' => [
                        'required' => 'Veuillez entrer un mot de passe !',
                        'min_length' => 'Le mot de passe saisi est trop court !',
                        ],
                    ] 
                    ))
                    {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut_visit', ['titre' => 'Créer un compte'])
                    . view('compte/compte_creer')
                    . view('templates/bas');
                    }
                    // La validation du formulaire a réussi, traitement du formulaire
                    $recuperation = $this->validator->getValidated();
                    $this->model->set_compte($recuperation);
                    $data['le_compte']=$recuperation['pseudo'];
                    $data['le_message']="Nouveau nombre de comptes : ";
                    //Appel de la fonction créée dans le précédent tutoriel :
                    $data['le_total']=$this->model->get_nb_comptes();
                    return view('templates/haut_visit', $data)
                    . view('compte/compte_succes')
                    . view('templates/bas');
                    }
                    
                    // L’utilisateur veut afficher le formulaire pour créer un compte
                    return view('templates/haut_visit', ['titre' => 'Créer un compte'])
                    . view('compte/compte_creer')
                    . view('templates/bas');
         }
         else{
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
         }
    }
    
    public function connecter()
    {   //helper('form');
        //$model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST"){
            if (! $this->validate([
            'pseudo' => 'required',
            'mdp' => 'required'
            ],
            [ // Configuration des messages d’erreurs
                'pseudo' => [
                'required' => 'Veuillez entrer un pseudo valide !',
                ],
                'mdp' => [
                'required' => 'Veuillez entrer un mot de passe valide !',
                ],
            ]
            ))
            { // La validation du formulaire a échoué, retour au formulaire !
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $username=$this->request->getVar('pseudo');
            $password=$this->request->getVar('mdp');
            if ($this->model->connect_compte($username,$password)==true)
            {
            $session=session();
            $session->set('user',$username);
            return redirect()->to('/compte/afficher_reservation');/* Ceci est retourné par afficher_reservation : view('templates/haut_visit')
            . view('connexion/compte_accueil')
            . view('templates/bas');*/
            }
            else
            { return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
            }
        }
        // L’utilisateur veut afficher le formulaire pour se connecter
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('connexion/compte_connecter')
        . view('templates/bas');
    }

    public function afficher_profil()
    {
       
        $session=session();
        if ($session->has('user'))
        {
            $login=session()->get('user');
            $statut=$this->model->get_statut($login);

            if($statut->cpt_role == 'A'){

                $data['le_message']="Votre profil";
                $login=session()->get('user');
                $data['profil']=$this->model->get_profil($login);
                return view('templates/haut_visit',$data)
                . view('connexion/compte_profil')
                . view('templates/bas');

            }else{
                $data['le_message']="Votre profil";
                $login=session()->get('user');
                $data['profil']=$this->model->get_profil($login);
                return view('templates/menu_membre',$data)
                . view('compte/profil_membre')
                . view('templates/bas');
            }
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }

    public function deconnecter()
    {
        $session=session();
        $session->destroy();
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('connexion/compte_connecter')
        . view('templates/bas');
    }

    public function afficher_reservation()
    {
       
        $session=session();
        if ($session->has('user'))
        {
            $data['message']="Récapitulatif de toutes vos réservations à venir";
            $login=session()->get('user');
            $statut=$this->model->get_statut($login);

            if($statut->cpt_role == 'A'){

                $data['espace']="d'administration";
                $data['reservations']=$this->model->get_reservations($login);
                return view('templates/haut_visit',$data)
                . view('connexion/compte_accueil',$data)
                . view('templates/bas');

            }
            else{
                $data['espace']="des membres";
                $data['reservations']=$this->model->get_reservations($login);
                return view('templates/menu_membre',$data)
                . view('connexion/compte_accueil',$data)
                . view('templates/bas');
            }
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }

    public function afficher_message()
    {
        $session=session();
        if ($session->has('user'))
        {   
            $login=session()->get('user');
            $statut=$this->model->get_statut($login);
 
            if($statut->cpt_role == 'A'){
            
                    $data['titre']="Liste de toutes les demandes ";
                    $data['questions']=$this->model->get_all_message();
                    return view('templates/haut_visit',$data)
                    . view('message/les_demandes')
                    . view('templates/bas');
            } 
            else
           {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
           }       
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }

    public function afficher_msg($id = null)
    {   
        if ($id == null)
        {
         return redirect()->to('compte/afficher_message');
        }

        $session=session();
        if ($session->has('user'))
        {
            $login=session()->get('user');
           $statut=$this->model->get_statut($login);

           if($statut->cpt_role == 'A'){
                    
                    
                        $data['titre'] = 'Suivi de Demande :';
                        $data['demande'] = $this->model->get_demande_by_id($id);
                        
                        if(empty($data['demande']->msg_reponse)){

                            return view('templates/haut_visit', $data)
                            . view('admin/repondu')
                            . view('admin/pas_repondu')
                            . view('templates/bas');
                        }
                        else {
                            return view('templates/haut_visit', $data)
                            . view('admin/repondu')
                            . view('templates/bas');
                        }
                
                    
            }
            else
            {
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }    

        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }    
    }
    
    public function repondre($msgId=null)
    {
        if($msgId == null)
        {
            return redirect()->to('compte/afficher_message');
        }

        $session=session();
        if ($session->has('user'))
        {
          $login=session()->get('user');
          $statut=$this->model->get_statut($login);

          if($statut->cpt_role == 'A'){
 

            $demande = $this->model->get_demande_by_id($msgId);

            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod()=="POST")
            {
            if (! $this->validate([
            'reponse' => 'required|max_length[255]|min_length[3]',
            
            ],
            [ // Configuration des messages d’erreurs
                'reponse' => [
                'required' => 'Veuillez entrer votre reponse !',
                'min_length' => 'Le texte  saisi est trop court !',
                ],
                
            ] 
            ))
            {
            // La validation du formulaire a échoué, retour au formulaire !
            $data = [
                'titre' => 'Répondre à la demande',
                'demande' => $demande
            ];
            
            return view('templates/haut_visit', $data)
                . view('admin/repondu', $data)
                . view('admin/pas_repondu')
                . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            $pseudo=$session->get('user');
            $cptId=$this->model->get_compte_id($pseudo);
            $cptid = $cptId->cpt_id;
            //Donne une réponse
            $this->model->update_message($cptid,$recuperation,$msgId);

            $demande = $this->model->get_demande_by_id($msgId);

        
            $data = [
                'titre' => 'Répondre à la demande',
                'demande' => $demande
            ];
            
            return view('templates/haut_visit', $data)
                . view('admin/repondu', $data)
                . view('templates/bas');
            }
            
            // L’utilisateur veut afficher le formulaire pour répondre au message
            return view('templates/haut_visit', ['titre' => 'Répondre le message'])
            . view('admin/repondu')
            . view('admin/pas_repondu')
            . view('templates/bas');
         }
         else
         {
          return view('templates/haut', ['titre' => 'Se connecter'])
          . view('connexion/compte_connecter')
          . view('templates/bas');
         }   
      }
       
       else
      {
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('connexion/compte_connecter')
        . view('templates/bas');
      }   
    } 

    public function afficher_les_profils()
    {
        $session=session();
        if ($session->has('user'))
        {    
            $login=session()->get('user');
            $statut=$this->model->get_statut($login);

            if($statut->cpt_role == 'M'){

                
                $data['titre']="Liste de tous les contacts ";
                $data['contacts']=$this->model->get_all_profil();
                return view('templates/menu_membre',$data)
                . view('compte/coordonne_memb')
                . view('templates/bas');
            }
            else
            {
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }
    
    public function afficher_les_ressources()
    {
        $session=session();
        if ($session->has('user'))
        {    
            $login=session()->get('user');
            $statut=$this->model->get_statut($login);

            if($statut->cpt_role == 'A'){

                
                $data['titre']="Liste de toutes les ressources ";
                $data['ressources']=$this->model->get_all_ressource();
                return view('templates/haut_visit',$data)
                . view('ressources/aff_ressources')
                . view('templates/bas');
            }
            else
            {
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }  


    public function ajouter_res(){
       
         $session=session();
         if (!$session->has('user'))
         {
             return view('templates/haut', ['titre' => 'Se connecter'])
             . view('connexion/compte_connecter')
             . view('templates/bas');
 
         }
         $login=session()->get('user');
         $statut=$this->model->get_statut($login);
 
         if($statut->cpt_role == 'A'){
                     
                     if ($this->request->getMethod()=="POST")
                     {
                        if (! $this->validate([
                            'nom' => 'required|max_length[255]|min_length[2]',
                            'jauge' => 'required|numeric|greater_than[7]|less_than_equal_to[15]'
                        ],
                        [ // Configuration des messages d'erreurs
                            'nom' => [
                                'required' => 'Veuillez entrer un nom pour la ressource !',
                                'min_length' => 'Le nom saisi est trop court !',
                            ],
                            'jauge' => [
                                'required' => 'Veuillez entrer la jauge max !',
                                'numeric' => 'La jauge doit être un nombre !',
                                'greater_than' => 'La jauge doit être supérieure à 7  !',
                                'less_than_equal_to' => 'La jauge ne peut pas dépasser 15 !',
                            ],
                        ] 
                     ))
                     {
                     // La validation du formulaire a échoué, retour au formulaire !
                     return view('templates/haut_visit', ['titre' => 'Ajouter une ressource'])
                     . view('ressources/add_ressource')
                     . view('templates/bas');
                     }
                     // La validation du formulaire a réussi, traitement du formulaire
                     $recuperation = $this->validator->getValidated();
                     $this->model->set_ressource($recuperation);
                     $data['nom_res']=$recuperation['nom'];
                     $data['le_message']="La ressource est ajoutée avec succés voila l'intitulé : ";
                     //Appel de la fonction créée dans le précédent tutoriel :
                     return view('templates/haut_visit', $data)
                     . view('ressources/ressource_succes')
                     . view('templates/bas');
                     }
                     
                     //formulaire
                     return view('templates/haut_visit', ['titre' => 'Ajouter une ressource'])
                     . view('ressources/add_ressource')
                     . view('templates/bas');
          }
          else{
             return view('templates/haut', ['titre' => 'Se connecter'])
             . view('connexion/compte_connecter')
             . view('templates/bas');
          }
     }

     public function effacer_res($id = null)
    {   
        if ($id == null)
        {
         return redirect()->to('ressources/aff_ressources');
        }

        $session=session();
        if ($session->has('user'))
        {
            $login=session()->get('user');
           $statut=$this->model->get_statut($login);

           if($statut->cpt_role == 'A'){
                    
                    
                            $this->model->delete_ressource($id);

                            $data['titre']="Liste de toutes les ressources ";
                            $data['ressources']=$this->model->get_all_ressource();

                            return view('templates/haut_visit',$data)
                            . view('ressources/aff_ressources')
                            . view('templates/bas');
                      
                
                    
            }
            else
            {
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }    

        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }    
    }

    public function voir_reservation(){
       
        $session=session();
        if (!$session->has('user'))
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');

        }
        $login=session()->get('user');
        $statut=$this->model->get_statut($login);

        if($statut->cpt_role == 'M'){
                    
                    if ($this->request->getMethod()=="POST")
                    {
                       if (! $this->validate([
                           'date' => 'required|max_length[255]|min_length[2]',
                       ],
                       [ // Configuration des messages d'erreurs
                           'date' => [
                               'required' => 'Veuillez entrer une date!',
                               
                           ],
                           
                       ] 
                    ))
                    {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/menu_membre', ['titre' => 'Donner une date'])
                    . view('ressources/reservation')
                    . view('templates/bas');
                    }
                    // La validation du formulaire a réussi, traitement du formulaire
                    $date_choisie = $this->validator->getValidated();
                   

                    $reservations = $this->model->get_reservation_day($date_choisie);
                   // Regrouper par ressource
                    $par_ressource = [];
                    foreach ($reservations as $res) {
                        $par_ressource[$res->res_nom][] = $res;
                    }
                    
                    $data = [
                        'date_choisie' => $date_choisie,
                        'par_ressource' => $par_ressource
                    ];

                     return view('templates/menu_membre', $data)
                    . view('ressources/reservation')
                    . view('ressources/affiche_reserv')
                    . view('templates/bas');
                    }
                    
                    //formulaire
                    return view('templates/menu_membre', ['titre' => 'Afficher les réservations'])
                    . view('ressources/reservation')
                    . view('templates/bas');
         }
         else{
                if ($this->request->getMethod()=="POST")
                {
                if (! $this->validate([
                    'date' => 'required|max_length[255]|min_length[2]',
                ],
                [ // Configuration des messages d'erreurs
                    'date' => [
                        'required' => 'Veuillez entrer une date!',
                        
                    ],
                    
                ] 
                ))
                {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut_visit', ['titre' => 'Donner une date'])
                . view('ressources/reservation')
                . view('templates/bas');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $date_choisie = $this->validator->getValidated();
            

                $reservations = $this->model->get_reservation_day($date_choisie);
            // Regrouper par ressource
                $par_ressource = [];
                foreach ($reservations as $res) {
                    $par_ressource[$res->res_nom][] = $res;
                }
                
                $data = [
                    'date_choisie' => $date_choisie,
                    'par_ressource' => $par_ressource
                ];

                return view('templates/haut_visit', $data)
                . view('ressources/reservation')
                . view('ressources/affiche_reserv')
                . view('templates/bas');
                }
                
                //formulaire
                return view('templates/haut_visit', ['titre' => 'Afficher les réservations'])
                . view('ressources/reservation')
                . view('templates/bas');
            }
    }

}

