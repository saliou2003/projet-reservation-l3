<div class="container mt-5">
    <h2 class="mb-4">📅 Réservations du <?= date('d/m/Y', strtotime($date_choisie['date'] ?? $date_choisie)) ?></h2>
    
    <?php if (empty($par_ressource)): ?>
        <div class="alert alert-info">
            <h4>❌ Aucune réservation pour cette date !</h4>
        </div>
    <?php else: ?>
        <?php foreach ($par_ressource as $nom_ressource => $reservations): ?>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>🏟️⚽ <?= esc($nom_ressource) ?></h4>
                </div>
                <div class="card-body">
                    <?php foreach ($reservations as $reservation): ?>
                        <div class="border-bottom mb-3 pb-3">
                            <p><strong>📝 Nom :</strong> <?= esc($reservation->rsv_nom) ?></p>
                            <p><strong>⏰ Date :</strong> <?= date('d/m/Y à H:i', strtotime($reservation->rsv_date)) ?></p>
                            <p>
                                <strong>👥 Participants :</strong><br>
                                <?= !empty($reservation->participants) ? esc($reservation->participants) : 'Aucun participant' ?>
                            </p>
                            
                            <?php if (strtotime($reservation->rsv_date) < time() && ($reservation->rsv_bilan) != 'En attente'): ?>
                                <div class="alert alert-info mt-2">
                                    <strong>📊 Bilan :</strong>
                                    <p><?= nl2br(esc($reservation->rsv_bilan)) ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    
</div>