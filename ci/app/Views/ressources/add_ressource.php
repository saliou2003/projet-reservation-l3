<div class="container mt-5">
    <h2 class="mb-4"><?= $titre ?></h2>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php echo form_open('/compte/ajouter_res'); ?>
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom ressource:</label>
            <input type="text" 
                   name="nom" 
                   class="form-control" 
                   value="<?= set_value('nom') ?>">
            <div class="text-danger"><?= validation_show_error('nom') ?></div>
        </div>
        
        <div class="mb-3">
            <label for="jauge" class="form-label">Nombre Max :</label>
            <input type="text" 
                   name="jauge" 
                   class="form-control">
            <div class="text-danger"><?= validation_show_error('jauge') ?></div>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter une ressource</button>
        
    </form>
</div>