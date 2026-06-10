<?php
// Get WhatsApp contact link from settings
$whatsapp_num = settings('whatsapp');
$whatsapp_url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsapp_num);
?>
<header class="main-header">
    <div class="container navbar-container">
        <a href="<?= url('/') ?>" class="navbar-logo">
            MD <span>Design</span>
        </a>
        
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="<?= url('/') ?>" class="nav-link">Accueil</a></li>
                <li><a href="<?= url('services') ?>" class="nav-link">Services</a></li>
                <li><a href="<?= url('realisations') ?>" class="nav-link">Réalisations</a></li>
                <li><a href="<?= url('about') ?>" class="nav-link">À Propos</a></li>
                <li><a href="<?= url('contact') ?>" class="nav-link">Contact</a></li>
                <?php if ((new Session())->has('admin_logged')): ?>
                    <li><a href="<?= url('admin/dashboard') ?>" class="nav-link admin-badge"><i class="fa-solid fa-gauge"></i> Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <div class="navbar-cta">
            <a href="<?= $whatsapp_url ?>" target="_blank" class="btn btn-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> Devis Express
            </a>
            <button class="mobile-toggle" aria-label="Menu de navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>
