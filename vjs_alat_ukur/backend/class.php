<?php
class QueryInit {
    public $tableName;
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
?>