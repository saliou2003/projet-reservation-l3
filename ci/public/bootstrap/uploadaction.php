
<?php
    $mysqli = new mysqli('localhost','e22308557sql','zDLYyP6?','e22308557_db1');
    if ($mysqli->connect_errno) {
    //...
    }
    $uploaddir = '/home/2025DIFAL3/e22308557/public_html/gabarit/documents/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    $uploadpdf = $uploaddir . basename($_FILES['userpdf']['name']);
    echo $uploadfile;
    echo $uploadpdf;
    echo '<pre>';
    //image
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

       

    echo "Le fichier est valide, et a été téléchargé
    avec succès. Voici plus d'informations :\n";
    } else {
    echo "Le fichier n’a pas été téléchargé. Il y a eu un problème !\n";
    }
    echo 'Voici quelques informations sur le téléversement :';
    print_r($_FILES);
    
    //pdf
    if (move_uploaded_file($_FILES['userpdf']['tmp_name'], $uploadpdf)) {

       

    echo "Le fichier pdf est valide, et a été téléchargé
    avec succès. Voici plus d'informations :\n";
    } else {
    echo "Le fichier pdf  n’a pas été téléchargé. Il y a eu un problème !\n";
    }
    echo 'Voici quelques informations sur le téléversement :';
    print_r($_FILES);
    
    //image
    echo $_FILES['userfile']['name'];
    $requete = "UPDATE t_ressource_res SET res_image_url='".$_FILES['userfile']['name']."' WHERE res_id=6;";
    $resultat=$mysqli->query($requete);
      
      if (!$resultat)
      {
       echo " La requête a echoué ...";
      }
      else
      {
        echo " La requête a réussi ...";
      }

      //pdf
      echo $_FILES['userpdf']['name'];
      $requete = "UPDATE t_ressource_res SET res_descriptif='".$_FILES['userpdf']['name']."' WHERE res_id=6;";
      $resultat=$mysqli->query($requete);
        
        if (!$resultat)
        {
         echo " La requête a echoué ...";
        }
        else
        {
          echo " La requête a réussi ...";
        }
  


    $mysqli->close();
?>
