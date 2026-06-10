<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- 1. HERO BANNER -->
<section class="home-hero" style="background: linear-gradient(135deg, rgba(26,26,26,0.95) 0%, rgba(44,44,44,0.9) 100%), url('<?= asset('images/hero_bg.jpg') ?>'); background-size: cover; background-position: center; padding: 140px 0 100px; position: relative; text-align: center; color: var(--white); overflow: hidden;">
    <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 50%, rgba(255,122,0,0.15) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2;">
        <span style="display: inline-block; background: var(--primary-light); color: var(--primary-color); padding: 8px 18px; border-radius: 30px; font-size: 13.5px; font-weight: 600; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px; border: 1px solid rgba(255,122,0,0.2);">
            Agence Publicitaire Tanger
        </span>
        <h1 style="font-size: 54px; font-weight: 700; line-height: 1.15; margin-bottom: 20px; font-family: var(--font-main);">
            Votre Image, <span style="color: var(--primary-color); text-shadow: 0 0 15px rgba(255,122,0,0.25);">Notre Métier</span>
        </h1>
        <p style="font-size: 19px; color: var(--text-secondary); max-width: 680px; margin: 0 auto 36px; line-height: 1.6;">
            MD Design conçoit et réalise vos enseignes lumineuses, covering de véhicules, habillages vitrines et impressions grand format de qualité premium à Tanger.
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?= url('services') ?>" class="btn btn-primary" style="padding: 14px 30px; font-size: 15.5px; font-weight: 600;">
                <i class="fa-solid fa-list-check"></i> Découvrir nos services
            </a>
            <a href="<?= url('contact') ?>" class="btn btn-secondary" style="padding: 14px 30px; font-size: 15.5px; font-weight: 600; color: white;">
                <i class="fa-solid fa-envelope"></i> Demander un devis
            </a>
        </div>
    </div>
</section>

<!-- 2. AGENCY PRESENTATION (BIO) -->
<section class="agency-presentation" style="padding: 90px 0; background-color: var(--white); font-family: var(--font-main);">
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
        
        <!-- Left: Images Stack -->
        <div style="position: relative;">
            <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--light-grey); box-shadow: 0 15px 40px rgba(0,0,0,0.08); background: #eee;">
                <!-- Fallback to generated visual or premium block -->
                <div style="height: 350px; background: linear-gradient(45deg, #2c2c2c, #1f1f1f); display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-size: 40px;">
                    <i class="fa-solid fa-compass-drafting"></i>
                </div>
            </div>
            <div style="position: absolute; bottom: -30px; right: -30px; width: 200px; height: 180px; border-radius: var(--radius-md); overflow: hidden; border: 4px solid var(--white); box-shadow: 0 10px 30px rgba(0,0,0,0.15); background: linear-gradient(135deg, var(--primary-color), var(--primary-hover)); display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; text-align: center; padding: 15px;">
                <i class="fa-solid fa-award" style="font-size: 32px; margin-bottom: 8px;"></i>
                <span style="font-size: 26px; font-weight: 700; line-height: 1.1;">100%</span>
                <span style="font-size: 12px; font-weight: 500; text-transform: uppercase;">Qualité Garantie</span>
            </div>
        </div>

        <!-- Right: Content -->
        <div>
            <span style="color: var(--primary-color); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">Qui sommes-nous ?</span>
            <h2 style="font-size: 36px; font-weight: 700; color: var(--dark); margin-bottom: 24px; line-height: 1.2;">Leader de la communication visuelle à Tanger</h2>
            <p style="font-size: 15.5px; color: #555; line-height: 1.7; margin-bottom: 20px;">
                Depuis sa création, <strong>MD Design</strong> s'est imposée comme le partenaire privilégié des commerces, entreprises et marques à Tanger pour tous leurs besoins publicitaires. Nous allions créativité, innovation technique et rigueur d'exécution.
            </p>
            <p style="font-size: 15.5px; color: #555; line-height: 1.7; margin-bottom: 30px;">
                Qu'il s'agisse d'habiller une flotte de véhicules, de fabriquer des enseignes lumineuses en relief ou d'agencer la signalétique de vos bureaux, notre équipe vous accompagne de l'étude graphique jusqu'à la pose sur site.
            </p>
            <a href="<?= url('about') ?>" class="btn btn-secondary" style="border-color: var(--primary-color); color: var(--primary-color); padding: 10px 24px;">
                En savoir plus sur notre histoire
            </a>
        </div>

    </div>
