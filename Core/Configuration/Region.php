<?php

# Definition of namespace
namespace Core\Configuration;

# Using required classes
use App\Settings;

# Definition of classname
class Region
{
    # Method for set-up this settings
    private function settings(): void
    {
        # Defining timezone configuration
        date_default_timezone_set(Settings::$timezone);
    }

    # Configuration method
    public function configure(): void
    {
        # Running configuration set-up method
        $this->settings();
    }
}