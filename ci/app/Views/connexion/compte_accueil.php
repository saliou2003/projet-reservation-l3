<div class="container-fluid mt-4">
    
    <!-- Bannière d'accueil -->
    <div class="row mb-4">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h2 class="text-white mb-0">
                        Espace <?php echo $espace ; ?>
                    </h2>
                </div>
                <div class="card-body bg-light">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">
                                👋 Bienvenue, 
                                <strong class="text-primary">
                                    <?php
                                    $session = session();
                                    echo $session->get('user'); 
                                    ?>
                                </strong>
                            </h4>
                            <p class="text-muted mb-0">
                                <small>Session ouverte</small>
                            </p>
                        </div>
                        <div>
                            <span class="badge bg-success fs-6">Connecté</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Message informatif -->
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div><?= $message ?></div>
    </div>
    
    <!-- Section réservations -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="mb-0">📋 Mes réservations</h3>
        </div>
        <div class="card-body p-0">
            
            <?php if (!empty($reservations) && is_array($reservations)): ?>
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">
                                    <i class="bi bi-calendar"></i> Date
                                </th>
                                <th scope="col">
                                    <i class="bi bi-file-text"></i> participants
                                    
                                </th>
                                
                                <th scope="col">
                                    <i class="bi bi-file-text"></i> Ressource réservée
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $res): ?>
                                <tr>
                                    <td class="fw-semibold">
                                        <?= esc($res["rsv_date"]) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <?= esc($res["participants"]) ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold">
                                        <?= esc($res["ressource_nom"]) ?>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            <?php else: ?>
                
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                    </div>
                    <h4 class="text-muted">Pas de réservations pour le moment !</h4>
                    <p class="text-muted">
                        Vos futures réservations apparaîtront ici.
                    </p>
                </div>
                
            <?php endif; ?>
            
        </div>
    </div>
    
</div>