</section>

<!-- 3. POPULAR SERVICES GRID -->
<section class="services-popular" style="padding: 90px 0; background-color: var(--light-grey); font-family: var(--font-main);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="color: var(--primary-color); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">Nos Services</span>
            <h2 style="font-size: 36px; font-weight: 700; color: var(--dark); margin-bottom: 16px;">Ce que nous faisons le mieux</h2>
            <p style="font-size: 16px; color: #555; max-width: 600px; margin: 0 auto;">Une gamme complète de solutions de marquage et d'enseignes publicitaires adaptées à votre budget.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
            <?php if (empty($popularServices)): ?>
                <div style="grid-column: 1 / -1; text-align: center; color: #777; padding: 40px;">Aucun service disponible.</div>
            <?php else: ?>
                <?php foreach ($popularServices as $s): ?>
                    <div class="service-card" style="background: var(--white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="height: 220px; background: #2c2c2c; overflow: hidden; position: relative;">
                            <?php if ($s['image']): ?>
                                <img src="<?= asset('uploads/services/' . e($s['image'])) ?>" alt="<?= e($s['nom']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-size: 40px; background: linear-gradient(135deg, #2c2c2c 0%, #1f1f1f 100%);">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div style="padding: 26px; display: flex; flex-direction: column; flex: 1;">
                            <h3 style="font-size: 20px; font-weight: 600; color: var(--dark); margin-bottom: 12px;"><?= e($s['nom']) ?></h3>
                            <p style="font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 24px; flex: 1;">
                                <?= e(mb_strimwidth($s['description'] ?? '', 0, 120, '...')) ?>
                            </p>
                            <div style="display: flex; gap: 10px;">
                                <a href="<?= url('services/detail/' . $s['id']) ?>" class="btn btn-secondary btn-sm" style="flex: 1;">
                                    En savoir plus
                                </a>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', settings('whatsapp')) ?>?text=Bonjour,%20je%20souhaite%20obtenir%20un%20devis%20concernant%20le%20service%20:%20<?= urlencode($s['nom']) ?>" target="_blank" class="btn btn-whatsapp btn-sm" style="padding: 8px 12px; background-color: #25D366; color: white;">
                                    <i class="fa-brands fa-whatsapp" style="font-size: 16px;"></i> Devis
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- 4. STATS ROW -->
<section class="stats-banner" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); color: var(--white); padding: 70px 0; border-top: 3px solid var(--primary-color); font-family: var(--font-main);">
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; text-align: center;">
        <?php if (!empty($stats)): ?>
            <?php foreach ($stats as $st): ?>
                <div>
                    <span style="font-size: 44px; font-weight: 700; color: var(--primary-color); display: block; margin-bottom: 8px; line-height: 1;"><?= e($st['valeur']) ?></span>
                    <span style="font-size: 14px; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;"><?= e($st['titre']) ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div>
                <span style="font-size: 44px; font-weight: 700; color: var(--primary-color); display: block; margin-bottom: 8px;">10+</span>
                <span style="font-size: 14px; color: var(--text-secondary); text-transform: uppercase;">Années d'expérience</span>
            </div>
            <div>
                <span style="font-size: 44px; font-weight: 700; color: var(--primary-color); display: block; margin-bottom: 8px;">1500+</span>
                <span style="font-size: 14px; color: var(--text-secondary); text-transform: uppercase;">Projets réalisés</span>
            </div>
            <div>
                <span style="font-size: 44px; font-weight: 700; color: var(--primary-color); display: block; margin-bottom: 8px;">98%</span>
                <span style="font-size: 14px; color: var(--text-secondary); text-transform: uppercase;">Clients Satisfaits</span>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 5. RECENT REALISATIONS GALLERY -->
