<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

<main class="admin-main">
    <div class="admin-topbar">
        <div class="topbar-left">
            <h1 class="page-title"><i class="fa-solid fa-inbox"></i> <?= e($title) ?></h1>
            <p class="page-subtitle">Consultez et gérez les messages envoyés depuis le formulaire de contact</p>
        </div>
    </div>

    <?php
    // Retrieve and display flash messages
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
            <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count($messages) ?></span>
                <span class="stat-label">Total Messages</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active"><i class="fa-solid fa-envelope-open"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($messages, fn($m) => !$m['lu'])) ?></span>
                <span class="stat-label">Non Lus (Nouveaux)</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon inactive"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= count(array_filter($messages, fn($m) => $m['lu'])) ?></span>
                <span class="stat-label">Messages Lus</span>
            </div>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-envelope-open-text"></i> Messages reçus</h2>
        </div>
        <div class="card-body" style="padding: 0;">
            <?php if (empty($messages)): ?>
                <div class="empty-state" style="padding: 60px 24px;">
                    <i class="fa-solid fa-folder-open"></i>
                    <p>Aucun message dans votre boîte de réception.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="data-table" id="messages-table">
                        <thead>
                            <tr>
                                <th style="width: 200px; padding: 16px;">Expéditeur</th>
                                <th style="width: 250px;">Sujet</th>
                                <th>Message</th>
                                <th class="th-center" style="width: 120px;">Statut</th>
                                <th class="th-center" style="width: 120px;">Reçu le</th>
                                <th class="th-center" style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $msg): ?>
                                <tr style="<?= !$msg['lu'] ? 'background-color: rgba(255, 122, 0, 0.03); font-weight: 500;' : '' ?>">
                                    <td style="padding: 16px; vertical-align: top;">
                                        <div class="td-title" style="font-size: 14.5px; color: var(--text-primary);"><?= e($msg['nom_complet']) ?></div>
                                        <div style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">
                                            <a href="mailto:<?= e($msg['email']) ?>" style="color: var(--primary-color); text-decoration: none;"><i class="fa-solid fa-envelope"></i> <?= e($msg['email']) ?></a>
                                        </div>
                                        <?php if (!empty($msg['telephone'])): ?>
                                            <div style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">
                                                <a href="tel:<?= e($msg['telephone']) ?>" style="color: var(--text-secondary); text-decoration: none;"><i class="fa-solid fa-phone"></i> <?= e($msg['telephone']) ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: top; padding: 16px; color: var(--white); font-weight: <?= !$msg['lu'] ? '700' : '400' ?>;">
                                        <?= e($msg['sujet']) ?>
                                    </td>
                                    <td style="vertical-align: top; padding: 16px; color: var(--text-secondary); font-size: 13.5px; line-height: 1.6; max-width: 400px; white-space: pre-wrap;">
                                        <?= e($msg['message']) ?>
                                    </td>
                                    <td class="td-center" style="vertical-align: top; padding: 16px;">
                                        <?php if (!$msg['lu']): ?>
                                            <a href="<?= url('admin/messages/read/' . $msg['id']) ?>" 
                                               class="badge badge-danger" 
                                               title="Cliquer pour marquer comme lu">
                                                Nouveau
                                            </a>
                                        <?php else: ?>
                                            <span class="badge" style="background: rgba(255,255,255,0.06); color: var(--text-muted); border: 1px solid rgba(255,255,255,0.1);">
                                                Lu
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="td-center td-date" style="vertical-align: top; padding: 16px;">
                                        <?= date('d/m/Y H:i', strtotime($msg['date_envoi'])) ?>
                                    </td>
                                    <td class="td-center td-actions" style="vertical-align: top; padding: 16px;">
                                        <?php if (!$msg['lu']): ?>
                                            <a href="<?= url('admin/messages/read/' . $msg['id']) ?>" 
                                               class="btn-action btn-edit" 
                                               title="Marquer comme lu"
                                               style="color: var(--success);">
                                                <i class="fa-solid fa-envelope-open"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= url('admin/messages/delete/' . $msg['id']) ?>" 
                                           class="btn-action btn-delete" 
                                           title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message de contact ?');">
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
