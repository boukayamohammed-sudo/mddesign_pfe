<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="home-hero">
    <div class="container" style="text-align: center; padding: 120px 20px 80px;">
        <h1 style="font-size: 48px; font-weight: 700; color: var(--white, #fff); margin-bottom: 16px;">
            MD <span style="color: #FF7A00;">Design</span>
        </h1>
        <p style="font-size: 20px; color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto 32px;">
            Agence publicitaire à Tanger — Enseignes, Habillage véhicules, Covering & Impression numérique
        </p>
        <a href="<?= url('services') ?>" class="btn btn-primary" style="padding: 14px 32px; font-size: 16px; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-arrow-right"></i> Découvrir nos services
        </a>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
