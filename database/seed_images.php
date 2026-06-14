<?php
/**
 * MD Design - Image Seed Script
 * Run this ONCE from browser: http://localhost/mddesign_pfe/database/seed_images.php
 * Or from CLI: php seed_images.php
 * 
 * This script:
 * 1. Clears existing services and realisations
 * 2. Inserts 6 services with real images
 * 3. Inserts 16 realisations with real images
 */

// Direct DB connection (no framework)
$host    = 'localhost';
$dbname  = 'md_design';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

echo "<pre>\n";
echo "=== MD Design Image Seeder ===\n\n";

// ---- 1. Clear existing data ----
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE `realisation`");
$pdo->exec("TRUNCATE TABLE `service`");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
echo "✓ Cleared existing services and realisations\n\n";

// ---- 2. Insert Services ----
$services = [
    [
        'nom'         => 'Enseignes publicitaires',
        'description' => "Conception et fabrication d'enseignes lumineuses, caissons lumineux et lettres en relief pour booster votre visibilité commerciale. Nous réalisons des enseignes sur mesure adaptées à votre identité visuelle : enseigne bandeau, caissons LED, lettres découpées inox ou PVC.",
        'image'       => 'eurotex.jpeg',
    ],
    [
        'nom'         => 'Habillage véhicules',
        'description' => "Marquage publicitaire partiel ou total pour transformer vos véhicules en supports publicitaires mobiles. Impression numérique haute résistance aux intempéries et UV sur films adhésifs calandrés. Idéal pour flottes commerciales.",
        'image'       => 'v1.jpeg',
    ],
    [
        'nom'         => 'Covering automobile',
        'description' => "Personnalisation complète de la carrosserie de vos véhicules de fonction avec des films adhésifs haut de gamme. Protection + communication en un seul geste. Films mat, brillant, satiné ou texturé disponibles.",
        'image'       => 'v3.jpeg',
    ],
    [
        'nom'         => 'Vitrophanie & film adhésif',
        'description' => "Décoration et communication sur vitrines, portes et surfaces vitrées avec des films adhésifs micro-perforés, dépolis ou imprimés personnalisés. Parfait pour boutiques, showrooms et bureaux.",
        'image'       => 'k.jpeg',
    ],
    [
        'nom'         => 'Impression numérique grand format',
        'description' => "Impression grand format sur bâche, vinyle autocollant, papier peint personnalisé, affiches et roll-up pour tous vos événements et campagnes publicitaires. Qualité photo garantie.",
        'image'       => 'caff.jpeg',
    ],
    [
        'nom'         => 'Signalétique & décoration intérieure',
        'description' => "Signalétique intérieure et extérieure, stickers muraux, lettres découpées et habillages de bureaux pour valoriser vos espaces professionnels. Du panneau de chantier à la décoration murale haut de gamme.",
        'image'       => 'mhb.jpeg',
    ],
];

$stmtService = $pdo->prepare("INSERT INTO `service` (`nom`, `description`, `image`, `actif`) VALUES (:nom, :description, :image, 1)");
$serviceIds  = [];

foreach ($services as $s) {
    $stmtService->execute($s);
    $serviceIds[$s['nom']] = (int)$pdo->lastInsertId();
    echo "✓ Service: {$s['nom']} (ID: {$serviceIds[$s['nom']]})\n";
}

echo "\n";

