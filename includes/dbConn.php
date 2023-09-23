<?php

class dbConn {
    private $connection;
    private $db_type;
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_port;
    private $posted_values;

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_PORT) {
        $this->db_type = $DB_TYPE;
        $this->db_host = $DB_HOST;
        $this->db_name = $DB_NAME;
        $this->db_user = $DB_USER;
        $this->db_pass = $DB_PASS;
        $this->db_port = $DB_PORT;
        $this->connection($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_PORT);
    }

    public function connection($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_PORT) {
        switch ($DB_TYPE) {
            case 'MySQLi':
                if ($DB_PORT !== null) {
                    $DB_HOST .= ":" . $DB_PORT;
                }
                $this->connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
                if ($this->connection->connect_error) {
                    return "Connection failed: " . $this->connection->connect_error;
                }
                break;
            case 'PDO':
                if ($DB_PORT !== null) {
                    $DB_HOST .= ":" . $DB_PORT;
                }
                try {
                    $this->connection = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
                    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Connection failed: " . $e->getMessage());
                }
                break;
        }
    }

    public function escape_values($posted_values): string {
        switch ($this->db_type) {
            case 'MySQLi':
                $this->posted_values = $this->connection->real_escape_string($posted_values);
                break;
            case 'PDO':
                $this->posted_values = addslashes($posted_values);
                break;
        }
        return $this->posted_values;
    }

    public function count_results($sql) {
        switch ($this->db_type) {
            case 'MySQLi':
                if (is_object($this->connection->query($sql))) {
                    $result = $this->connection->query($sql);
                    return $result->num_rows;
                } else {
                    print "Error 5: " . $sql . "<br />" . $this->connection->error . "<br />";
                }
                break;
            case 'PDO':
                $res = $this->connection->prepare($sql);
                $res->execute();
                return $res->rowCount();
                break;
        }
    }

    public function insert($table, $data) {
        ksort($data);
        $fieldDetails = NULL;
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = implode("', '", array_values($data));
        $sth = "INSERT INTO $table (`$fieldNames`) VALUES ('$fieldValues')";
        return $this->extracted($sth);
    }

    public function select($sql) {
        switch ($this->db_type) {
            case 'MySQLi':
                $result = $this->connection->query($sql);
                return $result->fetch_assoc();
                break;
            case 'PDO':
                $result = $this->connection->prepare($sql);
                $result->execute();
                return $result->fetchAll(PDO::FETCH_ASSOC)[0];
                break;
        }
    }

    public function getUsersInAscendingOrder() {
        $sql = "SELECT * FROM users ORDER BY signup_date ASC"; 

        switch ($this->db_type) {
            case 'MySQLi':
                $result = $this->connection->query($sql);
                if ($result) {
                    $users = $result->fetch_all(MYSQLI_ASSOC);
                    return $users;
                } else {
                    return "Error: " . $sql . "<br />" . $this->connection->error;
                }
                break;
            case 'PDO':
                try {
                    $result = $this->connection->query($sql);
                    if ($result) {
                        $users = $result->fetchAll(PDO::FETCH_ASSOC);
                        return $users;
                    } else {
                        return "Error: " . $sql . "<br />" . $this->connection->errorInfo()[2];
                    }
                } catch (PDOException $e) {
                    return "Error: " . $sql . "<br />" . $e->getMessage();
                }
                break;
        }
    }

    public function update($table, $data, $where) {
        $wer = '';
        if (is_array($where)) {
            foreach ($where as $clave => $value) {
                $wer .= $clave . "='" . $value . "' AND ";
            }
            $wer = substr($wer, 0, -4);
            $where = $wer;
        }
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $values) {
            $fieldDetails .= "$key='$values',";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        if ($where == NULL || $where == '') {
            $sth = "UPDATE $table SET $fieldDetails";
        } else {
            $sth = "UPDATE $table SET $fieldDetails WHERE $where";
        }
        return $this->extracted($sth);
    }

    public function delete($table, $where) {
        $wer = '';
        if (is_array($where)) {
            foreach ($where as $clave => $value) {
                $wer .= $clave . "='" . $value . "' and ";
            }
            $wer = substr($wer, 0, -4);
            $where = $wer;
        }
        if ($where == NULL || $where == '') {
            $sth = "DELETE FROM $table";
        } else {
            $sth = "DELETE FROM $table WHERE $where";
        }
        return $this->extracted($sth);
    }

    public function truncate($table) {
        $sth = "TRUNCATE $table";
        return $this->extracted($sth);
    }

    public function last_id() {
        switch ($this->db_type) {
            case 'MySQLi':
                return $this->connection->insert_id;
                break;
            case 'PDO':
                return $this->connection->lastInsertId();
                break;
        }
    }

    public function extracted(string $sth) {
        switch ($this->db_type) {
            case 'MySQLi':
                if ($this->connection->query($sth) === TRUE) {
                    return TRUE;
                } else {
                    return "Error: " . $sth . "<br />" . $this->connection->error;
                }
                break;
            case 'PDO':
                try {
                    $stmt = $this->connection->prepare($sth);
                    $stmt->execute();
                    return TRUE;
                } catch (PDOException $e) {
                    return "Error: " . $sth . "<br />" . $e->getMessage();
                }
                break;
        }
    }

    // Function to insert data into a specified table
    public function insertData($table, $data) {
        if (!empty($data)) {
            $fields = implode('`, `', array_keys($data));
            $values = implode("', '", array_values($data));

            $sql = "INSERT INTO $table (`$fields`) VALUES ('$values')";

            return $this->extracted($sql);
        } else {
            return "Error: Data array is empty.";
        }
    }
}

// Usage example to insert data into the 'users' table
$db = new dbConn('MySQLi', 'localhost', 'User details', 'your_username', 'your_password', null);

$dataToInsert = [
    'username' => 'john_doe',
    'email' => 'john.doe@example.com',
    'signup_date' => '2023-09-23',
    // Add more columns and values as needed
];

$result = $db->insertData('users', $dataToInsert);

if ($result === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $result;
}
