<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-list-check"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Gérez les services proposés par votre agence</p>
        </div>
        <a href="<?= url('admin/services/create') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Ajouter un Service
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
            <div class="stat-icon"><i class="fa-solid fa-layer-group"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count($services) ?></span>
                <span class="stat-label">Total Services</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active"><i class="fa-solid fa-eye"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($services, fn($s) => $s['actif'])) ?></span>
                <span class="stat-label">Actifs</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon inactive"><i class="fa-solid fa-eye-slash"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($services, fn($s) => !$s['actif'])) ?></span>
                <span class="stat-label">Inactifs</span>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-table"></i> Liste des Services</h2>
        </div>
        <div class="card-body">
            <?php if (empty($services)): ?>
                <div class="empty-state">
                    <i class="fa-solid fa-inbox"></i>
                    <p>Aucun service trouvé.</p>
                    <a href="<?= url('admin/services/create') ?>" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus"></i> Créer votre premier service
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="data-table" id="services-table">
                        <thead>
                            <tr>
                                <th class="th-image">Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th class="th-center">Statut</th>
                                <th class="th-center">Date</th>
                                <th class="th-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td class="td-image">
                                        <?php if ($service['image']): ?>
                                            <img src="<?= asset('uploads/services/' . e($service['image'])) ?>" 
                                                 alt="<?= e($service['nom']) ?>" 
                                                 class="table-thumb">
                                        <?php else: ?>
                                            <div class="table-thumb-placeholder">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="td-title"><?= e($service['nom']) ?></td>
                                    <td class="td-desc">
                                        <?= e(mb_strimwidth($service['description'] ?? '', 0, 80, '...')) ?>
                                    </td>
                                    <td class="td-center">
                                        <a href="<?= url('admin/services/toggle/' . $service['id']) ?>" 
                                           class="badge <?= $service['actif'] ? 'badge-success' : 'badge-danger' ?>"
                                           title="Cliquer pour changer le statut">
                                            <?= $service['actif'] ? 'Actif' : 'Inactif' ?>
                                        </a>
                                    </td>
                                    <td class="td-center td-date">
                                        <?= date('d/m/Y', strtotime($service['date_creation'])) ?>
                                    </td>
                                    <td class="td-center td-actions">
                                        <a href="<?= url('admin/services/edit/' . $service['id']) ?>" 
                                           class="btn-action btn-edit" title="Modifier">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= url('admin/services/delete/' . $service['id']) ?>" 
                                           class="btn-action btn-delete" title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ? Cette action est irréversible.');">
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

<?php require_once __DIR__ . '/../../layouts/admin_footer.php'; ?>
