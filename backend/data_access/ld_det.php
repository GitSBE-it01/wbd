<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";

/*
class Ld {
    public $id;
    public $log;
    public $part;
    public $qty_oh;
    public $loc;
    public $lot;
    public $status;
    public $ref;
    public $site;
  
    public function __construct(
        $id, 
        $log, 
        $part, 
        $qty_oh, 
        $loc, 
        $lot, 
        $status, 
        $ref,
        $site
        ) {
      $this->id = $id;
      $this->log = $log ? $log: '';
      $this->part = $part ? $part: '';
      $this->qty_oh = $qty_oh ? $qty_oh: '';
      $this->loc = $loc ? $loc: '';
      $this->lot = $lot ? $lot: '';
      $this->status = $status ? $status: '';
      $this->ref = $ref ? $ref: '';
      $this->site = $site ? $site: '';
    }
}
*/
  
class LdDAO {    
    public static function getAllLd($db) {
        $conn = connectToDatabase($db);
        $sql = "SELECT * FROM ld_det";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}

?>