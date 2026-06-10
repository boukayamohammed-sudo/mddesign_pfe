<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<!-- About Hero -->
<section class="about-hero" style="background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); padding: 65px 0; border-bottom: 3px solid var(--primary-color); position: relative; overflow: hidden; text-align: center; color: var(--white); font-family: var(--font-main);">
    <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 30%, rgba(255, 122, 0, 0.08) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container">
        <h1 style="font-size: 38px; font-weight: 700; color: var(--white); margin-bottom: 10px;">À Propos de <span style="color: var(--primary-color);">MD Design</span></h1>
        <p style="font-size: 16px; color: var(--text-secondary); max-width: 600px; margin: 0 auto;">L'histoire d'une agence passionnée par la communication visuelle et la réussite de ses clients à Tanger.</p>
    </div>
</section>

<!-- About Content Sections -->
<section class="about-content-section" style="padding: 70px 0; background-color: var(--light-grey); font-family: var(--font-main);">
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px; display: flex; flex-direction: column; gap: 40px;">
        
        <!-- Part 1: Our Story -->
        <div style="background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03); display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 40px; align-items: center;">
            <div>
                <h2 style="font-size: 24px; font-weight: 650; color: var(--dark); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-book-open" style="color: var(--primary-color);"></i> Notre Histoire
                </h2>
                <p style="font-size: 15px; color: #555; line-height: 1.75; margin-bottom: 16px;">
                    Fondée avec la volonté d'apporter des solutions d'affichage publicitaire haut de gamme, <strong>MD Design</strong> s'est imposée à Tanger grâce à son savoir-faire technique et à sa réactivité commerciale. 
                </p>
                <p style="font-size: 15px; color: #555; line-height: 1.75;">
                    De l'artisan local à la multinationale basée en zone franche, nous mettons notre expertise au service de chaque projet. Notre atelier équipé de machines d'impression numérique grand format et de découpe nous permet de fabriquer localement et de contrôler la qualité à chaque étape.
                </p>
            </div>
            <div style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); border-radius: var(--radius-md); height: 200px; display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-size: 50px;">
                <i class="fa-solid fa-industry"></i>
            </div>
        </div>

        <!-- Part 2: Quality Guarantees / Core Values -->
        <div style="background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03);">
            <h2 style="font-size: 24px; font-weight: 650; color: var(--dark); margin-bottom: 30px; text-align: center;">
                <i class="fa-solid fa-star" style="color: var(--primary-color);"></i> Pourquoi choisir MD Design ?
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div style="text-align: center; padding: 20px; border-radius: var(--radius-md); background: #fafafa; border: 1px solid rgba(0,0,0,0.02);">
                    <i class="fa-solid fa-clock" style="font-size: 32px; color: var(--primary-color); margin-bottom: 15px;"></i>
                    <h3 style="font-size: 17px; font-weight: 600; margin-bottom: 10px; color: var(--dark);">Respect des Délais</h3>
                    <p style="font-size: 13.5px; color: #666; line-height: 1.6;">Nous savons que le temps est précieux. Nous nous engageons à livrer et poser vos enseignes et covering selon le planning validé.</p>
                </div>
                
                <div style="text-align: center; padding: 20px; border-radius: var(--radius-md); background: #fafafa; border: 1px solid rgba(0,0,0,0.02);">
                    <i class="fa-solid fa-compass-drafting" style="font-size: 32px; color: var(--primary-color); margin-bottom: 15px;"></i>
                    <h3 style="font-size: 17px; font-weight: 600; margin-bottom: 10px; color: var(--dark);">Matériaux Premium</h3>
                    <p style="font-size: 13.5px; color: #666; line-height: 1.6;">Nous utilisons des films adhésifs certifiés (pour covering et vitres solaires) et des LED longue durée pour garantir la durabilité de nos produits.</p>
                </div>

                <div style="text-align: center; padding: 20px; border-radius: var(--radius-md); background: #fafafa; border: 1px solid rgba(0,0,0,0.02);">
                    <i class="fa-solid fa-users" style="font-size: 32px; color: var(--primary-color); margin-bottom: 15px;"></i>
                    <h3 style="font-size: 17px; font-weight: 600; margin-bottom: 10px; color: var(--dark);">Équipe d'experts</h3>
                    <p style="font-size: 13.5px; color: #666; line-height: 1.6;">Nos graphistes et nos poseurs spécialisés maîtrisent parfaitement les techniques de thermoformage d'adhésifs et de soudure d'enseignes.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Call to action at bottom of about page -->
<section style="padding: 70px 0; background: linear-gradient(135deg, #1A1A1A 0%, #2C2C2C 100%); text-align: center; color: white; font-family: var(--font-main); border-top: 3px solid var(--primary-color);">
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 16px;">Créons ensemble votre identité visuelle</h2>
        <p style="font-size: 16.5px; margin-bottom: 28px; color: rgba(255,255,255,0.75);">Venez nous rencontrer dans nos locaux à Tanger ou demandez un devis immédiat.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="<?= url('contact') ?>" class="btn btn-primary" style="padding: 12px 28px; font-size: 15px; font-weight: 600;">
                <i class="fa-solid fa-map-location-dot"></i> Nous Contacter
            </a>
            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', settings('whatsapp')) ?>" target="_blank" class="btn btn-whatsapp" style="padding: 12px 28px; font-size: 15px; font-weight: 600; background-color: #25D366; color: white;">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp Direct
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
