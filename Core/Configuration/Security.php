<?php

# Definition of namespace
namespace Core\Configuration;

# Using required classes
use App\Settings;

# Definition of classname
class Security
{
    # Method for set-up this settings
    private function settings(): void
    {
        # Defining a static and very critical security setting
        header('Server:');
        header('X-Powered-By:');
        header('X-Generator:');

        # Defining error reporting configuration
        error_reporting(Settings::$errorReporting);
    }

    # Configuration method
    public function configure(): void
    {
        # Running configuration set-up method
        $this->settings();
    }
}