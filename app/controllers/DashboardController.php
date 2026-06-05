<?php

/**
 * MD Design - DashboardController
 * 
 * Manages back-office admin dashboard and statistics view.
 */
class DashboardController extends Controller {
    /**
     * Renders the admin dashboard main page
     * 
     * @return void
     */
    public function index(): void {
        // Enforce administrator authentication
        check_admin();

        $db = Database::getInstance();

        // Fetch counts for dashboard stats cards
        $servicesCount = $db->row("SELECT COUNT(*) AS total FROM `service`")['total'] ?? 0;
        $realisationsCount = $db->row("SELECT COUNT(*) AS total FROM `realisation`")['total'] ?? 0;
        $messagesCount = $db->row("SELECT COUNT(*) AS total FROM `contact`")['total'] ?? 0;
        $temoignagesCount = $db->row("SELECT COUNT(*) AS total FROM `temoignage`")['total'] ?? 0;
        $unreadMessagesCount = $db->row("SELECT COUNT(*) AS total FROM `contact` WHERE `lu` = 0")['total'] ?? 0;

        // Render dashboard layout view
        $this->view('admin/dashboard/index', [
            'title' => 'Tableau de bord',
            'servicesCount' => $servicesCount,
            'realisationsCount' => $realisationsCount,
            'messagesCount' => $messagesCount,
            'temoignagesCount' => $temoignagesCount,
            'unreadMessagesCount' => $unreadMessagesCount
        ]);
    }
}
