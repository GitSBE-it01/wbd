<?php
$model['user'] = new Model('db_sb3employee.employee',
[
    'id::i',
    'EmployeeID::s',
    'Absensi::s',
    'Name::s',
    'Department::s',
    'Position::s',
    'Grade::s',
    'WorkCenter::s',
    'WorkCenterGroup::s',
    'WorkStat::i',
],
'id::i');