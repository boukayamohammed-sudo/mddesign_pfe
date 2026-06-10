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
        $serviceModel = new Service();
        $realisationModel = new Realisation();
        $temoignageModel = new Temoignage();

        // Retrieve popular active services (limit 3)
        $popularServices = Database::getInstance()->all("SELECT * FROM `service` WHERE `actif` = 1 ORDER BY `id` ASC LIMIT 3");

        // Retrieve recent active realizations (limit 4)
        $recentRealisations = array_slice($realisationModel->allActiveWithService(), 0, 4);

        // Retrieve active testimonials
        $testimonials = $temoignageModel->allActive();

        // Retrieve stats
        $stats = Database::getInstance()->all("SELECT * FROM `statistique` LIMIT 4");

        $this->view('home/index', [
            'title'              => 'Accueil',
            'popularServices'    => $popularServices,
            'recentRealisations' => $recentRealisations,
            'testimonials'       => $testimonials,
            'stats'              => $stats
        ]);
    }

    /**
     * Renders the public About page
     * 
     * @return void
     */
    public function about(): void {
        $this->view('home/about', [
            'title' => 'À Propos'
        ]);
    }
}
