<h2><?php echo "Merci de remplir le formulaire"; ?></h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php echo form_open('/demande/enregistrer'); ?>
    <?= csrf_field() ?>
    
    <div class="mb-3 mt-3">
        <label for="titre" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrez le titre" value="<?= old('titre') ?>">
        <div class="text-danger"><?= validation_show_error('titre') ?></div>
    </div>
    
    <div class="mb-3">
        <label for="contenu" class="form-label">Contenu du message :</label>
        <textarea class="form-control" id="contenu" name="contenu" rows="5" placeholder="Entrez votre message"><?= old('contenu') ?></textarea>
        <div class="text-danger"><?= validation_show_error('contenu') ?></div>
    </div>
    
    <div class="mb-3">
        <label for="mail" class="form-label">Adresse mail :</label>
        <input type="email" class="form-control" id="mail" name="mail" placeholder="exemple@email.com" value="<?= old('mail') ?>">
        <div class="text-danger"><?= validation_show_error('mail') ?></div>
    </div>
    
    <button type="submit" class="btn btn-primary">Envoyer le formulaire</button>
</form>