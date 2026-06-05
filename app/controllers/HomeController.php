<?php

/**
 * MD Design - HomeController
 * 
 * Manages public front-office landing pages.
 */
class HomeController extends Controller {
    /**
     * Renders the public landing / home page
     * 
     * @return void
     */
    public function index(): void {
        $this->view('home/index', [
            'title' => 'Accueil'
        ]);
    }
}
