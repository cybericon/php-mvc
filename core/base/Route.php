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
        // checking if requested url is not in defined routes
        if (!key_exists($uri, self::$routes[$method])) {
            // checking if requested url resemble format model/{model}
            if (strpos($uri, '/') > 0) {

                // extracting arg from url( 23 from model/23 )
                $arg = substr($uri, strpos($uri, '/') + 1);

                // extracting resource from url( model from model/23 )
                $resource = substr($uri, 0, strpos($uri, '/') + 1);

                // all defined keys/resources in routes
                $route_keys = array_keys(self::$routes[$method]);

                // building url pattern to look in routes ( model/{id} )
                $target;
                array_filter($route_keys, function ($val) use ($resource, &$target) {
                    if (strstr($val, $resource)) {
                        $target = $val;
                        return;
                    }
                    return;
                });

                // extracting action assign to route ( modeController@action )
                $request_action = self::$routes[$method][$target];

                // Preparing array of parameters for callAction method callAction(controller, method, arg)
                // exploding request_action to add first two parameters i.e. controller, method
                $method_parameters = explode('@', $request_action);
                // Adding 3rd parameter to prepared array
                $method_parameters[] = $arg;

                // Calling action method
                self::callAction(
                    ...$method_parameters
                );

            } else {
                echo "<h1> 404!!! Page not found</h1>";
            }
        } else {
            // Action assigned to route
            $request_action = self::$routes[$method][$uri];
            // preparing empy arg
            $arg = '';

            // Preparing array of parameters for callAction method callAction(controller, method, arg)
            // exploding request_action to add first two parameters i.e. controller, method
            $method_parameters = explode('@', $request_action);
            // Adding 3rd parameter to prepared array
            $method_parameters[] = $arg;

            // Calling action method
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
    private static function callAction($controller, $action, $arg = '')
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            echo "Method {$action} is not defined in {$controller}";
            die();
        }
        $controller->$action($arg);

    }
}
