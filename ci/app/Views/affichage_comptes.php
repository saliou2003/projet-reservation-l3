<div class="container mt-4">
    <!-- Titre et nombre de comptes -->
    <h2><?= $compte ?></h2>
    
    <?php if (isset($nbCompte)): ?>
        <div class="alert alert-info">
            <strong>Nombre total de comptes :</strong> <?= $nbCompte->nbComptes ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            Le nombre de compte est 0 !
        </div>
    <?php endif; ?>
    
    <br>

    <div style="white-space: nowrap;">
             <!-- Boutons d'action -->
            <a href="<?= base_url()?>index.php/compte/creer" 
                class="btn btn-sm btn-info">
                     + invité
             </a>
                                
    </div>

    <br>


    
    <!-- Titre du tableau -->
    <h2><?= $titre ?></h2>
    
    <!-- Tableau des comptes -->
    <?php if (!empty($logins) && is_array($logins)): ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Statut</th>
                        <th scope="col">État</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $compteur = 1; ?>
                    <?php foreach ($logins as $pseudos): ?>
                        <tr>
                            <td><?= $compteur++ ?></td>
                            <td><?= esc($pseudos["cpt_pseudo"]) ?></td>
                            <td><?= esc($pseudos["pfl_nom"]) ?></td>
                            <td><?= esc($pseudos["pfl_prenom"]) ?></td>
                            <td><?= esc($pseudos["pfl_email"]) ?></td>
                            <td><?= esc($pseudos["cpt_role"]) ?></td>
                            <td><?= esc($pseudos["cpt_etat"]) ?></td>
                            <td style="white-space: nowrap;">
                                <!-- Boutons d'action -->
                                <a href="<?= base_url()?>index.php/compte/lister" 
                                   class="btn btn-sm btn-info">
                                    Voir
                                </a>
                                <a href="<?= base_url() ?>index.php/compte/lister" 
                                   class="btn btn-sm btn-warning">
                                    Modifier
                                </a>
                                <a href="<?= base_url() ?>index.php/compte/lister" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    <?php else: ?>
        <div class="alert alert-secondary">
            <h3>Aucun compte pour le moment</h3>
        </div>
    <?php endif; ?>
</div>