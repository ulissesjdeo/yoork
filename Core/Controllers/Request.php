<?php

# Definition of namespace
namespace Core\Controllers;

# Using required classes
use Core\Server;

# Definition of classname
trait Request
{
    # Defining protected variables that can be herded
    protected array $GET;
    protected array $POST;
    protected string $METHOD;
    protected string $URL;
    protected string $PATH;
    protected string $FULL_PATH;

    # Defining redirect function
    protected function redirect(string $link): void
    {
        # Redirecting user
        Server\Request::redirect($link);
    }

    # Setting-up class variables values when instantiated
    public function __construct()
    {
        # Set get
        $this->GET = $_GET;
        # Set post
        $this->POST = $_POST;
        # Set request method
        $this->METHOD = $_SERVER['REQUEST_METHOD'];
        # Set url
        $this->URL = Server\Request::getPath();
        # Set path
        $this->PATH = Server\Request::getPath();
        # Set full-path
        $this->FULL_PATH = Server\Request::getFullPath();
    }
}