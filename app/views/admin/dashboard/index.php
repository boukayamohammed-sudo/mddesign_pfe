<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-chart-line"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Bienvenue dans l'espace d'administration de MD Design</p>
        </div>
    </div>

    <!-- Quick Welcome & Status Alert -->
    <div class="card" style="margin-bottom: 28px; background: linear-gradient(135deg, rgba(255, 122, 0, 0.1) 0%, rgba(44, 44, 44, 0.6) 100%); border-color: rgba(255, 122, 0, 0.2);">
        <div class="card-body" style="padding: 28px;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--white); box-shadow: 0 0 15px rgba(255, 122, 0, 0.4);">
                    <i class="fa-solid fa-handshake-angle"></i>
                </div>
                <div>
                    <h2 style="font-size: 20px; font-weight: 600; color: var(--white); margin: 0 0 6px 0;">Bonjour, <?= e($_SESSION['admin_username'] ?? 'Admin') ?> !</h2>
                    <p style="D: var(--text-muted); margin: 0; font-size: 14px;">Vous pilotez actuellement l'activité de l'agence <strong>MD Design Tanger</strong>. Utilisez le panneau latéral pour gérer les contenus du site.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="stats-row">
        <!-- Services Card -->
        <a href="<?= url('admin/services') ?>" style="text-decoration: none; display: block;">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(255, 122, 0, 0.15); color: var(--primary-color);">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?= e($servicesCount) ?></span>
                    <span class="stat-label">Services</span>
                </div>
            </div>
        </a>

        <!-- Réalisations Card -->
        <a href="<?= url('admin/realisations') ?>" style="text-decoration: none; display: block;">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(0, 196, 255, 0.15); color: #00c4ff;">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?= e($realisationsCount) ?></span>
                    <span class="stat-label">Réalisations</span>
                </div>
            </div>
        </a>

        <!-- Témoignages Card -->
        <a href="<?= url('admin/temoignages') ?>" style="text-decoration: none; display: block;">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(46, 213, 115, 0.15); color: #2ed573;">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?= e($temoignagesCount) ?></span>
                    <span class="stat-label">Témoignages</span>
                </div>
            </div>
        </a>

        <!-- Messages Card -->
        <a href="<?= url('admin/messages') ?>" style="text-decoration: none; display: block;">
            <div class="stat-card" style="position: relative;">
                <div class="stat-icon" style="background: rgba(255, 71, 87, 0.15); color: #ff4757;">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?= e($messagesCount) ?></span>
                    <span class="stat-label">
                        Messages 
                        <?php if ($unreadMessagesCount > 0): ?>
                            <span style="background: #ff4757; color: white; padding: 2px 6px; border-radius: 10px; font-size: 10px; font-weight: bold; margin-left: 4px;">
                                <?= $unreadMessagesCount ?> non lu(s)
                            </span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </a>
    </div>

    <!-- Quick Actions Card -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-bolt"></i> Raccourcis & Actions Rapides</h2>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                <a href="<?= url('admin/services/create') ?>" class="btn btn-primary" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 18px;">
                    <i class="fa-solid fa-plus"></i> Ajouter un Service
                </a>
                <a href="<?= url('admin/realisations/create') ?>" class="btn btn-secondary" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 18px; background: rgba(255, 255, 255, 0.05); color: var(--text-primary); border: 1px solid var(--dark-border);">
                    <i class="fa-solid fa-image"></i> Ajouter une Réalisation
                </a>
                <a href="<?= url('admin/temoignages/create') ?>" class="btn btn-secondary" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 18px; background: rgba(255, 255, 255, 0.05); color: var(--text-primary); border: 1px solid var(--dark-border);">
                    <i class="fa-solid fa-comment-medical"></i> Ajouter un Témoignage
                </a>
                <a href="<?= url('admin/parametres') ?>" class="btn btn-secondary" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 18px; background: rgba(255, 255, 255, 0.05); color: var(--text-primary); border: 1px solid var(--dark-border);">
                    <i class="fa-solid fa-gears"></i> Paramètres Agence
                </a>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../layouts/admin_footer.php'; ?>
