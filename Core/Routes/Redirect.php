<?php

# Definition of namespace
namespace Core\Routes;

# Definition of classname
trait Redirect
{
    # Absolute redirect function
    static public function redirect(string $path): void
    {
        # Redirecting
        header('Location: /' . $path);
    }
}