<section class="gallery-recent" style="padding: 90px 0; background-color: var(--white); font-family: var(--font-main);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 45px; flex-wrap: wrap; gap: 20px;">
            <div>
                <span style="color: var(--primary-color); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">Réalisations</span>
                <h2 style="font-size: 36px; font-weight: 700; color: var(--dark); margin: 0; line-height: 1.15;">Derniers Projets Réalisés</h2>
            </div>
            <a href="<?= url('realisations') ?>" class="btn btn-secondary" style="border-color: var(--primary-color); color: var(--primary-color); font-size: 14.5px;">
                Voir toute la galerie <i class="fa-solid fa-chevron-right" style="font-size: 12px; margin-left: 5px;"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
            <?php if (empty($recentRealisations)): ?>
                <div style="grid-column: 1 / -1; text-align: center; color: #777; padding: 40px;">Aucune réalisation disponible.</div>
            <?php else: ?>
                <?php foreach ($recentRealisations as $r): ?>
                    <div style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.05); position: relative; aspect-ratio: 4/3; background: #333; group-hover: scale(1.05); transition: transform 0.3s;" onmouseover="this.querySelector('.overlay').style.opacity='1'" onmouseout="this.querySelector('.overlay').style.opacity='0'">
                        <?php if ($r['image']): ?>
                            <img src="<?= asset('uploads/realisations/' . e($r['image'])) ?>" alt="<?= e($r['titre']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.85) 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 20px; opacity: 0; transition: opacity 0.3s; pointer-events: none;">
                            <span style="color: var(--primary-color); font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;"><?= e($r['service_nom']) ?></span>
                            <h4 style="color: var(--white); font-size: 17px; font-weight: 600; margin: 0;"><?= e($r['titre']) ?></h4>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- 6. CLIENT TESTIMONIALS -->
<?php if (!empty($testimonials)): ?>
    <section class="testimonials-home" style="padding: 90px 0; background-color: var(--light-grey); font-family: var(--font-main);">
        <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
            
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: var(--primary-color); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">Témoignages</span>
                <h2 style="font-size: 36px; font-weight: 700; color: var(--dark); margin: 0;">Ce que nos clients disent</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
                <?php foreach ($testimonials as $t): ?>
                    <div style="background: var(--white); border-radius: var(--radius-lg); padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column;">
                        <div style="display: flex; gap: 4px; color: var(--primary-color); font-size: 15px; margin-bottom: 16px;">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #555; font-size: 14.5px; line-height: 1.6; margin-bottom: 24px; flex: 1;">
                            "<?= e($t['message']) ?>"
                        </p>
                        <div style="display: flex; align-items: center; gap: 14px; border-top: 1px solid var(--light-grey); padding-top: 16px;">
                            <?php if ($t['photo']): ?>
                                <img src="<?= asset('uploads/temoignages/' . e($t['photo'])) ?>" alt="<?= e($t['nom_client']) ?>" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-color);">
                            <?php else: ?>
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; color: #777; font-size: 18px; border: 2px solid var(--primary-color);">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <strong style="display: block; font-size: 14.5px; color: var(--dark);"><?= e($t['nom_client']) ?></strong>
                                <span style="font-size: 12.5px; color: #777;"><?= e($t['fonction_client'] ?: 'Client') ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- 7. CONTACT QUICK CTA -->
<section style="padding: 70px 0; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%); text-align: center; color: white; font-family: var(--font-main);">
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 16px;">Vous souhaitez lancer un projet publicitaire ?</h2>
        <p style="font-size: 16.5px; margin-bottom: 28px; color: rgba(255,255,255,0.9);">Contactez notre équipe commerciale à Tanger dès aujourd'hui pour obtenir une étude et un devis gratuit.</p>
        <a href="<?= url('contact') ?>" class="btn btn-secondary" style="background: white; border: none; color: var(--primary-color); font-size: 15.5px; font-weight: 700; padding: 12px 30px;">
            <i class="fa-solid fa-envelope" style="margin-right: 5px;"></i> Obtenir un Devis Gratuit
        </a>
    </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
