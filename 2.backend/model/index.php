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
require_once "jig.php";
require_once "new_type_report.php";
require_once "ngvar.php";
require_once "qad.php";
require_once "sbe.php";
require_once "vjs_alat_ukur.php";
