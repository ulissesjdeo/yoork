<?php

# Definition of namespace
namespace Core\Utils;

# Definition of classname
use DateTime;

# Classname
class Logger
{
    # Function to generate a log
    static public function generateLog(string $content, string $filename=null, $savePath='../Logs/'): void
    {
        # Verifying if null
        if ($filename == null) {
            # Instancing datetime
            $datetime = new DateTime();
            # Getting current timestamp
            $filename = $datetime->getTimestamp();
        }
        # Generating log
        file_put_contents($savePath . $filename . '.log', $content);
    }
}