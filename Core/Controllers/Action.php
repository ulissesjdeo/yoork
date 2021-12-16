<?php

# Definition of namespace
namespace Core\Controllers;

# Using required classes
use App\Settings;
use Core\Utils\Logger;
use Exception;
use stdClass;

# Definition of classname
trait Action
{
    # Defining protected variables that can be herded
    protected stdClass $view;
    protected string $fileExtension;

    # Using __construct() to execute this code when instantiated
    public function __construct()
    {
        # Instancing a stdClass to put values that can be used in the view
        $this->view = new stdClass();

        # Pulling fileExtension value
        $this->fileExtension = Settings::$fileExtension;

    }

    # Function to pull "middle content" into the layout
    protected function content(): void
    {
        # Saving data to instantiated stdClass
        $page = $this->view->page;

        # Require the page
        try {
            # Requiring
            require_once('../App/Views/' . $page . '.' . $this->fileExtension);
        } catch (Exception $exception) {
            # Creating a log
            Logger::generateLog($exception);
        }
    }

    # Function to render a page and your layout or only the page
    protected function render(string $view, string $layout=null): void
    {
        # Defining necessary values
        $this->view->page = $view;

        # Verify if layout is different of null
        if ($layout != null) {
            # Requiring layout to be used with the view
            try {
                # Requiring
                require_once('../App/Views/' . $layout . '.' . $this->fileExtension);
            } catch (Exception $exception) {
                # Creating a log
                Logger::generateLog($exception);
            }
        } else {
            # Requiring only the view
            try {
                # Requiring
                require_once('../App/Views/' . $view . '.' . $this->fileExtension);
            } catch (Exception $exception) {
                # Creating a log
                Logger::generateLog($exception);
            }
        }
    }
}