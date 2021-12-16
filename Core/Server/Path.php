<?php

# Definition of namespace
namespace Core\Server;

# Definition of classname
trait Path
{
    # Function to get actual requested path in the url
    static public function getPath(): string
    {
        # Gathering the user solicited path using default php structure
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    # Function to get actual requested full-path in the url
    static public function getFullPath(): string
    {
        # Verifying protocol (HTTPS or HTTP)
        if (substr($_SERVER['SERVER_PROTOCOL'], 0, 5) == 'HTTPS') {
            # Setting-up protocol variable
            $protocol = 'HTTPS';
        } else {
            # Setting-up protocol variable
            $protocol = 'HTTP';
        }
        # Returning full-path variable
        return strtolower($protocol) . ':/' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}