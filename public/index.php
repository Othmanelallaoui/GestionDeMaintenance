<?php

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

// Minimum version de PHP requise
$minPhpVersion = '8.1'; // Si vous mettez à jour cela, n'oubliez pas de mettre à jour `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Votre version de PHP doit être %s ou supérieure pour exécuter CodeIgniter. Version actuelle : %s',
        $minPhpVersion,
        PHP_VERSION
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Chemin vers le contrôleur frontal (ce fichier)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Assurez-vous que le répertoire courant pointe vers le répertoire du contrôleur frontal
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * Ce processus configure les constantes de chemin, charge et enregistre
 * notre autoloader, ainsi que celui de Composer, charge nos constantes
 * et lance un démarrage spécifique à l'environnement.
 */

// CHARGER NOTRE FICHIER DE CONFIGURATION DES CHEMINS
// Cette ligne peut nécessiter une modification en fonction de votre structure de dossiers.
require FCPATH . '../app/Config/Paths.php';
// ^^^ Changez cette ligne si vous déplacez votre dossier d'application

$paths = new Config\Paths();

// CHARGER LE FICHIER DE DÉMARRAGE DU FRAMEWORK
require $paths->systemDirectory . '/Boot.php';

// Exécute le démarrage de CodeIgniter
exit(CodeIgniter\Boot::bootWeb($paths));
