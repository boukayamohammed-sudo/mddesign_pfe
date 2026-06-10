<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-gears"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Configurez les coordonnées de l'agence, l'identité visuelle et les réseaux sociaux</p>
        </div>
    </div>

    <?php
    $session = new Session();
    $flashSuccess = $session->get('flash_success');
    $flashError = $session->get('flash_error');
    if ($flashSuccess) { $session->remove('flash_success'); }
    if ($flashError) { $session->remove('flash_error'); }
    ?>

    <?php if ($flashSuccess): ?>
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span><?= e($flashSuccess) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($flashError): ?>
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span><?= e($flashError) ?></span>
        </div>
    <?php endif; ?>

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
            <h2 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Informations de l'Agence</h2>
        </div>
        <div class="card-body">
            <form action="<?= url('admin/parametres/update') ?>" method="POST" enctype="multipart/form-data" class="crud-form" style="max-width: 850px;">
                
                <!-- Section 1: Général -->
                <h3 style="font-size: 16px; color: var(--primary-color); margin-bottom: 16px; border-bottom: 1px solid var(--dark-border); padding-bottom: 8px;">
                    <i class="fa-solid fa-circle-info"></i> Profil de l'agence
                </h3>
                
                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="nom_agence">
                            <i class="fa-solid fa-building"></i> Nom de l'agence <span class="required">*</span>
                        </label>
                        <input type="text" 
                               id="nom_agence" 
                               name="nom_agence" 
                               class="form-control" 
                               value="<?= e($settings['nom_agence'] ?? '') ?>"
                               maxlength="100"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fa-solid fa-envelope"></i> Adresse Email
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control" 
                               value="<?= e($settings['email'] ?? '') ?>"
                               maxlength="100">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-group-lg">
                        <label for="description_agence">
                            <i class="fa-solid fa-quote-left"></i> Description de l'agence (À propos)
                        </label>
                        <textarea id="description_agence" 
                                  name="description_agence" 
                                  class="form-control form-textarea" 
                                  placeholder="Décrivez l'activité principale de l'agence..."
                                  rows="3"><?= e($settings['description_agence'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Section 2: Contact -->
                <h3 style="font-size: 16px; color: var(--primary-color); margin-top: 32px; margin-bottom: 16px; border-bottom: 1px solid var(--dark-border); padding-bottom: 8px;">
                    <i class="fa-solid fa-phone"></i> Contacts & Adresses
                </h3>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="telephone">
                            <i class="fa-solid fa-phone"></i> Numéro de téléphone
                        </label>
                        <input type="text" 
                               id="telephone" 
                               name="telephone" 
                               class="form-control" 
                               placeholder="Ex: +212 600 000000"
                               value="<?= e($settings['telephone'] ?? '') ?>"
                               maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="whatsapp">
                            <i class="fa-brands fa-whatsapp"></i> Numéro WhatsApp (uniquement chiffres avec code pays)
                        </label>
                        <input type="text" 
                               id="whatsapp" 
                               name="whatsapp" 
                               class="form-control" 
                               placeholder="Ex: 212600000000"
                               value="<?= e($settings['whatsapp'] ?? '') ?>"
                               maxlength="20">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-group-lg">
                        <label for="adresse">
                            <i class="fa-solid fa-map-location-dot"></i> Adresse physique
                        </label>
                        <textarea id="adresse" 
                                  name="adresse" 
                                  class="form-control form-textarea" 
                                  placeholder="Ex: Rue de la Liberté, Tanger, Maroc..."
                                  rows="2"><?= e($settings['adresse'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Section 3: Social & Cartes -->
                <h3 style="font-size: 16px; color: var(--primary-color); margin-top: 32px; margin-bottom: 16px; border-bottom: 1px solid var(--dark-border); padding-bottom: 8px;">
                    <i class="fa-solid fa-share-nodes"></i> Réseaux sociaux & Localisation
                </h3>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="facebook">
                            <i class="fa-brands fa-facebook"></i> Page Facebook (Lien complet)
                        </label>
                        <input type="url" 
                               id="facebook" 
                               name="facebook" 
                               class="form-control" 
                               placeholder="https://facebook.com/votrepage"
                               value="<?= e($settings['facebook'] ?? '') ?>"
                               maxlength="255">
                    </div>

                    <div class="form-group">
                        <label for="instagram">
                            <i class="fa-brands fa-instagram"></i> Page Instagram (Lien complet)
                        </label>
                        <input type="url" 
                               id="instagram" 
                               name="instagram" 
                               class="form-control" 
                               placeholder="https://instagram.com/votrepage"
                               value="<?= e($settings['instagram'] ?? '') ?>"
                               maxlength="255">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-group-lg">
                        <label for="google_maps_url">
                            <i class="fa-solid fa-map"></i> URL d'intégration Google Maps (Lien d'intégration iframe `src` ou lien direct)
                        </label>
                        <textarea id="google_maps_url" 
                                  name="google_maps_url" 
                                  class="form-control form-textarea" 
                                  placeholder="Saisissez le lien src de l'intégration Google Maps..."
                                  rows="2"><?= e($settings['google_maps_url'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Section 4: Identité Visuelle -->
                <h3 style="font-size: 16px; color: var(--primary-color); margin-top: 32px; margin-bottom: 16px; border-bottom: 1px solid var(--dark-border); padding-bottom: 8px;">
                    <i class="fa-solid fa-image"></i> Identité visuelle (Logo)
                </h3>

                <?php if (!empty($settings['logo'])): ?>
                    <div class="form-row">
                        <div class="form-group">
                            <span class="current-image-label"><i class="fa-solid fa-circle-info"></i> Logo actuel :</span>
                            <div class="current-image-preview">
                                <img src="<?= asset('uploads/logos/' . e($settings['logo'])) ?>" 
                                     alt="<?= e($settings['nom_agence']) ?>" 
                                     style="max-width: 180px; max-height: 80px; object-fit: contain; background: #242424; padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--dark-border);">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-row">
                    <div class="form-group">
                        <label for="logo">
                            <i class="fa-solid fa-camera"></i> Télécharger un nouveau logo
                        </label>
                        <div class="file-upload-wrapper">
                            <input type="file" 
                                   id="logo" 
                                   name="logo" 
                                   class="file-input"
                                   accept="image/jpeg,image/png,image/webp,image/gif">
                            <label for="logo" class="file-upload-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span class="file-upload-text">Choisir un fichier logo</span>
                                <span class="file-upload-hint">Format accepté : JPG, PNG, WebP, GIF — Max 5 Mo</span>
                            </label>
                            <div class="image-preview" id="logoPreview" style="display: none;">
                                <img src="" alt="Aperçu" id="previewImg" style="max-width: 180px; max-height: 80px; object-fit: contain; background: #242424; padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--dark-border);">
                                <button type="button" class="preview-remove" onclick="removePreview()">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 32px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Enregistrer les paramètres
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

<script>
// Logo preview logic
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('logoPreview').style.display = 'block';
            document.querySelector('.file-upload-text').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('logo').value = '';
    document.getElementById('logoPreview').style.display = 'none';
    document.querySelector('.file-upload-text').textContent = 'Choisir un fichier logo';
}
</script>

<?php require_once __DIR__ . '/../../layouts/admin_footer.php'; ?>
