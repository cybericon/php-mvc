<?php

namespace Core\Base;

class Route
{
    /**
     * Stores all routes from app/routes.php file
     */
    protected static $routes = [];

    /**
     * Add all get routes in Self::$routes from routes.php file
     */
    public static function get($uri, $controller)
    {
        self::$routes['GET'][$uri] = $controller;
    }

    /**
     * Add all post routes in Self::$routes from routes.php file
     */
    public static function post($uri, $controller)
    {
        self::$routes['POST'][$uri] = $controller;
    }

    /**
     * @param uri : REQUEST_URI
     * @param method: REQUEST_METHOD
     * Takes two params  REQUEST_URI and REQUEST_METHOD
     * call callAction method with controller class and action name
     */
    public static function direct($uri, $method)
    {

        if (!key_exists($uri, self::$routes[$method])) {
            if (strpos($uri, '/')) {
                $arg = substr($uri, strpos($uri, '/') + 1);

                $keys = array_keys(self::$routes[$method]);

                $item = substr($uri, 0, strpos($uri, '/'));
                $item = $item . "/";

                $target = array_filter($keys, function ($val) use ($item) {
                    if (strstr($val, $item)) {
                        return true;
                    }
                    return false;
                });
                $target = array_values($target);
                $request_url = self::$routes[$method][$target[0]];
                $args[] = $arg;

                $method_parameters = explode('@', $request_url);
                $method_parameters[] = $args;
                self::callAction(
                    ...$method_parameters
                );

            } else {
                echo "<h1> 404!!! Page not found</h1>";
            }
        } else {
            $request_url = self::$routes[$method][$uri];
            $args = [];

            $method_parameters = explode('@', $request_url);
            $method_parameters[] = $args;
            self::callAction(
                ...$method_parameters
            );
        }
    }

    /**
     * @param controller: Controller Class to be initiated
     * @param action: method of Controller Class to be called
     * This method create new instance of Controller class and
     * call the action assigned in routes.
     */
    private static function callAction($controller, $action, $args = [])
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            echo "Method {$action} is not defined in {$controller}";
            die();
        }
        $controller->$action($args);

    }
}
