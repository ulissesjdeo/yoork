<?php

# Definition of namespace
namespace Core\Configuration;

# Using required classes
use App\Settings;

# Definition of classname
class Performance
{
    # Method for set-up this settings
    private function settings(): void
    {
        # If true, enable compression on server-side
        if (Settings::$useCompression) {
            ob_start('ob_gzhandler');
        }
    }

    # Configuration method
    public function configure(): void
    {
        # Running configuration set-up method
        $this->settings();
    }
}