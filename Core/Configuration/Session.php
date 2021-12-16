<?php

# Definition of namespace
namespace Core\Configuration;

# Using required classes
use App\Settings;

# Definition of classname
class Session
{
    # Method for set-up this settings
    private function settings(): void
    {
        # Getting actual timestamp
        $timestamp = time();

        # Defining session name
        session_name(Settings::$sessionName);

        # If enabled, executing session_start();
        if (Settings::$autostartSession) {
            session_start();
        }

        # First verify if timestamp is not set, if true ... (read next 2 lines)
        if (!isset($_SESSION['timestamp'])) {
            # Set actual timestamp
            $_SESSION['timestamp'] = $timestamp;
            # Verifying if session is expired
        } else if ($timestamp - $_SESSION['timestamp'] > Settings::$timeForExpireSession) {
            # Cleaning session
            $_SESSION = array();
            # Destroying session
            session_destroy();
        } else {
            # Renewing session
            $_SESSION['timestamp'] = $timestamp;
        }
    }

    # Configuration method
    public function configure(): void
    {
        # Running configuration set-up method
        $this->settings();
    }
}