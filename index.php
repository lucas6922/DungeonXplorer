<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';
require_once 'database/connexion_db.php';
$connexion = connect_db();

class Router
{
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url)
    {
        // Enlève le préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }

        // Nettoie l'URL
        $url = trim($url, '/');

        // Vérification des routes
        foreach ($this->routes as $route => $controllerMethod) {
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Vérifie si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) {
                $params = [];
                $isMatch = true;

                // Parcours chaque segment
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les segments dynamiques (comme {id})
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Instancie le contrôleur et appelle la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();

                        if (method_exists($controller, $methodName)) {
                            call_user_func_array([$controller, $methodName], $params);
                            return;
                        } else {
                            throw new Exception("Méthode $methodName introuvable dans le contrôleur $controllerName.");
                        }
                    } else {
                        throw new Exception("Contrôleur $controllerName introuvable.");
                    }
                }
            }
        }

        // Si aucune route ne correspond, afficher une page 404
        require_once 'views/404.php';
    }
}

// Instanciation du routeur
$router = new Router('DungeonXplorer');

// Pour la racine
$router->addRoute('', 'AccueilController@index');
$router->addRoute('/', 'AccueilController@index');

//route pour la vue de cration d'un compte
$router->addRoute('creation_compte', 'CompteController@form_create');
//traitement du formulaire de la creatio nd'un compte
$router->addRoute('traitement_creation_compte/{id}', 'CompteController@create');

$router->addRoute('connexion', 'CompteController@form_login');
$router->addRoute('traitement_connexion', 'CompteController@login');
$router->addRoute('deconnexion', 'CompteController@logout');
$router->addRoute('infos_compte', 'CompteController@infos');
$router->addRoute('supprimer_compte', 'CompteController@delete');
//vue d'un chapitre
$router->addRoute('chapitre', 'ChapterController@show');
$router->addRoute('chapitre/{id}', 'ChapterController@showID');
//$router->addRoute('chapitre', 'ChapterController@show');
//routes pour la création d'un perso
$router->addRoute('creation_personnage', 'PersonnageController@nouveau');
$router->addRoute('traitement_creation_personnage', 'PersonnageController@creer');

//routes pour l'affichage des perso associé au joueur co
$router->addRoute('personnages', 'PersonnageController@afficherPersonnages');

//route pour le combat
$router->addRoute('combat', 'fenetreCombatController@combat');



//route pour acceder au pannel admin
$router->addRoute('pannel_admin/pannel_admin_accueil', 'AdminController@showPannelAdmin');
$router->addRoute('pannel_admin/joueurs', 'AdminController@gererJoueurs');
$router->addRoute('pannel_admin/chapitres', 'AdminController@gererChapitres');
$router->addRoute('pannel_admin/monstres', 'AdminController@gererMonstres');
$router->addRoute('pannel_admin/tresors', 'AdminController@gererTresors');
$router->addRoute('pannel_admin/images', 'AdminController@gererImages');


//route pour le formulaire de suppresion d'un joueur
$router->addRoute('pannel_admin/supprimer_joueur', 'AdminController@supprimerJoueur');
$router->addRoute('pannel_admin/creation_compte_admin', 'AdminController@ajoutCompteAdmin');

//suppresion d'un chapitre depuis le pannel admin
$router->addRoute('pannel_admin/supprimer_chapitre', 'AdminController@supprimerChapitre');
//formulaire d'ajout d'un chapitre
$router->addRoute('pannel_admin/creation_chapitre', 'AdminController@formAjoutChapitre');
//traitement formulaire d'ajout d'un chapitre
$router->addRoute('pannel_admin/ajoutChapitre', 'AdminController@ajoutChapitre');

//formulaire de modification d'un chapitre
$router->addRoute('pannel_admin/modifier_chapitre', 'AdminController@formModifChap');
//traitement modif chapitre
$router->addRoute('pannel_admin/modifier_chapitre_traitement', 'AdminController@ModifChap');

//supprime monstre
$router->addRoute('pannel_admin/supprimer_monstre', 'AdminController@supprimerMonstre');
//form nouveau monstre
$router->addRoute('pannel_admin/creation_monstre', 'AdminController@formAjoutMonstre');
//traitement ajout monstre
$router->addRoute('pannel_admin/ajoutMonstre', 'AdminController@ajoutMonstre');



// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));

$connexion = null;
