<?php
// En-tête du formulaire
echo "<div class='card shadow-sm mb-4'>
        <div class='card-body bg-info text-white'>
            <h2 class='mb-0'>
                <i class='bi bi-reply-fill me-2'></i>
                Veuillez remplir ce champ pour répondre
            </h2>
        </div>
      </div>";

// Message d'erreur flash si présent
if (session()->getFlashdata('error')) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='bi bi-exclamation-circle me-2'></i>
            " . session()->getFlashdata('error') . "
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
          </div>";
}

// Formulaire de réponse
echo "<div class='card shadow-sm'>
        <div class='card-header bg-white'>
            <h4 class='mb-0'>
                <i class='bi bi-pencil-square me-2'></i>
                Formulaire de réponse
            </h4>
        </div>
        <div class='card-body'>";

echo form_open('/compte/repondre/'. $demande->msg_id);
echo csrf_field();

echo "  <div class='mb-3'>
            <label for='reponse' class='form-label'>
                <i class='bi bi-chat-left-text me-1'></i>
                <strong>Réponse :</strong>
            </label>
            <textarea class='form-control' id='reponse' name='reponse' rows='5' placeholder='Saisissez votre réponse ici...'></textarea>";

// Affichage des erreurs de validation
if (validation_show_error('reponse')) {
    echo "<div class='text-danger mt-2'>
            <i class='bi bi-exclamation-triangle me-1'></i>
            " . validation_show_error('reponse') . "
          </div>";
}

echo "  </div>
        <div class='d-grid gap-2'>
            <button type='submit' name='submit' class='btn btn-primary btn-lg'>
                <i class='bi bi-send me-2'></i>
                Envoyer la réponse
            </button>
        </div>
    </form>
        </div>
      </div>";
?>