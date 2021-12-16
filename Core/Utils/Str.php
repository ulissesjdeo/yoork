<?php

# Definition of namespace
namespace Core\Utils;

# Definition of classname
use App\Settings;
use Exception;

class Str
{
    # Function to transform an array to a string
    static public function arrayToString(array $array, string $between=', ', string $around=''): string
    {
        try {
            # Starting values
            $counter = 0;
            $result = null;

            # Starting function logic
            foreach ($array as $value) {
                # Incrementing counter
                $counter = $counter + 1;

                # Function logic
                if ($counter != sizeof($array)) {
                    # Concatening with between value
                    $result .= $around.$value.$around.$between;
                } else {
                    # Concatening without between value
                    $result .= $around.$value.$around;
                }
            }

            # Returning result
            return($result);
        } catch (Exception $exception) {
        # Catching error
            # Verifying error reporting
            if (Settings::$errorReporting == E_ALL) {
                var_dump($exception);
            } else {
                Logger::generateLog($exception);
            }
            # Returning error variable
            return('We have an unexpected error.');
        }
    }

    # Function to do a treatment/sanitize data
    static public function safety(string $string): string
    {
        # Returning encoded the string with all suspect characters encoded
        return filter_var($string, FILTER_SANITIZE_STRING,
            # Encoding low ASCII characters
            FILTER_FLAG_ENCODE_LOW |
            # Encoding high ASCII characterrs
            FILTER_FLAG_ENCODE_HIGH |
            # Encoding special AMP character
            FILTER_FLAG_ENCODE_AMP
        );
    }
}