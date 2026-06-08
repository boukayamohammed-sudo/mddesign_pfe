<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-photo-film"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Gérez la galerie de réalisations et portfolios de votre agence</p>
        </div>
        <a href="<?= url('admin/realisations/create') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Ajouter une Réalisation
        </a>
    </div>

    <?php
    // Flash messages
    $session = new Session();
    $flashSuccess = $session->get('flash_success');
    $flashError = $session->get('flash_error');
    if ($flashSuccess) { $session->remove('flash_success'); }
    if ($flashError) { $session->remove('flash_error'); }
    ?>

    <?php if ($flashSuccess): ?>
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span><?= e($flashSuccess) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($flashError): ?>
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span><?= e($flashError) ?></span>
        </div>
    <?php endif; ?>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-images"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count($realisations) ?></span>
                <span class="stat-label">Total Réalisations</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active"><i class="fa-solid fa-check-double"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($realisations, fn($r) => $r['actif'])) ?></span>
                <span class="stat-label">Actifs</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon inactive"><i class="fa-solid fa-ban"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($realisations, fn($r) => !$r['actif'])) ?></span>
                <span class="stat-label">Inactifs</span>
            </div>
        </div>
    </div>

    <!-- Realisations Table -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-table"></i> Galerie des Projets</h2>
        </div>
        <div class="card-body">
            <?php if (empty($realisations)): ?>
                <div class="empty-state">
                    <i class="fa-solid fa-image"></i>
                    <p>Aucune réalisation trouvée.</p>
                    <a href="<?= url('admin/realisations/create') ?>" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus"></i> Ajouter votre premier projet
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="data-table" id="realisations-table">
                        <thead>
                            <tr>
                                <th class="th-image">Image</th>
                                <th>Titre</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th class="th-center">Statut</th>
                                <th class="th-center">Date Projet</th>
                                <th class="th-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($realisations as $realisation): ?>
                                <tr>
                                    <td class="td-image">
                                        <?php if ($realisation['image']): ?>
                                            <img src="<?= asset('uploads/realisations/' . e($realisation['image'])) ?>" 
                                                 alt="<?= e($realisation['titre']) ?>" 
                                                 class="table-thumb">
                                        <?php else: ?>
                                            <div class="table-thumb-placeholder">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="td-title"><?= e($realisation['titre']) ?></td>
                                    <td>
                                        <span class="badge" style="background: rgba(255, 122, 0, 0.1); color: var(--primary-color); border: 1px solid rgba(255, 122, 0, 0.25);">
                                            <?= e($realisation['service_nom'] ?? 'Sans Service') ?>
                                        </span>
                                    </td>
                                    <td class="td-desc">
                                        <?= e(mb_strimwidth($realisation['description'] ?? '', 0, 80, '...')) ?>
                                    </td>
                                    <td class="td-center">
                                        <a href="<?= url('admin/realisations/toggle/' . $realisation['id']) ?>" 
                                           class="badge <?= $realisation['actif'] ? 'badge-success' : 'badge-danger' ?>"
                                           title="Cliquer pour changer le statut">
                                            <?= $realisation['actif'] ? 'Actif' : 'Inactif' ?>
                                        </a>
                                    </td>
                                    <td class="td-center td-date">
                                        <?= date('d/m/Y', strtotime($realisation['date_realisation'])) ?>
                                    </td>
                                    <td class="td-center td-actions">
                                        <a href="<?= url('admin/realisations/edit/' . $realisation['id']) ?>" 
                                           class="btn-action btn-edit" title="Modifier">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= url('admin/realisations/delete/' . $realisation['id']) ?>" 
                                           class="btn-action btn-delete" title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réalisation ? Cette action est irréversible.');">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
