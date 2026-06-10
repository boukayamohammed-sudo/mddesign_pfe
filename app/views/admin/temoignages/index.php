<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-comments"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Gérez les témoignages clients affichés sur le site public</p>
        </div>
        <a href="<?= url('admin/temoignages/create') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Ajouter un Témoignage
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
            <div class="stat-icon"><i class="fa-solid fa-comments"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count($temoignages) ?></span>
                <span class="stat-label">Total Témoignages</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active"><i class="fa-solid fa-check"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($temoignages, fn($t) => $t['actif'])) ?></span>
                <span class="stat-label">Actifs</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon inactive"><i class="fa-solid fa-eye-slash"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($temoignages, fn($t) => !$t['actif'])) ?></span>
                <span class="stat-label">Inactifs</span>
            </div>
        </div>
    </div>

    <!-- Testimonials Table -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-table"></i> Liste des avis clients</h2>
        </div>
        <div class="card-body">
            <?php if (empty($temoignages)): ?>
                <div class="empty-state">
                    <i class="fa-solid fa-comment-slash"></i>
                    <p>Aucun témoignage trouvé.</p>
                    <a href="<?= url('admin/temoignages/create') ?>" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus"></i> Ajouter votre premier témoignage
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="data-table" id="temoignages-table">
                        <thead>
                            <tr>
                                <th class="th-image">Client</th>
                                <th>Nom</th>
                                <th>Fonction / Société</th>
                                <th>Message</th>
                                <th class="th-center">Statut</th>
                                <th class="th-center">Date</th>
                                <th class="th-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($temoignages as $t): ?>
                                <tr>
                                    <td class="td-image">
                                        <?php if ($t['photo']): ?>
                                            <img src="<?= asset('uploads/temoignages/' . e($t['photo'])) ?>" 
                                                 alt="<?= e($t['nom_client']) ?>" 
                                                 class="table-thumb" 
                                                 style="border-radius: 50%;">
                                        <?php else: ?>
                                            <div class="table-thumb-placeholder" style="border-radius: 50%;">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="td-title"><?= e($t['nom_client']) ?></td>
                                    <td>
                                        <span style="font-size: 13.5px; color: var(--text-secondary);">
                                            <?= e($t['fonction_client'] ?: 'Client') ?>
                                        </span>
                                    </td>
                                    <td class="td-desc" style="max-width: 350px;">
                                        <?= e(mb_strimwidth($t['message'] ?? '', 0, 90, '...')) ?>
                                    </td>
                                    <td class="td-center">
                                        <a href="<?= url('admin/temoignages/toggle/' . $t['id']) ?>" 
                                           class="badge <?= $t['actif'] ? 'badge-success' : 'badge-danger' ?>"
                                           title="Cliquer pour changer le statut">
                                            <?= $t['actif'] ? 'Actif' : 'Inactif' ?>
                                        </a>
                                    </td>
                                    <td class="td-center td-date">
                                        <?= date('d/m/Y', strtotime($t['date_creation'])) ?>
                                    </td>
                                    <td class="td-center td-actions">
                                        <a href="<?= url('admin/temoignages/edit/' . $t['id']) ?>" 
                                           class="btn-action btn-edit" title="Modifier">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= url('admin/temoignages/delete/' . $t['id']) ?>" 
                                           class="btn-action btn-delete" title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?');">
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
