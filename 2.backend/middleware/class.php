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
    public $type;
    public $field;
    public $primary_key;

    public function __construct($table, $parameter, $pk) {
        foreach($parameter as $value) {
            $raw = explode("::", $value);
            $this->type[$raw[0]] = $raw[1];
            $this->field[] = $raw[0];
        }
        $raw_pk = explode("::", $pk);
        $this->primary_key =  [
            'field'=>$raw_pk[0],
            'type'=>$raw_pk[1]
        ];
        $this->table = $table;
        return;
    }
}

class DB_Access {
    public $connection1; 
    public $connection2; 
    public $get;
    public $insert;
    public $update;
    public $delete;

    public function __construct($db) {
        $this->connection1 = connectToDatabase($db);
        $this->connection2 = connectToDatabaseNew($db);
        return;
    }

    public function getQuery($action, $model) {
        $conn = $this->connection1;
        if($action === 'get2') {
            $conn = $this->connection2;
        }
        $query = 'SELECT * FROM ' . $model->table;
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $json_data = array(); 
        while ($row = $result->fetch_assoc()) {
            $json_data[] = $row; 
        }
        $result->free();
        $stmt->close();
        $conn->close();
        return $json_data;
    }

    public function fetchQuery($action, $model, $data) {
        $conn = $this->connection1;
        if($action === 'fetch2') {
            $conn = $this->connection2;
        }
        $param =  '';
        $types = '';
        $bindParams = array();
        foreach($data as $key=>$value) {
            if ($value === " ") {
                $param .= "`$key` is NULL OR ";
            } elseif ($value === 'IS NOT NULL') {
                $param .= "`$key` IS NOT NULL OR ";
            } else {
                $param .= "`$key` = ? OR ";
                $bindParams[] = &$data[$key];
            }
            $types .= $model->type[$key];
        }
        $param = rtrim($param, 'OR ');
        $query = 'SELECT * FROM '.$model->table;

        if (!empty($param)) {
            $query .= " WHERE ".$param;
        }

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
    
        if (!empty($types)) {
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
        }
    
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $json_data = array();
        while ($row = $result->fetch_assoc()) {
            $json_data[] = $row;
        }
        
        $result->free();
        $stmt->close();
        $conn->close();
        return $json_data;
    }

