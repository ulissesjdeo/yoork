<?php

# Definition of namespace
namespace App\Controllers;

# Use of required classes
use Core\Controllers\Controller;

# Definition of classname
class IndexController extends Controller
{
    # Function index
    function Index(): void
    {
        # Verifying request method
        if ($this->METHOD == 'GET') {
            # Rendering the page
            $this->render('index/index', 'base');
        }
    }
}