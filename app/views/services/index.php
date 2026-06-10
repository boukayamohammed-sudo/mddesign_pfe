<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- Services Hero Banner -->
<section class="services-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 65px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center; color: var(--white); font-family: var(--font-main);">
    <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container">
        <h1 style="font-size: 38px; font-weight: 700; color: var(--white); margin-bottom: 10px;">Nos <span style="color: var(--primary-color);">Services Publicitaires</span></h1>
        <p style="font-size: 16px; color: var(--text-secondary); max-width: 600px; margin: 0 auto;">Des solutions de communication visuelle sur mesure pour valoriser votre marque à Tanger.</p>
    </div>
</section>

<!-- Services Grid Section -->
<section class="services-grid-section" style="padding: 60px 0; background-color: var(--light-grey); font-family: var(--font-main);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <?php if (empty($services)): ?>
            <div style="text-align: center; color: #777; padding: 60px; background: white; border-radius: var(--radius-lg); box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                <i class="fa-solid fa-list-check" style="font-size: 40px; color: #ccc; margin-bottom: 16px; display: block;"></i>
                <p>Aucun service n'est configuré pour le moment.</p>
            </div>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
                <?php foreach ($services as $s): ?>
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
                                <?= e(mb_strimwidth($s['description'] ?? '', 0, 160, '...')) ?>
                            </p>
                            <div style="display: flex; gap: 10px; border-top: 1px solid #f0f0f0; padding-top: 20px;">
                                <a href="<?= url('services/detail/' . $s['id']) ?>" class="btn btn-secondary btn-sm" style="flex: 1; font-weight: 600;">
                                    En savoir plus
                                </a>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', settings('whatsapp')) ?>?text=Bonjour,%20je%20souhaite%20obtenir%20plus%20d'informations%20concernant%20le%20service%20:%20<?= urlencode($s['nom']) ?>" target="_blank" class="btn btn-whatsapp btn-sm" style="padding: 8px 14px; background-color: #25D366; color: white; display: inline-flex; align-items: center; gap: 6px;">
                                    <i class="fa-brands fa-whatsapp" style="font-size: 16px;"></i> Devis
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
