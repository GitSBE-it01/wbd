<?php
    require_once "D:/xampp/htdocs/CONNECTION/config.php";
    require_once "D:/xampp/htdocs/wbd/backend/middleware.php";
    require_once "../data_index.php";

    $db_access = new LocDAO();
    $response = $db_access->getAllLoc('dbqad_live');
    
    echo json_encode($response);
    


?>