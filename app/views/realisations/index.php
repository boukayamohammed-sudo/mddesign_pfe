<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- Realisations Hero -->
<section class="realisations-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 65px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center; color: var(--white); font-family: var(--font-main);">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
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
            <div class="realisations-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                <?php foreach ($realisations as $r): ?>
                    <div class="realisation-card" onclick="openLightbox('<?= asset('uploads/realisations/' . e($r['image'])) ?>', '<?= e(addslashes($r['titre'])) ?>', '<?= e(addslashes($r['service_nom'])) ?>', '<?= e(addslashes($r['description'] ?? '')) ?>', '<?= date('d/m/Y', strtotime($r['date_realisation'])) ?>')">
                        <div class="realisation-image-wrap">
                            <?php if ($r['image']): ?>
                                <img src="<?= asset('uploads/realisations/' . e($r['image'])) ?>" alt="<?= e($r['titre']) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="realisation-placeholder"><i class="fa-solid fa-image"></i></div>
                            <?php endif; ?>
                            <div class="realisation-overlay">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </div>
                            <span class="realisation-badge"><?= e($r['service_nom']) ?></span>
                        </div>
                        <div class="realisation-info">
                            <h3><?= e($r['titre']) ?></h3>
                            <?php if (!empty($r['description'])): ?>
                                <p><?= e(mb_strimwidth($r['description'], 0, 100, '...')) ?></p>
                            <?php endif; ?>
                            <div class="realisation-date">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span><?= date('d/m/Y', strtotime($r['date_realisation'])) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-overlay" onclick="closeLightbox()">
    <div id="lightbox-box" onclick="event.stopPropagation()">
        <button id="lightbox-close" onclick="closeLightbox()">&times;</button>
        <div id="lightbox-img-wrap">
            <img id="lightbox-img" src="" alt="">
        </div>
        <div id="lightbox-content">
            <span id="lightbox-badge"></span>
            <h2 id="lightbox-title"></h2>
            <p id="lightbox-desc"></p>
            <div id="lightbox-date"><i class="fa-solid fa-calendar-days"></i> <span></span></div>
        </div>
    </div>
</div>

<style>
/* ---- Tab Styles ---- */
.tab-link:hover {
    background-color: var(--primary-light) !important;
    color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}
.tab-active:hover {
    background-color: var(--primary-hover) !important;
    color: white !important;
}

/* ---- Card Styles ---- */
.realisation-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    border: 1px solid rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.realisation-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}
.realisation-image-wrap {
    position: relative;
    height: 240px;
    background: #2c2c2c;
    overflow: hidden;
}
.realisation-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.realisation-card:hover .realisation-image-wrap img {
    transform: scale(1.06);
}
.realisation-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--primary-color); font-size: 40px;
    background: linear-gradient(135deg, #2c2c2c 0%, #1f1f1f 100%);
}
.realisation-overlay {
    position: absolute; inset: 0;
    background: rgba(255, 122, 0, 0.0);
    display: flex; align-items: center; justify-content: center;
    transition: background 0.3s ease;
}
.realisation-overlay i {
    color: white; font-size: 32px;
    opacity: 0;
    transform: scale(0.7);
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.realisation-card:hover .realisation-overlay {
    background: rgba(0, 0, 0, 0.45);
}
.realisation-card:hover .realisation-overlay i {
    opacity: 1;
    transform: scale(1);
}
.realisation-badge {
    position: absolute; top: 14px; left: 14px;
    background: rgba(0,0,0,0.72);
    backdrop-filter: blur(6px);
    color: var(--primary-color);
    font-size: 11px; font-weight: 700;
    padding: 5px 13px; border-radius: 20px;
    text-transform: uppercase; letter-spacing: 0.6px;
}
.realisation-info {
    padding: 20px 22px;
    flex: 1; display: flex; flex-direction: column;
}
.realisation-info h3 {
    font-size: 16.5px; font-weight: 600;
    color: var(--dark); margin-bottom: 8px;
    line-height: 1.35;
}
.realisation-info p {
    font-size: 13px; color: #666;
    line-height: 1.55; flex: 1; margin-bottom: 14px;
}
.realisation-date {
    font-size: 12px; color: #aaa;
    display: flex; align-items: center; gap: 6px;
    border-top: 1px solid #f0f0f0; padding-top: 12px;
    margin-top: auto;
}

/* ---- Lightbox ---- */
#lightbox-overlay {
    display: none;
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.88);
    backdrop-filter: blur(6px);
    align-items: center; justify-content: center;
    padding: 20px;
    animation: fadeIn 0.25s ease;
}
#lightbox-overlay.active {
    display: flex;
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
#lightbox-box {
    background: #1a1a1a;
    border-radius: 16px;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    position: relative;
    animation: scaleIn 0.25s ease;
    box-shadow: 0 30px 80px rgba(0,0,0,0.6);
}
@keyframes scaleIn { from { transform: scale(0.92); opacity: 0; } to { transform: scale(1); opacity: 1; } }
#lightbox-close {
    position: absolute; top: 14px; right: 16px;
    background: rgba(255,255,255,0.1); border: none;
    color: #fff; font-size: 24px;
    width: 38px; height: 38px;
    border-radius: 50%; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    line-height: 1; z-index: 10;
    transition: background 0.2s;
}
#lightbox-close:hover { background: var(--primary-color); }
#lightbox-img-wrap {
    width: 100%; max-height: 520px;
    overflow: hidden; border-radius: 16px 16px 0 0;
    background: #111;
    display: flex; align-items: center; justify-content: center;
}
#lightbox-img {
    width: 100%; height: auto;
    max-height: 520px;
    object-fit: contain;
    display: block;
}
#lightbox-content {
    padding: 24px 30px;
}
#lightbox-badge {
    display: inline-block;
    background: rgba(255,122,0,0.15);
    color: var(--primary-color);
    font-size: 11px; font-weight: 700;
    padding: 4px 12px; border-radius: 20px;
    text-transform: uppercase; letter-spacing: 0.7px;
    margin-bottom: 12px;
}
#lightbox-title {
    font-size: 22px; font-weight: 700;
    color: #fff; margin-bottom: 10px;
}
#lightbox-desc {
    font-size: 14px; color: #aaa;
    line-height: 1.7; margin-bottom: 16px;
}
#lightbox-date {
    font-size: 12.5px; color: #666;
    display: flex; align-items: center; gap: 6px;
    border-top: 1px solid rgba(255,255,255,0.07);
    padding-top: 14px;
}

@media (max-width: 640px) {
    .realisations-grid { grid-template-columns: 1fr 1fr !important; gap: 14px !important; }
    .realisation-image-wrap { height: 170px; }
    #lightbox-box { border-radius: 12px; }
    #lightbox-img-wrap { max-height: 260px; }
    #lightbox-content { padding: 16px 18px; }
}
</style>

<script>
function openLightbox(src, title, badge, desc, date) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-img').alt = title;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox-badge').textContent = badge;
    document.getElementById('lightbox-desc').textContent = desc;
    document.getElementById('lightbox-date').querySelector('span').textContent = 'Réalisé le ' + date;
    var overlay = document.getElementById('lightbox-overlay');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox-overlay').classList.remove('active');
    document.body.style.overflow = '';
    // clear src to stop potential video/gif loops
    setTimeout(function(){ document.getElementById('lightbox-img').src = ''; }, 300);
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
