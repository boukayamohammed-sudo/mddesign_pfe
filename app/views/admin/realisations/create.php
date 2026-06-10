<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-plus-circle"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Ajoutez un nouveau projet à votre galerie de réalisations</p>
        </div>
        <a href="<?= url('admin/realisations') ?>" class="btn btn-secondary">
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
            <h2 class="card-title"><i class="fa-solid fa-pen-fancy"></i> Informations de la Réalisation</h2>
        </div>
        <div class="card-body">
            <form action="<?= url('admin/realisations/create') ?>" method="POST" enctype="multipart/form-data" class="crud-form">
                
                <div class="form-row">
                    <div class="form-group form-group-lg">
                        <label for="titre">
                            <i class="fa-solid fa-tag"></i> Titre du Projet <span class="required">*</span>
                        </label>
                        <input type="text" 
                                id="titre" 
                                name="titre" 
                                class="form-control" 
                                placeholder="Ex: Covering Audi R8 Noir Mat" 
                                value="<?= e($old['titre'] ?? '') ?>"
                                maxlength="100"
                                required>
                    </div>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="id_service">
                            <i class="fa-solid fa-layer-group"></i> Service Associé <span class="required">*</span>
                        </label>
                        <select id="id_service" name="id_service" class="form-control" required>
                            <option value="">-- Sélectionner un Service --</option>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= $service['id'] ?>" <?= (isset($old['id_service']) && $old['id_service'] == $service['id']) ? 'selected' : '' ?>>
                                    <?= e($service['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_realisation">
                            <i class="fa-solid fa-calendar-days"></i> Date de Réalisation
                        </label>
                        <input type="date" 
                               id="date_realisation" 
                               name="date_realisation" 
                               class="form-control" 
                               value="<?= e($old['date_realisation'] ?? date('Y-m-d')) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-group-lg">
                        <label for="description">
                            <i class="fa-solid fa-align-left"></i> Description / Détails du projet
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-control form-textarea" 
                                  placeholder="Décrivez les détails de la réalisation (matériaux utilisés, durée, etc.)..."
                                  rows="5"><?= e($old['description'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="image">
                            <i class="fa-solid fa-camera"></i> Image du Projet <span class="required">*</span>
                        </label>
                        <div class="file-upload-wrapper">
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   class="file-input"
                                   accept="image/jpeg,image/png,image/webp,image/gif"
                                   required>
                            <label for="image" class="file-upload-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span class="file-upload-text">Choisir une image</span>
                                <span class="file-upload-hint">JPG, PNG, WebP, GIF — Max 5 Mo</span>
                            </label>
                            <div class="image-preview" id="imagePreview" style="display: none;">
                                <img src="" alt="Aperçu" id="previewImg">
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
                                       <?= (!isset($old['actif']) || $old['actif']) ? 'checked' : '' ?>>
                                <span class="toggle-slider"></span>
                            </div>
                            <span class="toggle-text" id="toggleText">Actif</span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                    </button>
                    <a href="<?= url('admin/realisations') ?>" class="btn btn-secondary">
                        <i class="fa-solid fa-ban"></i> Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>
</main>

<script>
// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.querySelector('.file-upload-text').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.querySelector('.file-upload-text').textContent = 'Choisir une image';
}

// Toggle switch text
document.getElementById('actif').addEventListener('change', function() {
    document.getElementById('toggleText').textContent = this.checked ? 'Actif' : 'Inactif';
});
</script>

<?php require_once __DIR__ . '/../../layouts/admin_footer.php'; ?>
