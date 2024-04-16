<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";

class Loc {
    public $id;
    public $loc;
    public $desc;
    public $dept;
    public $site;
    public $status;
    public $created;
  
    public function __construct(
        $id, 
        $loc, 
        $desc, 
        $dept, 
        $site, 
        $status, 
        $created
        ) {
      $this->id = $id;
      $this->loc = $loc ? $loc: '';
      $this->desc = $desc ? $desc: '';
      $this->dept = $dept ? $dept: '';
      $this->site = $site ? $site: '';
      $this->status = $status ? $status: '';
      $this->created = $created ? $created: '';
    }
  }
  
  // UserDAO.php (converted to mysqli)
  
  class LocDAO {    

    public function getLoc(string $db) {
        $conn = connectToDatabase($db);
        $sql = "SELECT * FROM loc_mstr WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            return new Loc(
            $row['id'],
            $row['loc_loc'],
            $row['loc_desc'],
            $row['loc_department'],
            $row['loc_site'],
            $row['loc_stat'],
            $row['loc_dt_create']
        );
        } else {
            return null;
        }
    }
  
    public static function getAllLoc($db) {
        $conn = connectToDatabase($db);
        $sql = "SELECT * FROM loc_mstr";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $dt =  new Loc(
                $row['id'],
                $row['loc_loc'],
                $row['loc_desc'],
                $row['loc_department'],
                $row['loc_site'],
                $row['loc_stat'],
                $row['loc_dt_create']
            );
            $data[] = $dt;
        }
        return $data;
    }
    /*
    public function createLoc(Loc $user) {
      $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("ss", $user->name, $user->email);
      $stmt->execute();
      return $stmt->insert_id;
    }*/
}

?>