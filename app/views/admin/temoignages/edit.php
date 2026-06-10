<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-pen-to-square"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Modifiez les informations du témoignage client</p>
        </div>
        <a href="<?= url('admin/temoignages') ?>" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong>Erreur(s) de validation :</strong>
                <ul class="error-list">
                    <?php foreach ($errors as $err): ?>
                        <li><?= e($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-pen-fancy"></i> Informations du Témoignage</h2>
        </div>
        <div class="card-body">
            <form action="<?= url('admin/temoignages/edit/' . $temoignage['id']) ?>" method="POST" enctype="multipart/form-data" class="crud-form">
                
                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="nom_client">
                            <i class="fa-solid fa-user"></i> Nom du Client <span class="required">*</span>
                        </label>
                        <input type="text" 
                                id="nom_client" 
                                name="nom_client" 
                                class="form-control" 
                                value="<?= e($temoignage['nom_client'] ?? '') ?>"
                                maxlength="100"
                                required>
                    </div>

                    <div class="form-group">
                        <label for="fonction_client">
                            <i class="fa-solid fa-briefcase"></i> Fonction / Entreprise
                        </label>
                        <input type="text" 
                                id="fonction_client" 
                                name="fonction_client" 
                                class="form-control" 
                                value="<?= e($temoignage['fonction_client'] ?? '') ?>"
                                maxlength="100">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-group-lg">
                        <label for="message">
                            <i class="fa-solid fa-comment-dots"></i> Message de témoignage <span class="required">*</span>
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  class="form-control form-textarea" 
                                  rows="5"
                                  required><?= e($temoignage['message'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Display existing client avatar if available -->
                <?php if (!empty($temoignage['photo'])): ?>
                    <div class="form-row">
                        <div class="form-group">
                            <span class="current-image-label"><i class="fa-solid fa-circle-info"></i> Avatar actuel :</span>
                            <div class="current-image-preview">
                                <img src="<?= asset('uploads/temoignages/' . e($temoignage['photo'])) ?>" 
                                     alt="<?= e($temoignage['nom_client']) ?>" 
                                     style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-row">
                    <div class="form-group">
                        <label for="photo">
                            <i class="fa-solid fa-camera"></i> Remplacer l'avatar
                        </label>
                        <div class="file-upload-wrapper">
                            <input type="file" 
                                   id="photo" 
                                   name="photo" 
                                   class="file-input"
                                   accept="image/jpeg,image/png,image/webp,image/gif">
                            <label for="photo" class="file-upload-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span class="file-upload-text">Choisir un nouvel avatar</span>
                                <span class="file-upload-hint">Laisser vide pour conserver l'avatar actuel (JPG, PNG, WebP, GIF — Max 2 Mo)</span>
                            </label>
                            <div class="image-preview" id="photoPreview" style="display: none;">
                                <img src="" alt="Aperçu" id="previewImg" style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
                                <button type="button" class="preview-remove" onclick="removePreview()">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="toggle-label">
                            <span><i class="fa-solid fa-eye"></i> Statut</span>
                            <div class="toggle-switch">
                                <input type="checkbox" name="actif" id="actif" value="1" 
                                       <?= $temoignage['actif'] ? 'checked' : '' ?>>
                                <span class="toggle-slider"></span>
                            </div>
                            <span class="toggle-text" id="toggleText"><?= $temoignage['actif'] ? 'Actif' : 'Inactif' ?></span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                    </button>
                    <a href="<?= url('admin/temoignages') ?>" class="btn btn-secondary">
                        <i class="fa-solid fa-ban"></i> Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>
</main>

<script>
// Profile photo preview
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('photoPreview').style.display = 'block';
            document.querySelector('.file-upload-text').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('photo').value = '';
    document.getElementById('photoPreview').style.display = 'none';
    document.querySelector('.file-upload-text').textContent = "Choisir un nouvel avatar";
}

// Toggle switch text
document.getElementById('actif').addEventListener('change', function() {
    document.getElementById('toggleText').textContent = this.checked ? 'Actif' : 'Inactif';
});
</script>

<?php require_once __DIR__ . '/../../layouts/admin_footer.php'; ?>
