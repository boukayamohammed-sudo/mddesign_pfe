<?php

/**
 * MD Design - AuthController
 * 
 * Manages administrator login and logout processes.
 */
class AuthController extends Controller {
    /**
     * Handles the login page view and POST submission
     * 
     * @return void
     */
    public function login(): void {
        $session = new Session();

        // Redirect to dashboard if session already established
        if ($session->has('admin_logged')) {
            $this->redirect('admin/dashboard');
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                $adminModel = new Admin();
                if ($adminModel->authenticate($username, $password)) {
                    $this->redirect('admin/dashboard');
                } else {
                    $error = "Identifiants incorrects.";
                }
            }
        }

        // Render view template
        $this->view('auth/login', ['error' => $error]);
    }

    /**
     * Destroys the administrator session and redirects to login
     * 
     * @return void
     */
    public function logout(): void {
        $session = new Session();
        $session->destroy();
        $this->redirect('login');
    }
}
