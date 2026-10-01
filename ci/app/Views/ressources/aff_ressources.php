
<br>
   <div class="container mt-4">
        <div style="white-space: nowrap;">
                    <a href="<?= base_url()?>index.php/compte/ajouter_res" 
                        class="btn btn-sm btn-info">
                            + ressource
                    </a>
                                        
            </div>
    </div>
   

<?php    
if (!empty($ressources) && is_array($ressources)) {
?>
<br>
<h2><?= $titre ?></h2>
<br>
<!-- Tableau Bootstrap -->
<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Intitule</th>
            <th>Photo</th>
            <th>Jauge Max</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ressources as $res): ?>
        <tr>
            <td><?= $res["res_nom"] ?></td>
            <td>
                <img src="<?= base_url() ?>bootstrap/documents/<?= $res["res_image_url"] ?>" 
                     alt="<?= $res["res_nom"] ?>" 
                     class="img-thumbnail" 
                     style="max-width: 100px; max-height: 100px;">
            </td>
            <td><?= $res["res_jauge_max"] ?></td>
            <td>
                <a href="<?= base_url() ?>index.php/compte/afficher_les_ressources" 
                   class="btn btn-primary btn-sm">
                    Voir plus
                </a>
            
            
                                <!-- Boutons d'action -->
                    <a href="<?= base_url("index.php/compte/effacer_res/".$res['res_id']) ?>"
                       class="btn btn-sm btn-info">
                                   Supprimer
                    </a>
                                
             </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
} else {
?>
<h2>Pas de ressources disponibles pour le moment !</h2>
<?php
}
?>