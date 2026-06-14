<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- Services Hero Banner -->
<section class="services-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 65px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center; color: var(--white); font-family: var(--font-main);">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
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
            <div class="services-grid">
                <?php foreach ($services as $s): ?>
                    <div class="service-card">
                        <div class="service-image-wrap">
                            <?php if ($s['image']): ?>
                                <img src="<?= asset('uploads/services/' . e($s['image'])) ?>" alt="<?= e($s['nom']) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="service-img-placeholder">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            <?php endif; ?>
                            <div class="service-img-overlay">
                                <a href="<?= url('services/detail/' . $s['id']) ?>" class="service-img-cta">En savoir plus</a>
                            </div>
                        </div>
                        <div class="service-body">
                            <h3><?= e($s['nom']) ?></h3>
                            <p><?= e(mb_strimwidth($s['description'] ?? '', 0, 140, '...')) ?></p>
                            <div class="service-actions">
                                <a href="<?= url('services/detail/' . $s['id']) ?>" class="btn btn-secondary btn-sm" style="flex: 1; font-weight: 600; text-align:center;">En savoir plus</a>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', settings('whatsapp')) ?>?text=Bonjour,%20je%20souhaite%20obtenir%20un%20devis%20pour%20:%20<?= urlencode($s['nom']) ?>" target="_blank" class="btn btn-whatsapp btn-sm" style="padding: 8px 14px; background-color: #25D366; color: white; display: inline-flex; align-items: center; gap: 6px;">
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

<style>
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 28px;
}
.service-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    border: 1px solid rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.service-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 22px 44px rgba(0,0,0,0.11);
}
.service-image-wrap {
    position: relative;
    height: 230px;
    background: #2c2c2c;
    overflow: hidden;
}
.service-image-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.service-card:hover .service-image-wrap img {
    transform: scale(1.06);
}
.service-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--primary-color); font-size: 40px;
    background: linear-gradient(135deg, #2c2c2c 0%, #1f1f1f 100%);
}
.service-img-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0);
    display: flex; align-items: flex-end; justify-content: center;
    padding-bottom: 20px;
    transition: background 0.3s ease;
}
.service-card:hover .service-img-overlay {
    background: rgba(0,0,0,0.42);
}
.service-img-cta {
    background: var(--primary-color);
    color: #fff;
    padding: 9px 22px;
    border-radius: 30px;
    font-size: 13px; font-weight: 700;
    text-decoration: none;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.service-card:hover .service-img-cta {
    opacity: 1;
    transform: translateY(0);
}
.service-body {
    padding: 22px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.service-body h3 {
    font-size: 19px; font-weight: 700;
    color: var(--dark); margin-bottom: 10px;
}
.service-body p {
    font-size: 13.5px; color: #666;
    line-height: 1.65; flex: 1; margin-bottom: 20px;
}
.service-actions {
    display: flex; gap: 10px;
    border-top: 1px solid #f0f0f0; padding-top: 18px;
}

@media (max-width: 640px) {
    .services-grid { grid-template-columns: 1fr !important; }
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
