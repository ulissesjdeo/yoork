<?php

# Definition of namespace
namespace Core\Views;

# Definition of classname
trait Statics
{
    # Function to use a static file
    static public function staticFile(string $file): string
    {
        # Concatening $file (that is filename with extension) to /static/ path on server
        return '/static/' . $file;
    }
}