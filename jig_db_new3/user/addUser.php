<?php


if(isset($_POST['userRole'])) {
    $conn = connectToDatabase();
    $user = $_POST['userInput'];
    $role = $_POST['role'];
    $prog = 'jig_db';

    $query = 'INSERT INTO access_config.access_wbd (user,role,prog) VALUES (?,?,?)';
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sss",
        $user,
        $role,
        $prog
    );
    if (!$stmt->execute()) {
        echo "failed";
    }
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/user/index.php?status=success");
}

if(isset($_POST['changeRole'])) {
    $conn = connectToDatabase();
    $user = $_POST['userChoose'];
    $role = $_POST['newRole'];
    if ($role === 'delete') {
        $query = 'DELETE FROM access_config.access_wbd WHERE user=?';
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s",
            $user
        );
    } else {
        $query = 'UPDATE access_config.access_wbd SET role=? WHERE user=?';
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss",
            $role,
            $user
        );
    }

    if (!$stmt->execute()) {
        echo "failed";
    }
    
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/user/index.php?status=success");
}

?>
