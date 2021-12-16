<?php

# Definition of namespace
namespace Core\Utils;

# Definition of classname
class Email
{
    # Function to verify if an email is valid or no, returns a boolean value
    static public function valid(string $email): bool
    {
        # Verify if the email is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            # If valid, return true
            return true;
        } else {
            # If invalid, return false
            return false;
        }
    }

}