    public function insertQuery($action, $model, $data) {
        $conn = $this->connection1;
        if($action === 'insert2') {
            $conn = $this->connection2;
        }
        $field ='';
        $param = '';
        $types = '';
        $mdl = (array) $model->field;
        sort($mdl);
        foreach($mdl as $value) {
            $field .= $value.", ";
            $types .= $model->type[$value];
            $param .= '?, ';
        }
        $field = rtrim($field, ', ');
        $param = rtrim($param, ', ');

        $query = "INSERT INTO ".$model->table." (".$field.") VALUES (".$param.")";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        set_time_limit(3600);
        foreach($data as $set) {
            $bindParams = array();
            ksort($set);
            foreach($set as $key=>$value) {
                if(in_array($key,$mdl)) {
                    ${'param' . $key} = $value;
                    $bindParams[] = &${'param' . $key};
                }
            }
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            } else {
                $result = "success";
            }
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function updateQuery($action, $model, $data) {
        $conn = $this->connection1;
        if($action === 'update2') {
            $conn = $this->connection2;
        }
        $field ='';
        $types = '';
        $pk = $model->primary_key;
        $param = $pk['field']."=?";
        $mdl = (array) $model->field;
        sort($mdl);
        foreach($mdl as $value) {
            $field .= $value."=?, ";
            $types .= $model->type[$value];
        }
        $field = rtrim($field, ', ');
        $types .=$pk['type'];
        
        $query = "UPDATE ".$model->table." SET ".$field." WHERE ".$param;
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        set_time_limit(3600);
        foreach($data as $set) {
            $bindParams = array();
            ksort($set);
            foreach($mdl as $val) {
                ${'param' . $val} = $set[$val];
                $bindParams[] = &${'param' . $val};
            }  
            ${'param'.$pk['field']} = $set[$pk['field']];
            $bindParams[] = &${'param'.$pk['field']};
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            } else {
                $result = "success ";
            }
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function deleteQuery($action, $model, $data) {
        $conn = $this->connection1;
        if($action === 'delete2') {
            $conn = $this->connection2;
        }
        $pk = $model->primary_key;
        $param = $pk['field']."=?";
        $types =$pk['type'];
        $query = "DELETE FROM ".$model->table." WHERE ".$param;
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        set_time_limit(3600);
        foreach($data as $set) {
            $bindParams = array();
            ${'param'.$pk['field']} = $set[$pk['field']];
            $bindParams[] = &${'param'.$pk['field']};
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            } else {
                $result = "success ";
            }
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function customQuery($db, $query, $types, $data) {
        $conn = $this->connection1;
        if($db === 'new') {
            $conn = $this->connection2;
        }
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        set_time_limit(3600);
        if($types !=='') {
            $counter = 0;
            $bindParams = array();
            foreach($data as $set) {
                if(is_array($set)) {
                    foreach($set as $value ){
                        ${'param'.$counter} = $value;
                        $bindParams[] = &${'param'.$counter};
                        $counter++;
                    }
                } else {
                    ${'param'.$counter} = $set;
                    $bindParams[] = &${'param'.$counter};
                    $counter++;
                }
            }
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        } else {
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        }

        if (substr($query,0, 6) === 'SELECT') {
            $result = $stmt->get_result();
            $json_data = array();
            while ($row = $result->fetch_assoc()) {
                $json_data[] = $row;
            }
            
            $result->free();
            $stmt->close();
            $conn->close();
            return $json_data;
        } 
        return 'success';
    }
}

class DB {
    static $db = 'db_wbd';
    
    static function execQuery($query, $types, $data=[], $_db='') {
        $conn = connectToDatabase(DB::$db);
        if($_db === 'new') {
            $conn = connectToDatabaseNew(DB::$db);
        }

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $cek = explode(" ", $query);
        set_time_limit(3600);
        switch($cek[0]){
            case "SELECT":
                $bindParams = array();
                if(count($data) !== 0) {
                    foreach($data as $key=>$value) {
                        $bindParams[] = &$data[$key];
                    }
                    array_unshift($bindParams, $types);
                    try {
                        call_user_func_array([$stmt, 'bind_param'], $bindParams);
                    }  catch (Exception $e) {
                        $errorMessage = $e->getMessage();
                        $response = $errorMessage.'</br>';
                        return;
                    }
                }
                if (!$stmt->execute()) {
                    die("Execute failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                $response = array();
                while ($row = $result->fetch_assoc()) {
                    $response[] = $row;
                }
                $result->free();
                break;
            case "INSERT":
            case "UPDATE":
            case "DELETE":
                if(isset($data[0])) {
                    foreach($data as $set) {
                        $bindParams = array();
                        foreach($set as $key=>$value) {
                            ${'param' . $key} = $value;
                            $bindParams[] = &${'param' . $key};
                        }
                        array_unshift($bindParams, $types);
                        try {
                            call_user_func_array([$stmt, 'bind_param'], $bindParams);
                        }  catch (Exception $e) {
                            $errorMessage = $e->getMessage();
                            $response = $errorMessage.'</br>';
                            return;
                        }
                        if (!$stmt->execute()) {
                            die("Execute failed: " . $stmt->error);
                        } else {
                            $response = "success";
                        }
                    }
                } else {
                    $bindParams = array();
                    foreach($data as $key=>$value) {
                        $bindParams[] = &$data[$key];
                    }
                    array_unshift($bindParams, $types);
                    try {
                        call_user_func_array([$stmt, 'bind_param'], $bindParams);
                    }  catch (Exception $e) {
                        $errorMessage = $e->getMessage();
                        $response = $errorMessage.'</br>';
                        return;
                    }
                    if (!$stmt->execute()) {
                        die("Execute failed: " . $stmt->error);
                    } else {
                        $response = "success";
                    }
                }
                break;
            default:
                echo "Query process not supported";
        }
        $stmt->close();
        $conn->close();
        return $response;
    }
}

class odbc_qad {
    static function execQuery($query, $_db='test') {
        $conn = odbcConnect('QADProdRealtime');
        if($_db === 'test') {
            $conn = odbcConnect('QADTEST22');
        }
        $execQuery= odbc_exec($conn,$query);
        $response = [];
        while($row = odbc_fetch_array($execQuery)) {
            $response[] = $row;
        }
        odbc_free_result($execQuery);
        odbc_close($conn);
        return $response;
    }
}
?>