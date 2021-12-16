<?php

# Definition of namespace
namespace App\Models;

# Use of required classes
use Core\Models\Model;

# Definition of classname
class ModelExample extends Model
{
    # Using setStructure() function to for map database table structure
    protected function setStructure(): void
    {
        # Name of table (in database)
        $this->tableName = 'yoork';

        # Name of id column (in database)
        $this->idColumnName = 'id';

        # Name of all columns except id (in database)
        $this->columns = [
            'title',
            'description',
        ];
    }
}