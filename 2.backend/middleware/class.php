<?php
class QueryInit {
    public $get;
    public $insert;
    public $update;
    public $delete;
    
    public function __construct($tableName) {
        $this->get = 'SELECT * FROM ' . $tableName;
        $this->insert = 'INSERT INTO ' . $tableName;
        $this->update = 'UPDATE ' . $tableName;
        $this->delete = 'DELETE FROM ' . $tableName;
    }

    public function getQuery() {
        return $this->get;
    }
    public function insertQuery() {
        return $this->insert;
    }
    public function updateQuery() {
        return $this->update;
    }
    public function deleteQuery() {
        return $this->delete;
    }
}

class Model {
    public $table;
    public $detail;
    public $field;
    public $get;
    public $insert;
    public $update;
    public $delete;

    public function __construct($table, $parameter) {
        foreach($parameter as $value) {
            $detail = explode("::", $value);
            $data = [
                'field' => $detail[0],
                'type' => $detail[1]
            ];
            $this->detail[] = $data;
            $this->field[] = $detail[0];
            }
        $this->table = $table;
        return;
    }
}

class DB_Access {
    public $connection; 
    public $get;
    public $insert;
    public $update;
    public $delete;

    public function __construct($db) {
        $connection = connectToDatabase($db);
        return $connection;
    }

    public function getQuery($table) {
        $query = 'SELECT * FROM ' . $table;
        $conn = $this->connection;
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $data = array(); 
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $result->free();
        $stmt->close();
        $conn->close();
        return $data;
    }
    public function insertQuery() {
        return $this->insert;
    }
    public function updateQuery() {
        return $this->update;
    }
    public function deleteQuery() {
        return $this->delete;
    }
}
?>