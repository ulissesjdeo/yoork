<?php

# Definition of namespace
namespace Core\Controllers;

# Definition of classname
abstract class Controller
{
    # Using traits
    use Action, Request {
        # Fixing method names conflicts
        Action::__construct as actionConstructor;
        Request::__construct as requestConstructor;
    }

    # Setting-up constructor method
    public function __construct()
    {
        # Calling methods
        $this->requestConstructor();
        $this->actionConstructor();
    }
}