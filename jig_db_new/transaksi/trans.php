<?php 
if(isset($_POST['dailyTrans'])) {
    $conn = connectToDatabase();    
    $code = $_POST['code'];
    $qty = $_POST['qtyPinjam'];
    $pinjamInp = $_POST['locTarget'];
    if (is_numeric($pinjamInp)) {
        $integer = intval($pinjamInp);
        $sql = "SELECT Name FROM db_sb3employee.employee WHERE CardID = $integer";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $pinjam = $row['Name'];
            $result->free_result();
        } else {
            $pinjam = "Query failed";
        }
    } else {
        $pinjam = $pinjamInp;
    }
    $item = $_POST['item'];
    $today = date("Y-m-d");
    $stat = 'open';
    $delimiter = "/";
    $array = explode($delimiter, $code);
    $item = $array[1];
    $query = 'INSERT INTO jig_trans(code, loc, qty, start_date, status, item_jig) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss",
        $item,
        $pinjam,
        $qty,
        $today,
        $stat,
        $item
    );
    $stmt->execute();
    $stmt->close();
    $conn->close();
}


if(isset($_POST['return'])) {
    $conn = connectToDatabase();    
    $id = $_POST['id'];
    $today = date("Y-m-d");
    $stat = 'close';
    $query = 'UPDATE jig_trans SET end_date=?, status=? WHERE id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi",
        $today,
        $stat,
        $id
    );
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

?>