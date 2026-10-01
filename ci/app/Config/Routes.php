<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Accueil;
use App\Controllers\Compte;
use App\Controllers\Actualite;
use App\Controllers\Demande;

/**
 * @var RouteCollection $routes
 */

// Route par défaut pour l'URL racine
$routes->get('/', [Accueil::class, 'afficher']);

$routes->get('accueil/afficher', [Accueil::class, 'afficher']);

$routes->get('accueil/afficher/(:segment)', [Accueil::class, 'afficher']);

$routes->get('compte/lister', [Compte::class, 'lister']);

$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);

$routes->get('demande/afficher', [Demande::class, 'afficher']);
$routes->get('demande/afficher/(:segment)', [Demande::class, 'afficher']);

$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);

$routes->get('demande/enregistrer', [Demande::class, 'enregistrer']);
$routes->post('demande/enregistrer', [Demande::class, 'enregistrer']);

$routes->get('demande/verifier', [Demande::class, 'verifier']);
$routes->post('demande/verifier', [Demande::class, 'verifier']);


$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);

$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);

$routes->get('compte/afficher_reservation', [Compte::class, 'afficher_reservation']);

$routes->get('compte/afficher_message', [Compte::class, 'afficher_message']);

$routes->get('compte/afficher_msg', [Compte::class, 'afficher_msg']);
$routes->get('compte/afficher_msg/(:num)', [Compte::class, 'afficher_msg']);

$routes->get('compte/repondre', [Compte::class, 'repondre']);
$routes->match(['get', 'post'], 'compte/repondre/(:num)', 'Compte::repondre/$1');

$routes->get('compte/afficher_les_profils', [Compte::class, 'afficher_les_profils']);

$routes->get('compte/afficher_les_ressources', [Compte::class, 'afficher_les_ressources']);

$routes->get('compte/ajouter_res', [Compte::class, 'ajouter_res']);
$routes->post('compte/ajouter_res', [Compte::class, 'ajouter_res']);

$routes->get('compte/effacer_res', [Compte::class, 'effacer_res']);
$routes->get('compte/effacer_res/(:num)', [Compte::class, 'effacer_res']);

$routes->get('compte/voir_reservation', [Compte::class, 'voir_reservation']);
$routes->post('compte/voir_reservation', [Compte::class, 'voir_reservation']);


?>