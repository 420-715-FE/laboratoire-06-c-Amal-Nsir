<?php
require_once __DIR__ . '/../Database.php';

class Router {
    private $controller;
    private $action;
    private $params = [];

    public function routeReq() {
        try {
            
            $db = (new Database())->getConnection();

            
            spl_autoload_register(function ($class) {
                if (file_exists("controllers/$class.php")) {
                    require_once("controllers/$class.php");
                } elseif (file_exists("models/$class.php")) {
                    require_once("models/$class.php");
                }
            });

            
            $url = $_GET['url'] ?? 'photo/displayGallery';
            $urlParts = explode('/', filter_var($url, FILTER_SANITIZE_URL));

            $controllerName = ucfirst(strtolower($urlParts[0])) . 'Controller';
            $action = $urlParts[1] ?? 'displayGallery';
            $this->params = array_slice($urlParts, 2); 

            
            $controllerFile = "controllers/$controllerName.php";
            if (!file_exists($controllerFile)) {
                throw new Exception("Contrôleur $controllerName non trouvé.");
            }

            require_once($controllerFile);
            $this->controller = new $controllerName($db);

            
            if (!method_exists($this->controller, $action)) {
                throw new Exception("Méthode $action non trouvée dans $controllerName.");
            }

            
            call_user_func_array([$this->controller, $action], $this->params);
        } catch (Exception $e) {
           
            require_once(__DIR__ . '/../404.php');
            exit;
        }
    }
}
?>