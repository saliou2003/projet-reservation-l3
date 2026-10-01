<h2><?php echo "Merci de renseigner votre code "; ?></h2>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Vérification du code</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo form_open('/demande/verifier'); ?>
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="code" class="form-label">Code de suivi :</label>
                            <input type="text" class="form-control form-control-lg" id="code" name="code" placeholder="XXXXXXXXXXXXXXXXXXXX" maxlength="20" value="<?= old('code') ?>" style="letter-spacing: 2px; font-family: monospace;">
                            <div class="text-danger mt-2"><?= validation_show_error('code') ?></div>
                            <small class="form-text text-muted">Entrez le code de 20 caractères reçu par email.</small>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-search"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>