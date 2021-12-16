<?php

# Definition of namespace
namespace Core\Configuration;

# Using required classes
use App\Settings;

# Definition of classname
class Ini
{
    # Method for set-up this settings
    private function settings(): void
    {
        # Defining if session can use only cookies
        ini_set('session.use_only_ cookies', Settings::$sessionUseOnlyCookies);

        # Setting-up php session hash function
        ini_set('session.hash_function', Settings::$sessionHashFunction);

        # Block for javascript access cookies
        ini_set('session.cookie_httponly', Settings::$blockJsAccessCookies);

        # Block session information on URL
        ini_set('session.use_trans_sid', Settings::$blockSessionInformationOnURL);
    }

    # Configuration method
    public function configure(): void
    {
        # Running configuration set-up method
        $this->settings();
    }
}