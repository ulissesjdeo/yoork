<?php

# Definition of namespace
namespace App;

# Definition of classname
class Settings
{
    // VERY IMPORTANT SETTINGS!

        // This is an error reporting configuration, take care about this value;
        public static int $errorReporting = E_USER_DEPRECATED;
        // RECOMMENDED: 0 (Production) or E_ALL (Development);

        // This is an important session configuration, take care about this value;
        public static string $timeForExpireSession = '3600';

        // This is an important session configuration, take care about this value;
        public static string $sessionName = 'YOORK';

        // This is an important session configuration, take care about this value;
        public static bool $autostartSession = true;

        // This is an important session configuration, take care about this value;
        public static bool $sessionHashFunction = true;
        // Possibilities: 0 / false = MD5 128 bits || 1 / true = SHA1 160 bits

        // This is an important cookies configuration, take care about this value;
        public static bool $blockJsAccessCookies = true;

        // This is an important cookies configuration, take care about this value;
        public static bool $sessionUseOnlyCookies = false;

        // This is an important URL configuration, take care about this value;
        public static bool $blockSessionInformationOnURL = true;

    // Database settings

        // SQLite database location;
        public static string $sqliteFileLocation = '../database.db';

    // Other settings

        // Application timezone;
        public static string $timezone = 'America/Sao_Paulo';

        // Extensions of the files for views;
        public static string $fileExtension = 'phtml';

    // Performance settings

        // Enable compression in server-side?
        public static bool $useCompression = true;
}