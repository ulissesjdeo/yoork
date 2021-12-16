<?php

# Definition of namespace
namespace App\Controllers;

# Use of required classes
use App\Models\ModelExample;
use Core\Controllers\Controller;

# Definition of classname
class CrudController extends Controller
{
    # Function Crud
    function Show(): void
    {
        # Verifying request method
        if ($this->METHOD == 'GET') {
            # Instancing model
            $inst = new ModelExample();

            # Getting database data
            $data['values'] = $inst->getInfo();

            # Sending data to view
            $this->view->data = $data;

            # Rendering page
            $this->render('crud/crud', 'base');
        } else {
            # Redirecting user
            $this->redirect('');
        }
    }

    # Function Add
    function Add(): void
    {
        # Verifying request method
        if ($this->METHOD == 'GET') {
            # Rendering page
            $this->render('crud/add', 'base');
        } else if ($this->METHOD == 'POST') {
            # Instancing model
            # OBS: "false" value is for protection for SQLInjection and XSS.
            $inst = new ModelExample(false);

            # Saving info in database
            $inst->addInfo([
                $this->POST['title'],
                $this->POST['description']
            ]);

            # Redirecting user
            $this->redirect('crud');
        }
    }

    # Function Edit
    function Edit(): void
    {
        # Verifying solicited method
        if ($this->METHOD == 'POST') {
            # Verifying solicited operation
            if ($this->POST['operation'] == 'edit') {
                # Instancing model
                $inst = new ModelExample();

                # Getting data per id using received id
                $data = $inst->getInfoPerId($this->POST['id']);
                # OR (both work's but the above example is simplest)
                # $data = $inst->getInfoPerColumn('id', $this->POST['id'], 'int');

                # Sending data to view
                $this->view->data = $data;

                # Rendering page
                $this->render('crud/edit', 'base');
            } else
            # Verifying solicited operation
            if ($this->POST['operation'] == 'save-edition') {
                # Instancing model
                $inst = new ModelExample();

                # Getting post values and actualizing database values
                $inst->updateInfo([
                    'title' => $this->POST['title'],
                    'description' => $this->POST['description']
                ], $this->POST['id']);

                # Redirecting user
                $this->redirect('crud');
            }
        } else {
            # Redirecting user
            $this->redirect('');
        }
    }

    # Function Remove
    function Remove(): void
    {
        # Verifying request method
        if ($this->METHOD == 'POST') {
            # Instancing model
            $inst = new ModelExample();

            # Removing database value that is equal to received id
            $inst->removeInfo($this->POST['id']);

            # Redirecting user
            $this->redirect('crud');
        } else {
            # Redirecting wrong request method
            $this->redirect('');
        }
    }
}