<?php

/**
 * MD Design - Router Class
 * 
 * Maps incoming URL requests to the appropriate Controller and Method.
 * Supports static routes and dynamic parameter routes (e.g. services/detail/{id}).
 */
class Router {
    private array $routes = [];

    /**
     * Add a route to the routing table
     * 
     * @param string $route E.g. '/' or 'services/detail/{id}'
     * @param string $controllerMethod E.g. 'HomeController@index' or 'ServiceController@detail'
     * @return void
     */
    public function add(string $route, string $controllerMethod): void {
        // Normalize route by trimming slashes
        $route = trim($route, '/');
        $this->routes[$route] = $controllerMethod;
    }

    /**
     * Dispatch the current request to the matched controller action
     * 
     * @param string $url The request URI path
     * @return void
     */
    public function dispatch(string $url): void {
        // Parse the URL to get the path (strip query string parameters from matching)
        $parsedUrl = parse_url($url);
        $path = isset($parsedUrl['path']) ? trim($parsedUrl['path'], '/') : '';

        // 1. Direct exact match check
        if (array_key_exists($path, $this->routes)) {
            $controllerMethod = $this->routes[$path];
            $this->execute($controllerMethod);
            return;
        }

        // 2. Dynamic parameter pattern matching (e.g., services/detail/{id})
        foreach ($this->routes as $routePattern => $controllerMethod) {
            // Replace placeholders like {id} with regex capture groups ([a-zA-Z0-9_-]+)
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $routePattern);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Remove full match, leaving capture groups
                $this->execute($controllerMethod, $matches);
                return;
            }
        }

        // 3. Fallback: 404 Not Found
        header("HTTP/1.0 404 Not Found");
        if (file_exists(__DIR__ . '/../views/errors/404.php')) {
            require_once __DIR__ . '/../views/errors/404.php';
        } else {
            echo "<div style='font-family: sans-serif; text-align: center; padding: 50px;'>";
            echo "<h1 style='color: #FF7A00; font-size: 48px;'>404</h1>";
            echo "<h2>Page Non Trouvée</h2>";
            echo "<p>La page que vous recherchez n'existe pas ou a été déplacée.</p>";
            echo "<a href='" . APP_URL . "' style='color: #FF7A00; text-decoration: none; font-weight: bold;'>Retour à l'accueil</a>";
            echo "</div>";
        }
    }

    /**
     * Instantiates the controller and invokes the target method
     * 
     * @param string $controllerMethod
     * @param array $params
     * @return void
     */
    private function execute(string $controllerMethod, array $params = []): void {
        list($controllerName, $methodName) = explode('@', $controllerMethod);

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            die("Controller file not found: {$controllerName}.php");
        }

        // Load the controller file
        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            die("Controller class not found: {$controllerName}");
        }

        $controllerInstance = new $controllerName();

        if (!method_exists($controllerInstance, $methodName)) {
            die("Method {$methodName} not found in controller {$controllerName}");
        }

        // Invoke the action with parameter array
        call_user_func_array([$controllerInstance, $methodName], $params);
    }
}
