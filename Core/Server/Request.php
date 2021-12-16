<?php

# Definition of namespace
namespace Core\Server;

# Use required namespaces
use Core\Routes\Redirect;

# Definition of classname
class Request
{
    # Using traits
    use Redirect, Path;
}