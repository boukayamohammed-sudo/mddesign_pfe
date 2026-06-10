<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- Service Detail Hero -->
<section class="service-detail-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 65px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center; color: var(--white); font-family: var(--font-main);">
    <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <span style="color: var(--primary-color); font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 8px;">Détails du service</span>
        <h1 style="font-size: 38px; font-weight: 700; color: var(--white); margin: 0;"><?= e($service['nom']) ?></h1>
    </div>
</section>

<!-- Service Content -->
<section class="service-detail-content" style="padding: 70px 0; background-color: var(--light-grey); font-family: var(--font-main);">
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
        
        <div style="display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 50px; background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03); align-items: start;">
            
            <!-- Left: Description and CTA -->
            <div>
                <h2 style="font-size: 24px; font-weight: 650; color: var(--dark); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-info" style="color: var(--primary-color);"></i> Description
                </h2>
                <div style="font-size: 15.5px; color: #555; line-height: 1.8; margin-bottom: 30px; white-space: pre-line;">
                    <?= e($service['description']) ?>
                </div>
                
                <div style="border-top: 1px solid #eee; padding-top: 30px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--dark); margin-bottom: 12px;">Des questions ? Intéressé ?</h3>
                    <p style="font-size: 14px; color: #777; margin-bottom: 20px;">Demandez une étude personnalisée et recevez votre devis gratuitement par WhatsApp.</p>
                    
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', settings('whatsapp')) ?>?text=Bonjour,%20je%20souhaite%20obtenir%20plus%20d'informations%20concernant%20le%20service%20:%20<?= urlencode($service['nom']) ?>" target="_blank" class="btn btn-whatsapp" style="display: inline-flex; width: 100%; padding: 14px; font-size: 15.5px; background-color: #25D366; color: white; justify-content: center; box-shadow: 0 4px 12px rgba(37,211,102,0.25);">
                        <i class="fa-brands fa-whatsapp" style="font-size: 20px;"></i> Demander un devis par WhatsApp
                    </a>
                </div>
            </div>

            <!-- Right: Service Image -->
            <div>
                <div style="border-radius: var(--radius-md); overflow: hidden; border: 1px solid rgba(0,0,0,0.05); background: #333; box-shadow: 0 8px 25px rgba(0,0,0,0.06);">
                    <?php if ($service['image']): ?>
                        <img src="<?= asset('uploads/services/' . e($service['image'])) ?>" alt="<?= e($service['nom']) ?>" style="width: 100%; height: auto; display: block; object-fit: cover;">
                    <?php else: ?>
                        <div style="height: 300px; display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-size: 50px; background: linear-gradient(135deg, #2c2c2c 0%, #1f1f1f 100%);">
                            <i class="fa-solid fa-image"></i>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Styles for details responsive view -->
<style>
@media (max-width: 768px) {
    .service-detail-content .container > div {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
        padding: 24px !important;
    }
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
