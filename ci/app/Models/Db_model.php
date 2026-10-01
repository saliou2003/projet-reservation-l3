<?php
   /*
     THEME: Resaweb(Application de réservation de ressources d'une association sportive)
     Version : V2.1
     Auteur : Serigne Saliou LO 
    */
    namespace App\Models;
    use CodeIgniter\Model;
    class Db_model extends Model
    {
        protected $db;
        public function __construct()
        {
            $this->db = db_connect(); //charger la base de données 
            // ou
            // $this->db = \Config\Database::connect();
        }
        public function get_all_compte()
        {
            $resultat = $this->db->query("SELECT *,pfl_nom,pfl_prenom,pfl_email FROM t_compte_cpt LEFT JOIN t_profil_pfl USING(cpt_id) ORDER BY cpt_etat ASC;");
            return $resultat->getResultArray();
        }
        //Permet de recupèrer une actualité via son ID.
        public function get_actualite($numero)
        {
            $requete="SELECT * FROM t_actualite_act WHERE act_id=".$numero.";";
            $resultat = $this->db->query($requete);
            return $resultat->getRow();
        }
       
        //Permet de recupèrer le nombre de compte dans la base.
        public function get_nb_comptes(){
            $resultat = $this->db->query("SELECT COUNT(*) AS nbComptes FROM t_compte_cpt;");
            return $resultat->getRow();
        }

        //Permet de recupèrer toutes les actualités.
        public function get_all_actualite()
        {
            $requete = "SELECT * FROM t_actualite_act WHERE act_etat='L' ORDER BY act_id DESC LIMIT 5";
            $resultat = $this->db->query($requete);
            return $resultat->getResultArray();
        }

        //Permet de recupèrer le message du visiteur: v1.
        public function get_demande($code)
        {
            
            $requete="SELECT * FROM t_message_msg WHERE msg_code='".$code."';";
            $resultat = $this->db->query($requete);
            return $resultat->getRow();
        }
        //Permet de recupèrer le message du visiteur: v2.
        public function get_message($saisie)
        {
            $le_code=htmlspecialchars(addslashes($saisie['code']));
            $requete="SELECT * FROM t_message_msg WHERE msg_code='".$le_code."';";
            $resultat = $this->db->query($requete);
            return $resultat->getRow();
        }

        //Permet d'insèrer une ligne dans la table compte.
        public function set_compte($saisie)
        {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login=htmlspecialchars(addslashes($saisie['pseudo']));
        $mot_de_passe=htmlspecialchars(addslashes($saisie['mdp']));
        $sql="INSERT INTO t_compte_cpt VALUES('null','".$login."','".$mot_de_passe."','I','A');";
        return $this->db->query($sql);
       }

        //Permet d'insèrer une ligne dans la table message.
       public function set_message($saisie)
        {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $titre=htmlspecialchars(addslashes($saisie['titre']));
        $contenu=htmlspecialchars(addslashes($saisie['contenu']));
        $mail=htmlspecialchars(addslashes($saisie['mail']));
        $sql="INSERT INTO t_message_msg VALUES(null,'".$titre."','".$contenu."',null,'".$mail."',now(),SUBSTRING(MD5(RAND()),1,20),null);";
        return $this->db->query($sql);
       }
       
       //Permet de recupèrer le code du visiteur.
       public function get_code()
        {
          
            $requete = "SELECT msg_code FROM t_message_msg ORDER BY msg_id DESC LIMIT 1";
            $resultat = $this->db->query($requete);
            return $resultat->getRow();
        }

        public function connect_compte($u,$p)
        {
            $sql="SELECT cpt_pseudo,cpt_mot_de_passe
            FROM t_compte_cpt
            WHERE cpt_pseudo='".$u."'
            AND cpt_mot_de_passe='".$p."';";
            $resultat=$this->db->query($sql);
            if($resultat->getNumRows() > 0)
            {
            return true;
            }
            else
            {
            return false;
            }
        }
        
        public function get_profil($u)
        {
            $sql="SELECT *,cpt_pseudo
            FROM t_profil_pfl
            LEFT JOIN t_compte_cpt USING(cpt_id)
            WHERE cpt_id IN (SELECT cpt_id FROM t_compte_cpt WHERE cpt_pseudo ='".$u."');";

            $resultat=$this->db->query($sql);
            
            return $resultat->getRow();
        }
        
        public function get_reservations($u)
        {
            $sql="SELECT 
            r.rsv_id,
            r.rsv_date,
            r.rsv_nom AS reservation_nom,
            res.res_nom AS ressource_nom,
            res.res_image_url,
                GROUP_CONCAT(DISTINCT CONCAT_WS(' ', p.pfl_prenom, p.pfl_nom) SEPARATOR ', ') AS participants
            FROM t_reservation_rsv r
            LEFT JOIN t_ressource_res res ON r.res_id = res.res_id
            LEFT JOIN t_inscrit_ict i ON i.rsv_id = r.rsv_id
            LEFT JOIN t_compte_cpt c ON i.cpt_id = c.cpt_id
            LEFT JOIN t_profil_pfl p ON c.cpt_id = p.cpt_id
            WHERE r.rsv_date > NOW()
            AND r.rsv_id IN (
              SELECT rsv_id 
              FROM t_inscrit_ict 
              WHERE cpt_id = (SELECT cpt_id FROM t_compte_cpt WHERE cpt_pseudo = '".$u."')
            )
            GROUP BY r.rsv_id
            ORDER BY r.rsv_date ASC;";

            $resultat=$this->db->query($sql);
            
            return $resultat->getResultArray();
        }

         //Permet de recupèrer tous les messages des visiteur.
         public function get_all_message()
         {
          
             $requete="SELECT * FROM t_message_msg ORDER BY msg_date DESC ;";
             $resultat = $this->db->query($requete);
             return $resultat->getResultArray();
         }

         public function get_demande_by_id($id)
        {
            
            $requete="SELECT *,cpt_pseudo FROM `t_message_msg` LEFT JOIN t_compte_cpt USING(cpt_id) WHERE msg_id='".$id."';";
            $resultat = $this->db->query($requete);
            return $resultat->getRow();
        }

        public function  update_message($cptId,$reponse,$msgId)
        {
            $rep=$reponse['reponse'];

            $requete="UPDATE t_message_msg SET msg_reponse='".$rep."',cpt_id='".$cptId."' WHERE msg_id='".$msgId."';";
            
            return $this->db->query($requete);
        }
        
        public function get_compte_id($su)
        {
            
            $sql="SELECT *
            FROM t_compte_cpt
            WHERE cpt_pseudo='".$su."';";
            $resultat=$this->db->query($sql);
            return $resultat->getRow();
        }

        public function get_statut($su)
        {
            
            $sql="SELECT cpt_role FROM `t_compte_cpt` WHERE cpt_pseudo='".$su."';";
            $resultat=$this->db->query($sql);
            return $resultat->getRow();
        }

        public function get_all_profil()
        {
            $sql="SELECT * FROM t_profil_pfl ;";

            $resultat=$this->db->query($sql);
            
            return $resultat->getResultArray();
        }

        public function get_all_ressource()
        {
          
             $requete="SELECT * FROM t_ressource_res;";
             $resultat = $this->db->query($requete);
             return $resultat->getResultArray();
        }

        public function set_ressource($saisie)
        {
            //Récuparation (+ traitement si nécessaire) des données du formulaire
            $nom=htmlspecialchars(addslashes($saisie['nom']));
            $jauge=htmlspecialchars(addslashes($saisie['jauge']));
            
            $sql="INSERT INTO t_ressource_res VALUES(null,'".$nom."','default-avatar.png','".$jauge."','En attente');";
            return $this->db->query($sql);
       }

       public function delete_ressource($id)
        {
          
            $sql="DELETE FROM t_liaison_lsn WHERE res_id ='".$id."';";
            $this->db->query($sql);

            $sql1="DELETE FROM t_ressource_res WHERE res_id ='".$id."';";
            return $this->db->query($sql1);
       }

       public function get_reservation_day($date)
        {
            $dat=$date['date'];

                $requete = "SELECT 
                t_reservation_rsv.rsv_id,
                t_reservation_rsv.rsv_nom,
                t_reservation_rsv.rsv_date,
                t_reservation_rsv.rsv_bilan,
                t_ressource_res.res_id,
                t_ressource_res.res_nom,
                t_ressource_res.res_image_url,
                t_ressource_res.res_jauge_max,
                GROUP_CONCAT(
                    CONCAT(t_compte_cpt.cpt_pseudo, ' (', t_inscrit_ict.ict_role, ')') 
                    ORDER BY t_inscrit_ict.ict_role DESC, t_compte_cpt.cpt_pseudo 
                    SEPARATOR ', '
                ) as participants
            FROM t_reservation_rsv
            LEFT JOIN t_ressource_res USING(res_id)
            LEFT JOIN t_inscrit_ict USING(rsv_id)
            LEFT JOIN t_compte_cpt USING(cpt_id)
            WHERE DATE(t_reservation_rsv.rsv_date) = '" . $dat . "'
            GROUP BY t_reservation_rsv.rsv_id
            ORDER BY t_ressource_res.res_nom ASC, t_reservation_rsv.rsv_date ASC";
            
            $resultat = $this->db->query($requete);
            return $resultat->getResult();
       }

       
    }