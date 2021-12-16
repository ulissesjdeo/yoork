<?php

# Definition of namespace
namespace App;

# Definition of classname
class Routes extends \Core\Routes\Routes
{
    # Function to make routes work
    protected function initRoutes(): array
    {
        # "index" route
        $route[''] = ['IndexController', 'Index'];

        # Example crud routes

            # List route
            $route['crud'] = ['CrudController', 'Show'];

            # Add route
            $route['crud/add'] = ['CrudController', 'Add'];

            # Edit route
            $route['crud/edit'] = ['CrudController', 'Edit'];

            # Remove route
            $route['crud/remove'] = ['CrudController', 'Remove'];

        return $route;
    }
}