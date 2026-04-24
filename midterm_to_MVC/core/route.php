<?php
    class Router {
        private array $routes = [];

        private function addRoute(string $method, string $uri, string $action): void {
            $this->routes[$method][$uri] = $action;
        }

        public function get(string $uri, string $action): void {
            $this->addRoute("GET", $uri, $action);
        }

        public function post(string $uri, string $action): void {
            $this->addRoute("POST", $uri, $action);
        }

        private function convertToRegex(string $route): string {
            /*
                Handle dynamic parameter (/users/{id})
                This turns: /users/{id} into #^/users/([^/]+)$#
            */
            $route = preg_replace("/\{[^}]+\}/", "([^/]+)", $route);
            return "#^" . $route . "$#";
        }

        private function callAction(string $action, array $params): void {
            [$controllerName, $method] = explode('@', $action);
            require_once ROOT_DIR . "/app/controllers/{$controllerName}.php";
            $controller = new $controllerName();
            call_user_func_array([$controller, $method], $params);          // For example: UserController->show(["name" => "John", "age": 69]) 
        }

        private function abort(): void {
            http_response_code(404);
            echo "<div>
                <h1 style='text-color: red;'>404 Not Found DCM</h1>
            </div>";
        }

        private function extractParamNames(string $route): array {
            /*
                When a route like this: /posts/{postID}/comments/{commentID}
                We need to:
                    - Extract parameter names -> postID, commentID
                    - Match values from URL
                    - Combine them into an associative array
            */
            preg_match_all("/\{([^}]+)\}/", $route, $matches);
            return $matches[1];                                 // only name inside {}
        }

        public function dispatch(string $requestURI, string $requestMethod): void {
            /*
                From $matches = ["10", "5"]
                Upgrade to: [
                    "postID" => "10",
                    "commentID" => "5"
                ] 
            */
            $requestURI = parse_url($requestURI, PHP_URL_PATH);
            echo "<div>URI: {$requestURI}</div>";
            echo "<div>Method: {$requestMethod}</div>";

            if (!isset($this->routes[$requestMethod])) {
                echo "<div>The request method ain't existed in defined routes!</div>";
                $this->abort();
            }

            foreach ($this->routes[$requestMethod] as $route => $action) {
                $pattern = $this->convertToRegex($route);

                if (preg_match($pattern, $requestURI, $matches)) {
                    array_shift($matches);                              // remove full match
                    $paramNames = $this->extractParamNames($route);
                    $params = array_combine($paramNames, $matches);
                    $this->callAction($action, $params);
                }
            }
        }
    }
?>