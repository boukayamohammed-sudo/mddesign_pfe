<aside class="admin-sidebar">
    <div class="sidebar-logo">
        MD <span>Design</span>
    </div>
    
    <div class="sidebar-user">
        <i class="fa-solid fa-user-shield"></i>
        <span><?= e($_SESSION['admin_username'] ?? 'Admin') ?></span>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li>
                <a href="<?= url('admin/dashboard') ?>" class="sidebar-link">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="<?= url('admin/services') ?>" class="sidebar-link">
                    <i class="fa-solid fa-list-check"></i> Services
                </a>
            </li>
            <li>
                <a href="<?= url('admin/realisations') ?>" class="sidebar-link">
                    <i class="fa-solid fa-images"></i> Réalisations
                </a>
            </li>
            <li>
                <a href="<?= url('admin/temoignages') ?>" class="sidebar-link">
                    <i class="fa-solid fa-comments"></i> Témoignages
                </a>
            </li>
            <li>
                <a href="<?= url('admin/messages') ?>" class="sidebar-link">
                    <i class="fa-solid fa-envelope"></i> Messages
                </a>
            </li>
            <li>
                <a href="<?= url('admin/parametres') ?>" class="sidebar-link">
                    <i class="fa-solid fa-gears"></i> Paramètres
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="<?= url('logout') ?>" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
        </a>
    </div>
</aside>
