<?php

# Definition of namespace
namespace Core;

# Definition of classname
use Core\Utils\Logger;
use Exception;

# Classname
class Autoload
{
    # Using this method to require
    private function require($class, $fileExtension='php'): void
    {
        # Requiring class
        require_once('../' . str_replace('\\', '/', $class) . '.' . $fileExtension);
    }

    # Using this method to start autoloading
    public function start(): void
    {
        # Using spl_autoload_register() and an anonymous function to receive called class and respective namespace
        spl_autoload_register(function (string $class)
        {
            # Starting try-catch
            try {
                # Requiring class
                $this->require($class);
            } catch (Exception $exception) {
                # Creating a log
                Logger::generateLog($exception);
            }
        });
    }
}