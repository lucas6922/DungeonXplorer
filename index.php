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

        // Enlève les barres obliques en trop
        $url = trim($url, '/');

        // Vérification de la correspondance de l'URL à une route définie
        foreach ($this->routes as $route => $controllerMethod) {
            // Vérifie si l'URL correspond à une route avec des paramètres
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) {
                // Vérification de chaque segment
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les paramètres
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Extraction du nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode avec les paramètres
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, gérer l'erreur 404
        require_once 'views/404.php';
    }
}

// Instanciation du routeur
$router = new Router('DungeonXplorer');

// Ajout des routes
$router->addRoute('', 'AccueilController@index'); // Pour la racine
$router->addRoute('personnages', 'PersonnageController@index'); //Pour afficher tout les personnages du compte
$router->addRoute('personnages/{id}', 'PersonnageController@show'); // Pour afficher les détail d'un personnage par ID
$router->addRoute('creation_compte', 'CompteController@form_create');
$router->addRoute('traitement_creation_compte', 'CompteController@create');
$router->addRoute('connexion', 'CompteController@form_login');
$router->addRoute('traitement_connexion', 'CompteController@login');
$router->addRoute('deconnexion', 'CompteController@logout');
$router->addRoute('infos_compte', 'CompteController@infos');
$router->addRoute('supprimer_compte', 'CompteController@delete');
$router->addRoute('chapitre/{id}', 'ChapterController@show');
$router->addRoute('creation_compte', 'CreationCompteController@index'); //Pour cree un compte
$router->addRoute('connexion', 'ConnexionController@index'); //se connecter à un compte déjà existant
$router->addRoute('traitement_creation_compte', 'CreationCompteController@verification'); //vérification des informations
$router->addRoute('creation_personnage', 'PersonnageController@nouveau');
$router->addRoute('fenetreCombat', 'fenetreCombatController@index');

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));

$connexion = null;