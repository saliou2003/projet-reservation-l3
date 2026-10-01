<?php
// En-tête avec titre
echo "<div class='card shadow-sm mb-4'>
        <div class='card-body bg-primary text-white'>
            <h1 class='mb-0'>
                <i class='bi bi-envelope-open me-2'></i>
                $titre
            </h1>
        </div>
      </div>";

if (isset($demande)) {
    echo "<div class='card shadow-sm'>
            <div class='card-header bg-white'>
                <h4 class='mb-0'>
                    <i class='bi bi-chat-left-text me-2'></i>
                    Détails de la demande
                </h4>
            </div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-hover table-striped align-middle'>
                        <thead class='table-dark'>
                            <tr>
                                <th scope='col'><i class='bi bi-tag me-1'></i> TITRE</th>
                                <th scope='col'><i class='bi bi-question-circle me-1'></i> QUESTION</th>
                                <th scope='col'><i class='bi bi-reply me-1'></i> RÉPONSE</th>
                                <th scope='col'><i class='bi bi-envelope me-1'></i> EMAIL</th>
                                <th scope='col'><i class='bi bi-calendar-date me-1'></i> DATE D'ENVOI</th>
                                <th scope='col'><i class='bi bi-person-badge me-1'></i> CORRESPONDANT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='fw-bold text-primary'>$demande->msg_titre</td>
                                <td>$demande->msg_contenu</td>
                                <td>" . (!empty($demande->msg_reponse) ? "<span class='badge bg-success'>$demande->msg_reponse</span>" : "<span class='badge bg-warning text-dark'>En attente</span>") . "</td>
                                <td>$demande->msg_email</td>
                                <td><span class='badge bg-info text-dark'>$demande->msg_date</span></td>
                                <td><span class='badge bg-secondary'>$demande->cpt_pseudo</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>";
} else {
    echo "<div class='alert alert-warning d-flex align-items-center' role='alert'>
            <i class='bi bi-exclamation-triangle-fill me-2 fs-4'></i>
            <div>
                <strong>Aucune demande trouvée !</strong>
                <p class='mb-0'>Pas de réponse disponible pour le moment.</p>
            </div>
          </div>";
}
?>