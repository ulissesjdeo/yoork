<?php

# Definition of namespace
namespace Core\Models;

# Using required classes
use App\Settings;
use Core\Utils\Logger;
use Core\Utils\Str;
use Exception;
use PDO;
use PDOException;

# Definition of classname
abstract class Model
{
    # Defining protected variables that can be herded
    protected PDO $db;
    protected string $tableName;
    protected array $columns;
    protected string $idColumnName;
    protected bool $protected;

    # Demand to write this function
    protected abstract function setStructure();

    # Function to work with database errors
    protected function error(PDOException $pdoException): bool
    {
        # Verifying error reporting
        if (Settings::$errorReporting == E_ALL) {
            # Dumping database error
            var_dump($pdoException);
        } else {
            try {
                Logger::generateLog($pdoException);
            } catch (Exception $exception) {
                # Warning about the file creation error
                echo('We have an unexpected error.');
            }
        }
        # Returning false
        return false;
    }

    # Using __construct() to execute this code when instantiated
    public function __construct(bool $protected=true)
    {
        # Setting-up $this->protected value
        $this->protected = $protected;

        # Running $this->setStructure
        $this->setStructure();

        # Trying database connection
        try {
            # Getting file location
            $location = Settings::$sqliteFileLocation;

            # Preparing string for instance
            $dsn = 'sqlite:' . $location;

            # Instacing connection
            $connection = new PDO($dsn);

            # Saving into connection reference into $this->db
            $this->db = $connection;
        } catch (PDOException $exception) {
            # Warning about the instance error
            echo('We have an unexpected database instance error.');
        }
    }

    # Function to get all info
    public function getInfo(string $orderBy='DESC')
    {
        # Security definitions
        if ($this->protected) {
            # If protected is true, do this treatment
            $tb = Str::safety($this->tableName);
        } else {
            # Else, only set the value
            $tb = $this->tableName;
        }

        # Function logic
        try {
            # Prepare the query
            $query = $this->db->prepare('SELECT * FROM ' . $tb . ' ORDER BY ' . $this->idColumnName . ' ' . $orderBy);

            # Execute the query
            $query->execute();

            # Returning received data because the operation has a success
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            # Run $this->error function
            return $this->error($exception);
        }
    }

    # Function to get specific info using a specific column and choosed value
    public function getInfoPerColumn(string $column, string $columnValue, $columnValueType='str')
    {
        # Security definitions
        if ($this->protected) {
            # If protected is true, do this treatments
            $column = Str::safety($column);
            $columnValue = Str::safety($columnValue);
        }

        # Setting variables
        if($columnValueType == 'str') {
            $columnValue = "'$columnValue'";
        }

        # Function logic
        try {
            # Prepare the query
            $query = $this->db->prepare('SELECT * FROM ' . $this->tableName . ' WHERE ' . $column . ' = ' . $columnValue);

            # Execute the query
            $query->execute();

            # Returning received data because the operation has a success
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            # Run $this->error function
            return $this->error($exception);
        }
    }

    # Function to get specific info using id
    public function getInfoPerId(int $id)
    {
        # Security definitions
        if ($this->protected) {
            # If protected is true, do this treatments
            $idColumnName = Str::safety($this->idColumnName);
            $tb = Str::safety($this->tableName);
            $id = Str::safety($id);
        } else {
            # Else, only set the values
            $idColumnName = $this->idColumnName;
            $tb = $this->tableName;
        }

        # Function logic
        try {
            # Prepare the query
            $query = $this->db->prepare('SELECT * FROM ' . $tb . ' WHERE ' . $idColumnName . ' = ?');

            # Biding values
            $query->bindValue(1, $id);

            # Execute the query
            $query->execute();

            # Returning received data because the operation has a success
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            # Run $this->error function
            return $this->error($exception);
        }
    }

    # Function for delete a tuple
    public function removeInfo(string $idColumnValue): bool
    {
        # Security definitions
        if ($this->protected) {
            # If protected is true, do this treatments
            $idColumnValue = Str::safety($idColumnValue);
            $idColumnName = Str::safety($this->idColumnName);
            $tb = Str::safety($this->tableName);
        } else {
            # Else, only set the values
            $idColumnName = $this->idColumnName;
            $tb = $this->tableName;
        }

        # Function logic
        try {
            # Prepare the query
            $query = $this->db->prepare('DELETE FROM ' . $tb . ' WHERE ' . $idColumnName . ' = ?');

            # Biding values
            $query->bindValue(1, $idColumnValue);

            # Execute the query
            $query->execute();

            # Returning true because the operation has a success
            return true;
        } catch (PDOException $exception) {
            # Run $this->error function
            return $this->error($exception);
        }
    }

    # Function to add a tuple
    public function addInfo(array $array): bool
    {
        # Generic definitions
        $names = Str::arrayToString($this->columns);

        # Security definitions
        if ($this->protected) {
            # If protected is true, do this treatments
            $names = Str::safety($names);
            foreach ($array as $key => $value) {
                $treated = Str::safety($value);
                $array[$key] = $treated;
            }
        } else {
            # Else, only set the values
            foreach ($array as $key => $value) {
                $treated = $value;
                $array[$key] = $treated;
            }
        }

        # Function logic
        $counter = 0;
        $table = $this->tableName;
        $query = 'INSERT INTO ' . $table . ' (' . $names . ') VALUES (';
        foreach ($array as $value) {
            $counter = $counter + 1;
            if ($counter == sizeof($array)) {
                $query .= '\'' . $value . '\'';
            } else {
                $query .= '\'' . $value . '\', ';
            }
        }
        $query = "$query)";
        try {
            # Prepare the query
            $query = $this->db->prepare($query);

            # Execute the query
            $query->execute();

            # Returning true because the operation has a success
            return true;
        } catch (PDOException $exception) {
            # Run $this->error function
            return $this->error($exception);
        }
    }

    # Function to update a tuple
    public function updateInfo(array $array, int $id, string $dataType='string'): bool
    {
        # Initializing values
        $treatedArray = null;

        # Security definitions
        if ($this->protected) {
            # If protected is true, do this treatments
            $idColumnName = Str::safety($this->idColumnName);
            $tb = Str::safety($this->tableName);
            $id = Str::safety($id);
            foreach ($array as $key => $value) {
                $treatedValue = Str::safety($value);
                $treatedKey = Str::safety($key);
                if ($dataType == 'string') {
                    $treatedValue = '\'' . $treatedValue . '\'';
                }
                $treatedArray[$treatedKey] = $treatedValue;
            }
        } else {
            # Else, only set the values
            $idColumnName = $this->idColumnName;
            $tb = $this->tableName;
            foreach ($array as $key => $value) {
                $treatedValue = $value;
                $treatedKey = $key;
                if ($dataType == 'string') {
                    $treatedValue = '\'' . $treatedValue . '\'';
                }
                $treatedArray[$treatedKey] = $treatedValue;
            }
        }

        # Starting values
        $counter = 0;

        # Function logic (mounting query)
        $query = 'UPDATE ' . $tb . ' SET ';
        foreach ($treatedArray as $key => $value) {
            $counter = $counter + 1;
            if ($counter != sizeof($treatedArray)) {
                $query .= $key . '=' . $value . ', ';
            } else {
                $query .= $key . '=' . $value;
            }
        }
        $query .= ' WHERE ' . $idColumnName . '=' . $id;

        try {
            # Prepare the query
            $query = $this->db->prepare($query);

            # Execute the query
            $query->execute();

            # Returning true because the operation has a success
            return true;
        } catch (PDOException $exception) {
            # Run $this->error function
            return $this->error($exception);
        }
    }
}