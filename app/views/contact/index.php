<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- Hero banner for Contact -->
<section class="contact-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 60px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center;">
    <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container">
        <h1 style="font-size: 38px; font-weight: 700; color: var(--white); margin-bottom: 10px;">Contactez <span style="color: var(--primary-color);">MD Design</span></h1>
        <p style="font-size: 16px; color: var(--text-secondary); max-width: 600px; margin: 0 auto;">Une idée ? Un projet publicitaire ? Discutons de vos besoins ou demandez un devis en quelques clics.</p>
    </div>
</section>

<section class="contact-section" style="padding: 60px 0; background-color: var(--light-grey);">
    <div class="container">
        
        <?php
        // Retrieve and display flash messages
        $session = new Session();
        $flashSuccess = $session->get('flash_success');
        if ($flashSuccess) { $session->remove('flash_success'); }
        ?>

        <?php if ($flashSuccess): ?>
            <div class="alert alert-success" style="max-width: 900px; margin: 0 auto 30px;">
                <i class="fa-solid fa-circle-check"></i>
                <span><?= e($flashSuccess) ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error" style="max-width: 900px; margin: 0 auto 30px;">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                    <strong>Erreur(s) lors de la validation :</strong>
                    <ul class="error-list">
                        <?php foreach ($errors as $err): ?>
                            <li><?= e($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="contact-grid" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 40px; max-width: 1100px; margin: 0 auto;">
            
            <!-- Left Column: Contact Form -->
            <div class="contact-form-card" style="background: var(--white); border-radius: var(--radius-lg); padding: 36px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.04);">
                <h2 style="font-size: 22px; font-weight: 600; color: var(--dark); margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-paper-plane" style="color: var(--primary-color);"></i> Envoyer un message
                </h2>
                
                <form action="<?= url('contact/submit') ?>" method="POST">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label for="nom_complet" style="font-weight: 500; font-size: 14px; margin-bottom: 8px; color: #555; display: block;">
                                Nom Complet <span class="required" style="color: var(--error);">*</span>
                            </label>
                            <input type="text" id="nom_complet" name="nom_complet" class="form-control" style="background: #fdfdfd; border: 1px solid #ddd; border-radius: var(--radius-md); padding: 12px 16px; color: var(--dark); outline: none; transition: border 0.3s; font-size: 14px; font-family: var(--font-main);" placeholder="Votre nom et prénom" value="<?= e($old['nom_complet'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="telephone" style="font-weight: 500; font-size: 14px; margin-bottom: 8px; color: #555; display: block;">
                                Téléphone
                            </label>
                            <input type="tel" id="telephone" name="telephone" class="form-control" style="background: #fdfdfd; border: 1px solid #ddd; border-radius: var(--radius-md); padding: 12px 16px; color: var(--dark); outline: none; transition: border 0.3s; font-size: 14px; font-family: var(--font-main);" placeholder="Ex: +212 600 000000" value="<?= e($old['telephone'] ?? '') ?>">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label for="email" style="font-weight: 500; font-size: 14px; margin-bottom: 8px; color: #555; display: block;">
                                Adresse Email <span class="required" style="color: var(--error);">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-control" style="background: #fdfdfd; border: 1px solid #ddd; border-radius: var(--radius-md); padding: 12px 16px; color: var(--dark); outline: none; transition: border 0.3s; font-size: 14px; font-family: var(--font-main);" placeholder="votre@email.com" value="<?= e($old['email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label for="sujet" style="font-weight: 500; font-size: 14px; margin-bottom: 8px; color: #555; display: block;">
                                Sujet <span class="required" style="color: var(--error);">*</span>
                            </label>
                            <input type="text" id="sujet" name="sujet" class="form-control" style="background: #fdfdfd; border: 1px solid #ddd; border-radius: var(--radius-md); padding: 12px 16px; color: var(--dark); outline: none; transition: border 0.3s; font-size: 14px; font-family: var(--font-main);" placeholder="Ex: Demande de devis enseigne" value="<?= e($old['sujet'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 24px;">
                        <div class="form-group">
                            <label for="message" style="font-weight: 500; font-size: 14px; margin-bottom: 8px; color: #555; display: block;">
                                Message <span class="required" style="color: var(--error);">*</span>
                            </label>
                            <textarea id="message" name="message" class="form-control form-textarea" style="background: #fdfdfd; border: 1px solid #ddd; border-radius: var(--radius-md); padding: 12px 16px; color: var(--dark); outline: none; transition: border 0.3s; font-size: 14px; font-family: var(--font-main); resize: vertical; min-height: 140px; line-height: 1.6;" placeholder="Rédigez votre demande en détail..." required><?= e($old['message'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding: 13px 30px; font-size: 15px; font-weight: 600; width: 100%;">
                        <i class="fa-solid fa-paper-plane"></i> Envoyer le Message
                    </button>
                </form>
            </div>

            <!-- Right Column: Corporate Coordinates & Google Maps -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                
                <!-- Contact info card -->
                <div class="contact-info-card" style="background: var(--dark-card); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--dark-border); color: var(--white);">
                    <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: var(--white); display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-headset" style="color: var(--primary-color);"></i> Nos Coordonnées
                    </h2>
                    
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 20px;">
                        <li style="display: flex; gap: 14px; align-items: flex-start;">
                            <i class="fa-solid fa-map-location-dot" style="color: var(--primary-color); font-size: 18px; margin-top: 3px;"></i>
                            <div>
                                <strong style="display: block; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Adresse</strong>
                                <span style="font-size: 14.5px; color: var(--text-secondary);"><?= e($corporateInfo['adresse'] ?? 'Tanger, Maroc') ?></span>
                            </div>
                        </li>
                        <li style="display: flex; gap: 14px; align-items: flex-start;">
                            <i class="fa-solid fa-phone" style="color: var(--primary-color); font-size: 18px; margin-top: 3px;"></i>
                            <div>
                                <strong style="display: block; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Téléphone</strong>
                                <span style="font-size: 14.5px; color: var(--text-secondary);"><?= e($corporateInfo['telephone'] ?? '+212 600 000000') ?></span>
                            </div>
                        </li>
                        <li style="display: flex; gap: 14px; align-items: flex-start;">
                            <i class="fa-solid fa-envelope" style="color: var(--primary-color); font-size: 18px; margin-top: 3px;"></i>
                            <div>
                                <strong style="display: block; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Email</strong>
                                <span style="font-size: 14.5px; color: var(--text-secondary);"><?= e($corporateInfo['email'] ?? 'contact@mddesign.ma') ?></span>
                            </div>
                        </li>
                    </ul>

                    <?php if (!empty($corporateInfo['whatsapp'])): ?>
                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--dark-border);">
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $corporateInfo['whatsapp']) ?>" target="_blank" class="btn btn-whatsapp" style="display: flex; width: 100%; padding: 12px; font-size: 14.5px;">
                                <i class="fa-brands fa-whatsapp" style="font-size: 18px;"></i> WhatsApp Devis
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Google Maps Card -->
                <?php if (!empty($corporateInfo['google_maps_url'])): ?>
                    <div class="card" style="border-radius: var(--radius-lg); overflow: hidden; height: 260px; border: 1px solid var(--dark-border); background: var(--dark-card);">
                        <iframe 
                            src="<?= $corporateInfo['google_maps_url'] ?>" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>

<!-- Custom Styling for input focus in public page -->
<style>
.form-control:focus {
    border-color: var(--primary-color) !important;
    box-shadow: 0 0 0 3px var(--primary-light) !important;
    background: #fff !important;
}
@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
