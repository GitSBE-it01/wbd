<?php
function cekUser($user_log, $prog){
    $conn = connectToDatabase('access_config');
    $query = "SELECT user, role FROM access_wbd WHERE user = '$user_log' AND prog= '$prog'";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        $userRole = $result->fetch_assoc();
        return $userRole["role"];
    } else {
        return null; // User not found or error occurred
    }
}

?>