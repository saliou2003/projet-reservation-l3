<?php
// Vérifier si on a des questions à afficher
if (!empty($questions) && is_array($questions)) {
    ?>
    
    <br>
    <h2><?= $titre ?></h2>
    <br>
    
    <!-- Tableau Bootstrap -->
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Titre</th>
                <th>Question</th>
                <th>Statut</th>
                <th>Email</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $quest): ?>
                <tr>
                    
                    <td><?= $quest["msg_titre"] ?></td>
                    
                    <!-- Colonne 2 : Question (tronquée à 50 caractères) -->
                    <td><?= substr($quest["msg_contenu"], 0, 50) ?>...</td>
                    
                    <!-- Colonne 3 : Statut avec badge -->
                    <td>
                        <?php if (empty($quest["msg_reponse"])): ?>
                            <!-- Pas encore de réponse -->
                            <span class="badge bg-warning">En attente</span>
                        <?php else: ?>
                            <!-- Déjà répondu -->
                            <span class="badge bg-success">Répondu</span>
                        <?php endif; ?>
                    </td>
                    
                    
                    <td><?= $quest["msg_email"] ?></td>
                    
                    
                    <td><?= $quest["msg_date"] ?></td>
                    
                    <!-- Colonne 6 : Boutons d'action -->
                    <td>
                        <?php if (empty($quest["msg_reponse"])): ?>
                            <!-- Si pas de réponse : bouton Répondre -->
                            <a href="<?= base_url('index.php/compte/afficher_msg/' . $quest['msg_id']) ?>" 
                               class="btn btn-primary btn-sm">
                                Répondre
                            </a>
                        <?php else: ?>
                            <!-- Si déjà répondu : bouton Voir -->
                            <a href="<?= base_url('index.php/compte/afficher_msg/' . $quest['msg_id']) ?>" 
                                class="btn btn-primary btn-sm">
                                Voir plus
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
<?php
} else {
    // Aucune question trouvée
    ?>
    <h2>Pas de demandes pour le moment !</h2>
    <?php
}
?>