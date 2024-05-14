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

$wobb = new QueryInit('wod_det');
$wo = new QueryInit('wo_mstr');
$ld = new QueryInit('ld_det');
$loc = new QueryInit('loc_mstr');
$dept = new QueryInit('dbpick_now.dept_new');
$pickNow = new QueryInit('dbpick_now.result_fix');
$pt_mstr = new QueryInit('pt_mstr');
$pic_part = new QueryInit('dbpick_now.pic_part_category');

$codeList = array(
    'wobb'=>$wobb,
    'wo'=>$wo,
    'ld'=>$ld,
    'loc'=>$loc,
    'dept'=>$dept,
    'pickNow'=> $pickNow,
    'pt_mstr'=> $pt_mstr,
    'pic_part'=> $pic_part,
);


?>