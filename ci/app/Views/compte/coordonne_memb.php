<div class="container mt-4">
    
    <!-- Titre du tableau -->
    <h2><?= $titre ?></h2>
    
    <!-- Tableau des comptes -->
    <?php if (!empty($contacts) && is_array($contacts)): ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Telephone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $compteur = 1; ?>
                    <?php foreach ($contacts as $ctc): ?>
                        <tr>
                            <td><?= $compteur++ ?></td>
                            <td><?= esc($ctc["pfl_nom"]) ?></td>
                            <td><?= esc($ctc["pfl_prenom"]) ?></td>
                            <td><?= esc($ctc["pfl_email"]) ?></td>
                            <td><?= esc($ctc["pfl_tel"]) ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    <?php else: ?>
        <div class="alert alert-secondary">
            <h3>Aucun membre pour le moment</h3>
        </div>
    <?php endif; ?>
</div>