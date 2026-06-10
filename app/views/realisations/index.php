<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- Realisations Hero -->
<section class="realisations-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 65px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center; color: var(--white); font-family: var(--font-main);">
    <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container">
        <h1 style="font-size: 38px; font-weight: 700; color: var(--white); margin-bottom: 10px;">Galerie de <span style="color: var(--primary-color);">Nos Réalisations</span></h1>
        <p style="font-size: 16px; color: var(--text-secondary); max-width: 600px; margin: 0 auto;">Découvrez nos projets publicitaires installés à Tanger et laissez-vous inspirer.</p>
    </div>
</section>

<!-- Portfolio Section -->
<section class="portfolio-section" style="padding: 60px 0; background-color: var(--light-grey); font-family: var(--font-main);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Category Filter Tabs -->
        <div class="category-tabs" style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; margin-bottom: 40px;">
            <a href="<?= url('realisations') ?>" 
               class="tab-link <?= ($selectedServiceId === 0) ? 'tab-active' : '' ?>"
               style="padding: 10px 22px; border-radius: 30px; background: <?= ($selectedServiceId === 0) ? 'var(--primary-color)' : 'var(--white)' ?>; color: <?= ($selectedServiceId === 0) ? 'var(--white)' : 'var(--dark)' ?>; text-decoration: none; font-size: 14px; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.3s; border: 1px solid <?= ($selectedServiceId === 0) ? 'var(--primary-color)' : 'rgba(0,0,0,0.05)' ?>;">
                Tous
            </a>
            <?php foreach ($services as $s): ?>
                <a href="<?= url('realisations?service=' . $s['id']) ?>" 
                   class="tab-link <?= ($selectedServiceId === (int)$s['id']) ? 'tab-active' : '' ?>"
                   style="padding: 10px 22px; border-radius: 30px; background: <?= ($selectedServiceId === (int)$s['id']) ? 'var(--primary-color)' : 'var(--white)' ?>; color: <?= ($selectedServiceId === (int)$s['id']) ? 'var(--white)' : 'var(--dark)' ?>; text-decoration: none; font-size: 14px; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.3s; border: 1px solid <?= ($selectedServiceId === (int)$s['id']) ? 'var(--primary-color)' : 'rgba(0,0,0,0.05)' ?>;">
                    <?= e($s['nom']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Realisations Grid -->
        <?php if (empty($realisations)): ?>
            <div style="text-align: center; color: #777; padding: 60px; background: white; border-radius: var(--radius-lg); box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                <i class="fa-solid fa-images" style="font-size: 40px; color: #ccc; margin-bottom: 16px; display: block;"></i>
                <p>Aucune réalisation disponible dans cette catégorie pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="realisations-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <?php foreach ($realisations as $r): ?>
                    <div class="realisation-card" style="background: var(--white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="height: 240px; background: #333; overflow: hidden; position: relative;">
                            <?php if ($r['image']): ?>
                                <img src="<?= asset('uploads/realisations/' . e($r['image'])) ?>" alt="<?= e($r['titre']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php endif; ?>
                            <span style="position: absolute; top: 15px; left: 15px; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(5px); color: var(--primary-color); font-size: 11.5px; font-weight: 700; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <?= e($r['service_nom']) ?>
                            </span>
                        </div>
                        <div style="padding: 24px; flex: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: 18px; font-weight: 600; color: var(--dark); margin-bottom: 10px;"><?= e($r['titre']) ?></h3>
                            <?php if (!empty($r['description'])): ?>
                                <p style="font-size: 13.5px; color: #666; line-height: 1.6; margin-bottom: 16px; flex: 1;">
                                    <?= e($r['description']) ?>
                                </p>
                            <?php endif; ?>
                            <div style="font-size: 12.5px; color: #999; margin-top: auto; border-top: 1px solid #f0f0f0; padding-top: 12px; display: flex; align-items: center; gap: 5px;">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Date : <?= date('d/m/Y', strtotime($r['date_realisation'])) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Tab hovering styles -->
<style>
.tab-link:hover {
    background-color: var(--primary-light) !important;
    color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}
.tab-active:hover {
    background-color: var(--primary-hover) !important;
    color: white !important;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
