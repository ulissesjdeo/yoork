<?php

# Definition of namespace
namespace Core\Routes;

# Using required namespaces;
use App\Settings;
use Core\Server;
use Core\Utils\Logger;
use Exception;

# Definition of classname
abstract class Routes
{
    # Defining class variables (only one in this case)
    protected array $routes;

    # Demand to write this function
    protected abstract function initRoutes();

    # The most important function that contain the "main logic" for Routes class
    protected function execute(string $url): void
    {
        try {
            # Function logic
            foreach ($this->routes as $path => $values) {
                # Verifying if solicited url is equal to routes variable path
                if ($url == '/' . $path) {
                    # If equal, proceed with the function

                    # Mounting controller path
                    $class = 'App\\Controllers\\' . $values[0];

                    # Instancing the controller
                    $controller = new $class;

                    # Defining the action to use
                    $action = $values[1];

                    # Running the route action with the route controller
                    $controller->$action();
                }
            }
        } catch (Exception $exception) {
            # Verifying error reporting
            if (Settings::$errorReporting == E_ALL) {
                # If E_ALL, dumping error
                var_dump($exception);
            } else {
                # Else, create a log
                Logger::generateLog($exception);
            }
        }
    }

    # Using __construct() to execute this code when instantiated
    public function run()
    {
        # Running initRoutes to receive App routes
        $this->routes = $this->initRoutes();

        # Running function routes() and using Request::getUrl() to get actual request Request
        $this->execute(Server\Request::getPath());
    }
}