// ---- 3. Insert Realisations ----
$realisations = [
    // Enseignes publicitaires
    ['titre' => 'Enseigne Eurotex Tanger',           'image' => 'eurotex.jpeg',             'date' => '2024-03-15', 'service' => 'Enseignes publicitaires',              'desc' => "Réalisation d'une grande façade publicitaire pour la marque Peintures Eurotex à Tanger. Structure aluminium composite avec lettres en relief rouges et éclairage LED intégré."],
    ['titre' => 'Enseigne MLC Moto Lab Concept',      'image' => 'mlc.jpeg',                 'date' => '2024-05-20', 'service' => 'Enseignes publicitaires',              'desc' => "Fabrication et pose d'une enseigne caisson lumineux 3D pour le magasin MLC Moto Lab Concept à Tanger. Lettres découpées inox rétro-éclairées sur fond PVC noir."],
    ['titre' => 'Enseigne Hanane Computers',          'image' => 'hanan computers.jpeg',     'date' => '2024-02-10', 'service' => 'Enseignes publicitaires',              'desc' => "Enseigne bandeau grand format pour une boutique de matériel informatique. Fond tôlé laqué anthracite avec texte en vinyle découpé haute résistance aux UV."],
    ['titre' => 'Enseigne Gatitov Car Rental',        'image' => 'gatito.jpeg',              'date' => '2023-11-05', 'service' => 'Enseignes publicitaires',              'desc' => "Réalisation complète de la devanture publicitaire pour l'agence Gatitov Location de Voitures : enseigne bandeau LED, vitrine imprimée recto-verso et panneau latéral."],
    ['titre' => "Enseigne Jimmy's Fitness",           'image' => 'jimmy s fitness.jpeg',     'date' => '2024-01-18', 'service' => 'Enseignes publicitaires',              'desc' => "Enseigne lumineuse néon flex pour la salle de sport Jimmy's Fitness. Lettres en tube néon rouge et blanc sur cadre mural industriel. Effet néon rétro garanti."],
    ['titre' => 'Lettres relief Econer',              'image' => 'econer.jpeg',              'date' => '2023-12-18', 'service' => 'Enseignes publicitaires',              'desc' => "Fabrication de lettres en relief en PVC expansé 3D peint pour le comptoir d'accueil d'Econer, enseigne bleu marine et accent orange caractéristique de la marque."],
    // Habillage véhicules
    ['titre' => 'Habillage fourgon Ominta',           'image' => 'v1.jpeg',                  'date' => '2024-04-12', 'service' => 'Habillage véhicules',                  'desc' => "Habillage publicitaire complet d'un fourgon Renault Dokker pour la société Ominta. Impression numérique haute définition sur films adhésifs calandrés résistants aux intempéries."],
    ['titre' => 'Marquage véhicule IRT Foot',         'image' => 'v2.jpeg',                  'date' => '2024-06-01', 'service' => 'Habillage véhicules',                  'desc' => "Marquage partiel d'un SUV Suzuki Jimny pour le club de football IRT Tanger. Logos officiel, écusson et informations du site en vinyle découpé premium."],
    // Covering automobile
    ['titre' => 'Covering Dacia Logan - Isoltec',     'image' => 'v3.jpeg',                  'date' => '2023-09-22', 'service' => 'Covering automobile',                  'desc' => "Covering intégral d'une Dacia Logan pour la société Isoltec Tanger. Film adhésif qualité premium avec éléments graphiques de marque, coordonnées et QR code."],
    // Vitrophanie
    ['titre' => 'Vitrophanie DK Kam Beauté',          'image' => 'k.jpeg',                   'date' => '2024-03-08', 'service' => 'Vitrophanie & film adhésif',            'desc' => "Décoration de vitrine complète pour le centre de beauté DK Kam Beauté. Film dépoli personnalisé avec logo doré et liste des prestations sur porte double."],
    ['titre' => 'Roll-up Alain Afflelou',             'image' => 'alainafflelou.jpeg',       'date' => '2024-02-25', 'service' => 'Vitrophanie & film adhésif',            'desc' => "Impression et assemblage d'un roll-up promotionnel pour la campagne Tchin Tchin de la marque Alain Afflelou à Tanger. Format 85x200cm, bâche satiné haute résolution."],
    // Impression numérique
    ['titre' => 'Impression mur Knour - Alto Mall',   'image' => 'alto.jpeg',                'date' => '2024-01-30', 'service' => 'Impression numérique grand format',     'desc' => "Impression et pose de visuels publicitaires grand format sur les fenêtres d'un centre commercial à Tanger pour la campagne Knour. Format panoramique multi-panneaux."],
    ['titre' => 'Poster CAF AFCON Morocco 2025',      'image' => 'caff.jpeg',                'date' => '2025-12-21', 'service' => 'Impression numérique grand format',     'desc' => "Impression et pose d'une affiche grand format pour la Coupe d'Afrique des Nations Morocco 2025 pour le restaurant Terrasse Blvd Tanger."],
    // Signalétique & décoration
    ['titre' => 'Habillage mural MHBland',            'image' => 'mhb.jpeg',                 'date' => '2024-05-10', 'service' => 'Signalétique & décoration intérieure',  'desc' => "Conception et pose d'un sticker mural Company Values pour les bureaux de MHBland. Lettres découpées rouge et pictogrammes sur mur blanc, rendu épuré et professionnel."],
    ['titre' => 'Décoration murale Wol Gym',          'image' => 'clup.jpeg',                'date' => '2024-04-05', 'service' => 'Signalétique & décoration intérieure',  'desc' => "Habillage intérieur complet de la salle de sport Wol Gym : impression grand format sur bâche tendue avec visuels forts, branding rouge/noir et citation motivante."],
    ['titre' => 'Panneau VAR Stade Botola Pro',       'image' => 'varr.jpeg',                'date' => '2025-01-15', 'service' => 'Signalétique & décoration intérieure',  'desc' => "Fabrication et installation des panneaux VAR aux couleurs de la Botola Pro Inwi pour un stade marocain. Impression sur PVC rigide 3mm, finition UV mate."],
];

$stmtReal = $pdo->prepare("INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) VALUES (:titre, :desc, :image, :date, 1, :id_service)");

foreach ($realisations as $r) {
    $idService = $serviceIds[$r['service']] ?? null;
    if (!$idService) {
        echo "✗ Skipped (service not found): {$r['titre']}\n";
        continue;
    }
    $stmtReal->execute([
        'titre'      => $r['titre'],
        'desc'       => $r['desc'],
        'image'      => $r['image'],
        'date'       => $r['date'],
        'id_service' => $idService,
    ]);
    echo "✓ Réalisation: {$r['titre']}\n";
}

echo "\n=== Seeding complete! ===\n";
echo "Services: " . count($services) . "\n";
echo "Réalisations: " . count($realisations) . "\n";
echo "\nYou can now visit:\n";
echo "  → http://localhost/mddesign_pfe/public/services\n";
echo "  → http://localhost/mddesign_pfe/public/realisations\n";
echo "</pre>";
