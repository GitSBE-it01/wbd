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
?>