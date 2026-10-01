<h2>Espace d'administration</h2>
<?php
$session = session();

// Affichage du message
if (!empty($le_message)) {
    echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            <i class='bi bi-info-circle me-2'></i>
           <h2>
                $le_message
            </h2>    
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
          </div>";
}

// Affichage de l'utilisateur
echo "<div class='card shadow-sm mb-4'>
        <div class='card-body bg-primary text-white'>
            <h2 class='mb-0'>
                <i class='bi bi-person-circle me-2'></i>
                " . $session->get('user') . "
            </h2>
        </div>
      </div>";

// Tableau du profil
echo "<div class='card shadow-sm'>
        <div class='card-header bg-white'>
            <h4 class='mb-0'>
                <i class='bi bi-person-vcard me-2'></i>
                Informations personnelles
            </h4>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-hover table-striped align-middle'>
                    <thead class='table-dark'>
                        <tr>
                            <th scope='col'><i class='bi bi-person-badge me-1'></i> PSEUDO</th>
                            <th scope='col'><i class='bi bi-person me-1'></i> NOM</th>
                            <th scope='col'><i class='bi bi-person-fill me-1'></i> PRÉNOM</th>
                            <th scope='col'><i class='bi bi-calendar-event me-1'></i> DATE DE NAISSANCE</th>
                            <th scope='col'><i class='bi bi-telephone me-1'></i> TÉL</th>
                            <th scope='col'><i class='bi bi-envelope me-1'></i> EMAIL</th>
                            <th scope='col'><i class='bi bi-geo-alt me-1'></i> ADRESSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='fw-bold text-primary'>$profil->cpt_pseudo</td>
                            <td>$profil->pfl_nom</td>
                            <td>$profil->pfl_prenom</td>
                            <td><span class='badge bg-info text-dark'>$profil->pfl_date_naissance</span></td>
                            <td>$profil->pfl_tel</td>
                            <td>$profil->pfl_email</td>
                            <td>$profil->pfl_adress</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>";
?>