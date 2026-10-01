


    
         <div class="slide-one-item home-slider owl-carousel">
            <div class="site-blocks-cover overlay" style="background-image: url(<?php echo base_url();?>bootstrap/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
              <div class="container">
                <div class="row align-items-center justify-content-start">
                  <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="bg-text-line">Brest Football Club</h1>
                    <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">BFC</a></p>
                  </div>
                </div>
              </div>
            </div>  
      
            <div class="site-blocks-cover overlay" style="background-image: url(<?php echo base_url();?>bootstrap/images/hero_bg_4.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
              <div class="container">
                <div class="row align-items-center justify-content-start">
                  <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="bg-text-line">Brest Football Club</h1>
                    <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">BFC</a></p>
                  </div>
                </div>
              </div> 
            </div>  
      
            <div class="site-blocks-cover overlay" style="background-image: url(<?php echo base_url();?>bootstrap/images/hero_bg_3.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
              <div class="container">
                <div class="row align-items-center justify-content-start">
                  <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="bg-text-line">Brest Football Club</h1>
                    <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">BFC</a></p>
                  </div>
                </div>
              </div>
            </div>  
          </div>
          
      
          <div class="site-section pt-0 feature-blocks-1" data-aos="fade" data-aos-delay="100">
            <div class="container">
              <div class="row">
                <div class="col-md-6 col-lg-4" >
                  <div class="p-3 p-md-5 feature-block-1 mb-5 mb-lg-0 bg" style="background-image: url('<?php echo base_url();?>bootstrap/images/img_1.jpg');">
                    <div class="text">
                      <h2 class="h5 text-white">Russia's World Cup Championship</h2>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos repellat autem illum nostrum sit distinctio!</p>
                      <p class="mb-0"><a href="#" class="btn btn-primary btn-sm px-4 py-2 rounded-0">Read More</a></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="p-3 p-md-5 feature-block-1 mb-5 mb-lg-0 bg" style="background-image: url('<?php echo base_url();?>bootstrap/images/img_2.jpg');">
                    <div class="text">
                      <h2 class="h5 text-white">Russia's World Cup Championship</h2>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos repellat autem illum nostrum sit distinctio!</p>
                      <p class="mb-0"><a href="#" class="btn btn-primary btn-sm px-4 py-2 rounded-0">Read More</a></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="p-3 p-md-5 feature-block-1 mb-5 mb-lg-0 bg" style="background-image: url('<?php echo base_url();?>bootstrap/images/img_3.jpg');">
                    <div class="text">
                      <h2 class="h5 text-white">Russia's World Cup Championship</h2>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos repellat autem illum nostrum sit distinctio!</p>
                      <p class="mb-0"><a href="#" class="btn btn-primary btn-sm px-4 py-2 rounded-0">Read More</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      
          <div class="site-blocks-vs site-section bg-light">
            <div class="container">
            <?php

               if(!empty($actus) && is_array($actus)){
                  
                  echo"<table class='table table-hover table-dark table-striped-columns'>
                  <thead>
                  <tr>
                    
                      <th scope='col'>ID</th>
                      <th scope='col'>Titre</th>
                      <th scope='col'>Contenu</th>
                      <th scope='col'>Auteur</th>
                      <th scope='col'>Date de publication</th>
                  </tr>
                  </thead>";

                    foreach($actus as $news){
                      
                    
                      echo"<tbody>
                        <tr>
                          
                            <td>".$news["act_id"]."</td>
                            <td>".$news["act_titre"]."</td>
                            <td>".$news["act_contenu"]."</td>
                            <td>".$news["act_auteur"]."</td>
                            <td>".$news["act_date"]."</td>
                        </tr>
                      
                        </tbody>";
                    }
                  echo"</table>";
                   
              }
               
              else{
                echo"<h2> Pas d'actualités poue le moment ! </h2>";
               }










               /* echo ("Page Web OK");
                // Connexion à la base MariaDB
                $mysqli = new mysqli('localhost','e22308557sql','zDLYyP6?','e22308557_db1');
                if ($mysqli->connect_errno) {
                //...
                }
                //Préparation du mot de passe de l'utilisateur tuxie
                $userspassword = "CeciEstMonMotdePasse!123";
                // On rajoute du sel...
                // pour empêcher les attaques par "Rainbow Tables" cf
                // http://en.wikipedia.org/wiki/Rainbow_table
                $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
                // Le mot de passe rallongé sera donc :
                // OnRajouteDuSelPourAllongerleMDP123!!45678__TestCeciEstMonMotdePasse!123
                $password = hash('sha256', $salt.$userspassword);
                echo $password;
                // Constitution par concaténation d'une requête UPDATE + exécution
                $requete = "UPDATE t_compte_cpt SET cpt_mot_de_passe='".$password."' WHERE
                cpt_pseudo='losaliou';";
                echo($requete);
                $resultat=$mysqli->query($requete);
                //Modification du mot de passe du profil de login tuxie
                if (!$resultat)
                {
                // La requête a echoué ...
                }
                else
                {
                // La requête a réussi...
                }
                $requete1 = "SELECT * FROM t_ressource_res WHERE res_id=6;";
                
                $resultat1=$mysqli->query($requete1);
                
                if (!$resultat1)
                {
                  echo " La requête a echoué ...";
                }
                else
                {
                  $nom_file=$resultat1->fetch_assoc();
      
                  echo '<img src="' . base_url() . 'bootstrap/documents/' . $nom_file["res_image_url"] . '">';
                  echo '<a href="' . base_url() . 'bootstrap/documents/' . $nom_file["res_descriptif"] . '">pdf lien</a>';
                }
                //Fermeture de la communication avec la base MariaDB
                $mysqli->close();*/
                ?>
                <br> <br> <br> <br>
              <div class="border mb-3 rounded d-block d-lg-flex align-items-center p-3 next-match">
      
              
                <div class="mr-auto order-md-1 w-60 text-center text-lg-left mb-3 mb-lg-0">
                  Next match 
                  <div id="date-countdown"></div>
                </div>
      
                <div class="ml-auto pr-4 order-md-2">
                  <div class="h5 text-black text-uppercase text-center text-lg-left">
                    <div class="d-block d-md-inline-block mb-3 mb-lg-0">
                      <img src="<?php echo base_url();?>bootstrap/images/img_1_sq.jpg" alt="Image" class="mr-3 image"><span class="d-block d-md-inline-block ml-0 ml-md-3 ml-lg-0">Sea Hawlks </span>
                    </div>
                    <span class="text-muted mx-3 text-normal mb-3 mb-lg-0 d-block d-md-inline ">vs</span> 
                    <div class="d-block d-md-inline-block">
                      <img src="<?php echo base_url();?>bootstrap/images/img_3_sq.jpg" alt="Image" class="mr-3 image"><span class="d-block d-md-inline-block ml-0 ml-md-3 ml-lg-0">Patriots</span>
                    </div>
                  </div>
                </div>
                
                
              </div>
      
              <div class="bg-image overlay-success rounded mb-5" style="background-image: url('<?php echo base_url();?>bootstrap/images/hero_bg_1.jpg');" data-stellar-background-ratio="0.5">
                
                <div class="row align-items-center">
                  <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
      
                    <div class="text-center text-lg-left">
                      <div class="d-block d-lg-flex align-items-center">
                        <div class="image mx-auto mb-3 mb-lg-0 mr-lg-3">
                          <img src="<?php echo base_url();?>bootstrap/images/img_1_sq.jpg" alt="Image" class="img-fluid">
                        </div>
                        <div class="text">
                          <h3 class="h5 mb-0 text-black">Sea Hawks</h3>
                          <span class="text-uppercase small country text-black">Brazil</span>
                        </div>
                      </div>
                    </div>
      
                  </div>
                  <div class="col-md-12 col-lg-4 text-center mb-4 mb-lg-0">
                    <div class="d-inline-block">
                      <p class="mb-2"><small class="text-uppercase text-black font-weight-bold">Premier League &mdash; Round 10</small></p>
                      <div class="bg-black py-2 px-4 mb-2 text-white d-inline-block rounded"><span class="h3">3:2</span></div>
                      <p class="mb-0"><small class="text-uppercase text-black font-weight-bold">10 September / 7:30 AM</small></p>
                    </div>
                  </div>
      
                  <div class="col-md-12 col-lg-4 text-center text-lg-right">
                    <div class="">
                      <div class="d-block d-lg-flex align-items-center">
                        <div class="image mx-auto ml-lg-3 mb-3 mb-lg-0 order-2">
                          <img src="<?php echo base_url();?>bootstrap/images/img_4_sq.jpg" alt="Image" class="img-fluid">
                        </div>
                        <div class="text order-1">
                          <h3 class="h5 mb-0 text-black">Steelers</h3>
                          <span class="text-uppercase small country text-black">London</span>
                        </div>
                      </div>
                    </div>
                  </div>
      
                </div>
              </div>
        </div> <!-- Fermeture de .container -->
    </div> <!-- Fermeture de .site-blocks-vs -->
