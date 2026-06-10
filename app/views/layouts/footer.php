    <?php
    // Fetch corporate configurations for the footer
    $corporateInfo = settings();
    $whatsapp_num = $corporateInfo['whatsapp'] ?? '212600000000';
    $whatsapp_clean = preg_replace('/[^0-9]/', '', $whatsapp_num);
    $whatsapp_url = "https://wa.me/" . $whatsapp_clean;
    ?>

    <!-- Main Footer -->
    <footer class="public-footer" style="background: #1F1F1F; color: var(--text-secondary); padding: 60px 0 30px; border-top: 3px solid var(--primary-color); font-family: var(--font-main);">
        <div class="container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            
            <!-- Column 1: About Agency -->
            <div class="footer-col">
                <a href="<?= url('/') ?>" style="font-size: 24px; font-weight: 700; color: var(--white); text-decoration: none; display: inline-block; margin-bottom: 20px;">
                    MD <span style="color: var(--primary-color);">Design</span>
                </a>
                <p style="font-size: 14px; line-height: 1.6; margin-bottom: 20px; color: var(--text-muted);">
                    <?= e($corporateInfo['description_agence'] ?? 'Votre agence publicitaire leader à Tanger. Marquage publicitaire, covering automobile, enseignes et signalétiques.') ?>
                </p>
                <?php if (!empty($corporateInfo['logo'])): ?>
                    <img src="<?= asset('uploads/logos/' . e($corporateInfo['logo'])) ?>" alt="Logo" style="max-height: 45px; object-fit: contain; filter: brightness(0) invert(1); opacity: 0.8;">
                <?php endif; ?>
            </div>

            <!-- Column 2: Navigation -->
            <div class="footer-col">
                <h4 style="color: var(--white); font-size: 16px; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid var(--primary-color); padding-left: 10px;">Liens Utiles</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; font-size: 14.5px;">
                    <li><a href="<?= url('/') ?>" style="color: var(--text-secondary); text-decoration: none; transition: color 0.3s;">Accueil</a></li>
                    <li><a href="<?= url('services') ?>" style="color: var(--text-secondary); text-decoration: none; transition: color 0.3s;">Nos Services</a></li>
                    <li><a href="<?= url('realisations') ?>" style="color: var(--text-secondary); text-decoration: none; transition: color 0.3s;">Réalisations</a></li>
                    <li><a href="<?= url('about') ?>" style="color: var(--text-secondary); text-decoration: none; transition: color 0.3s;">À Propos</a></li>
                    <li><a href="<?= url('contact') ?>" style="color: var(--text-secondary); text-decoration: none; transition: color 0.3s;">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Contact Info -->
            <div class="footer-col">
                <h4 style="color: var(--white); font-size: 16px; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid var(--primary-color); padding-left: 10px;">Contact</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
                    <li style="display: flex; gap: 10px; align-items: flex-start;">
                        <i class="fa-solid fa-map-marker-alt" style="color: var(--primary-color); font-size: 15px; margin-top: 3px;"></i>
                        <span><?= e($corporateInfo['adresse'] ?? 'Rue de la Liberté, Tanger, Maroc') ?></span>
                    </li>
                    <li style="display: flex; gap: 10px; align-items: center;">
                        <i class="fa-solid fa-phone" style="color: var(--primary-color); font-size: 14px;"></i>
                        <span><?= e($corporateInfo['telephone'] ?? '+212 600 000000') ?></span>
                    </li>
                    <li style="display: flex; gap: 10px; align-items: center;">
                        <i class="fa-solid fa-envelope" style="color: var(--primary-color); font-size: 14px;"></i>
                        <span style="word-break: break-all;"><?= e($corporateInfo['email'] ?? 'contact@mddesign.ma') ?></span>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Hours & Socials -->
            <div class="footer-col">
                <h4 style="color: var(--white); font-size: 16px; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid var(--primary-color); padding-left: 10px;">Horaires & Socials</h4>
                <p style="font-size: 14px; margin-bottom: 15px; line-height: 1.5; color: var(--text-muted);">
                    Lundi - Vendredi : 09:00 - 18:30<br>
                    Samedi : 09:00 - 14:00
                </p>
                <div style="display: flex; gap: 12px; margin-top: 15px;">
                    <?php if (!empty($corporateInfo['facebook'])): ?>
                        <a href="<?= e($corporateInfo['facebook']) ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #2c2c2c; color: var(--white); font-size: 16px; text-decoration: none; transition: background 0.3s, color 0.3s;" onmouseover="this.style.background='var(--primary-color)'" onmouseout="this.style.background='#2c2c2c'">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($corporateInfo['instagram'])): ?>
                        <a href="<?= e($corporateInfo['instagram']) ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #2c2c2c; color: var(--white); font-size: 16px; text-decoration: none; transition: background 0.3s, color 0.3s;" onmouseover="this.style.background='var(--primary-color)'" onmouseout="this.style.background='#2c2c2c'">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <a href="<?= $whatsapp_url ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #2c2c2c; color: var(--white); font-size: 16px; text-decoration: none; transition: background 0.3s, color 0.3s;" onmouseover="this.style.background='#25D366'" onmouseout="this.style.background='#2c2c2c'">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

        </div>
        
        <!-- Bottom copyright -->
        <div style="max-width: 1200px; margin: 40px auto 0; padding: 20px 20px 0; border-top: 1px solid var(--dark-border); text-align: center; font-size: 13px; color: var(--text-muted);">
            <p>&copy; <?= date('Y') ?> <?= e($corporateInfo['nom_agence'] ?? 'MD Design') ?>. Tous droits réservés. Conçu à Tanger.</p>
        </div>
    </footer>

    <!-- Floating WhatsApp CTA Button -->
    <a href="<?= $whatsapp_url ?>" target="_blank" class="floating-whatsapp" style="position: fixed; bottom: 30px; right: 30px; background-color: #25D366; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.25); z-index: 999; transition: transform 0.3s, background-color 0.3s; text-decoration: none;" onmouseover="this.style.transform='scale(1.1)';this.style.backgroundColor='#128C7E';" onmouseout="this.style.transform='scale(1)';this.style.backgroundColor='#25D366';">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Global Scripts -->
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
