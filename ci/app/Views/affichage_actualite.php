<h1><?php echo $titre;?></h1><br />
<?php
    if (isset($news)){
        


        echo"<table class='table table-hover'>
            <thead>
            <tr>
              
                <th scope='col'>ID</th>
                <th scope='col'>Titre</th>
                <th scope='col'>Contenu</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              
                <td>"."$news->act_id"."</td>
                <td>"."$news->act_titre"."</td>
                <td>"."$news->act_contenu"."</td>
            </tr>
           
            </tbody>
         </table>";


    }
    else {
      echo "<h2> Pas d'actualité pour le moment! </h2";
    }
?>