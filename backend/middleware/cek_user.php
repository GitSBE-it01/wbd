<?php
require_once "../index.php";
function cekUser($db, $user_log, $prog) {
    $conn = connectToDatabase($db);
    $query = "SELECT user, role FROM access_config.access_wbd WHERE user = '$user_log' AND prog= '$prog'";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        $userRole = $result->fetch_assoc();
        return $userRole["role"];
    } else {
        return null;
    }
}
?>