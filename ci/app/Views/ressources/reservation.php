<div class="container mt-5">
   
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php echo form_open('/compte/voir_reservation'); ?>
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label for="nom" class="form-label">Veuillez saisir une date:</label>
            <input type="date" 
                   name="date" 
                   class="form-control" 
                   value="<?= set_value('date') ?>">
            <div class="text-danger"><?= validation_show_error('date') ?></div>
        </div>
        
        <button type="submit" class="btn btn-primary">Valider</button>
        
    </form>
</div>