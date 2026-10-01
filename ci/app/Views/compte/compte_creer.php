<div class="container mt-5">
    <h2 class="mb-4"><?= $titre ?></h2>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php echo form_open('/compte/creer'); ?>
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo :</label>
            <input type="text" 
                   name="pseudo" 
                   class="form-control" 
                   value="<?= set_value('pseudo') ?>">
            <div class="text-danger"><?= validation_show_error('pseudo') ?></div>
        </div>
        
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe :</label>
            <input type="password" 
                   name="mdp" 
                   class="form-control">
            <div class="text-danger"><?= validation_show_error('mdp') ?></div>
        </div>
        
        <button type="submit" class="btn btn-primary">Créer un nouveau compte</button>
        
    </form>
</div>