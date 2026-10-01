<h1><?php echo $titre;?></h1><br />
<?php
    if (isset($demande)){
        


        echo"<table class='table table-hover'>
            <thead>
            <tr>
              
                <th scope='col'>ID</th>
                <th scope='col'>Titre</th>
                <th scope='col'>Qestion</th>
                <th scope='col'>Réponse</th>
                <th scope='col'>Email</th>
                <th scope='col'>Date d'envoi</th>
                <th scope='col'>Code</th>
            </tr>
            </thead>
            <tbody>
            <tr>
               
                <td>"."$demande->msg_id"."</td>
                <td>"."$demande->msg_titre"."</td>
                <td>"."$demande->msg_contenu"."</td>
                <td>"."$demande->msg_reponse"."</td>
                <td>"."$demande->msg_email"."</td>
                <td>"."$demande->msg_date"."</td>
                <td>"."$demande->msg_code"."</td>
            </tr>
           
            </tbody>
         </table>";


    }
    else {
      echo "<h2>Code incorrect !</h2>";
    }
?>