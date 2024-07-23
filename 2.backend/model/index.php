<?php
$model=[];
require_once "D:/xampp/htdocs/wbd/2.backend/middleware/class.php";
$model['auth'] = new Model('access',
[
    'apps::s',
    '::s',
],
'id::i');
require_once "jig.php";
require_once "ngvar.php";
require_once "qad.php";
require_once "sbe.php";
require_once "vjs_alat_ukur.php";
