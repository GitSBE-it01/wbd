<?php
$model=[];
require_once "D:/xampp/htdocs/wbd/2.backend/middleware/class.php";
$model['auth_mstr'] = new Model('db_sb3employee.employee',
[
    'EmployeeID::s'
],
'id::i');
$model['role'] = new Model('db_wbd.access',
[
    'apps::s',
    'role::s',
    'absen::s',
    'abs_name::s',
],
'id::i');
$model['wb_test'] = new Model('db_wbd.wbd_test',
[
    'test1::s',
    'test2::s',
    'comment::s',
],
'id::i');
require_once "item_dev.php";
require_once "jig_new.php";
require_once "jig_sb3.php";
require_once "jig.php";
require_once "new_type_report.php";
require_once "ngvar.php";
require_once "odbc.php";
require_once "pick_now.php";
require_once "qad.php";
require_once "sbe.php";
require_once "vjs_alat_ukur.php";

