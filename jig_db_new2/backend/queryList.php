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

$jig_master = new QueryInit('jig_master');
$log_master = new QueryInit('log_master');
$jig_function = new QueryInit('jig_function');
$log_function = new QueryInit('log_function');
$list_location = new QueryInit('list_location');


$codeList = array(
    'jig_master'=>$jig_master,
    'log_master'=>$log_master,
    'jig_function'=>$jig_function,
    'log_function'=>$log_function,
    'list_location'=>$list_location,
);


?>