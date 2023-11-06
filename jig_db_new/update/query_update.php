<?PHP
require_once "../config.php";

if(isset($_POST['update_data'])) {
	$conn = connectToDatabase();
	$today = date("Y-m-d");
    $item_jig = $_POST['item_jig'];
    $desc_jig = $_POST['desc_jig'];
    $status_jig = $_POST['status_jig'];
    $material = $_POST['material'];
    $type = $_POST['type'];
    $drawing = $_POST['drawing'];
    $remark = $_POST['remark'];
    $cacheFolder = CACHE;
    $cacheFile1 = $cacheFolder . md5('jig_master') . '.json';
    $cacheFile2 = $cacheFolder . md5('log_master') . '.json';
    // Prepare the queries using placeholders
    $query1 = 'UPDATE jig_master SET desc_jig=?, status_jig=?, material=?, type=?, drawing=? WHERE item_jig=?';
    $query2 = 'INSERT INTO log_master (item_jig, desc_jig, status_jig, material, type, drawing, trans_date, remark) VALUES (?,?, ?, ?, ?, ?, ?, ?)';
    // Use prepared statements with bound parameters to prevent SQL injection
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("ssssss",
        $desc_jig,
        $status_jig,
        $material,
        $type,
        $drawing,
        $item_jig
    );
    // Execute the first query
    if ($stmt->execute()) {
        // First insert successful
        $stmt->close();
        // Prepare the second query
        $stmt = $conn->prepare($query2);
        $stmt->bind_param("ssssssss",
			$item_jig,
            $desc_jig,
            $status_jig,
            $material,
            $type,
            $drawing,
            $today, // You need to define $today before using it
            $remark
        );
        // Execute the second query
        if ($stmt->execute()) {
            // Both inserts successful
            unlink($cacheFile1);
            unlink($cacheFile2);
            header("Location: http://192.168.2.103:8080/wbd/jig_db_new/update/index.php?status=success");
        exit; // Important: Make sure to exit after using header() to prevent further script execution
    }

    // Close the statement
    $stmt->close();
    }
}

if(isset($_POST['update_loc'])) {
    //input form 
    $arr_lokasi = $_POST['loc_name'];
    $arr_qty_per_unit = $_POST['qty_per_unit'];
    $arr_qtyChange = $_POST['qtyChange'];
    $arr_unit = $_POST['unit'];
    $arr_item_jig = $_POST['item_jig'];
    $arr_code = $_POST['code'];
    $arr_addSub = $_POST['addSub'];
    $arr_status = $_POST['status'];
    $arr_id = $_POST['id'];
    $arr_remark = $_POST['remark'];
    $tol = $_POST['tol'];
    //additional input
    $conn = connectToDatabase();
    $today = date("Y-m-d");
    $max_id = max($arr_id);
    $cacheFolder = CACHE;
    $cacheFile1 = $cacheFolder . md5('jig_location') . '.json';
    $cacheFile2 = $cacheFolder . md5('log_location') . '.json';
    $count = count($arr_lokasi);

    $stmt3 = null;
    $stmt4 = null;
    $status = null;
    $code = null;
    $item_jig = null;
    $idNew = null;

    for ($i = 0; $i<$count; $i++) {
        $item_jigPre = $arr_item_jig[$i];
        $codeOri = $arr_code[$i];
        $statOri = $arr_status[$i];
        $lokasi = $arr_lokasi[$i];
        $addSub = $arr_addSub[$i];
        $qtyChange = $arr_qtyChange[$i];
        $qty_per_unit = $arr_qty_per_unit[$i];
        $unit = $arr_unit[$i];
        $id = $arr_id[$i];
        $remark = $arr_remark[$i];
        $qty = (int)$qty_per_unit;
        if ($addSub == 'tambah') {
            $qty = (int)$qty_per_unit + (int)$qtyChange;
        } elseif ($addSub =='kurang') {
            $qty = (int)$qty_per_unit - (int)$qtyChange;
        }
        $ii= $i-1;
        $item_jig = null;
        $code = null;
        if ($id !== "") {
            $item_jig = $item_jigPre;
            $status = $statOri;
            $code = $codeOri;
            $query3 = 'UPDATE jig_location SET lokasi=?, qty_per_unit=?, unit=?, status=?, id=?, toleransi=? WHERE code=?';
            $stmt3 = $conn->prepare($query3);
            $stmt3->bind_param("sissiis",
                    $lokasi,
                    $qty,
                    $unit,
                    $status,
                    $id,
                    $tol,
                    $code);
            if ($stmt3 && $stmt3->execute()) {
                $query4 = 'INSERT INTO log_location (item_jig, lokasi, qty_per_unit, unit, code, status, id, toleransi, remark, trans_date, qty_change, addSub) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)';
                $stmt4 = $conn->prepare($query4);
                // Bind parameters for the INSERT query
                $stmt4->bind_param("ssisssiissis",
                    $item_jig,
                    $lokasi,
                    $qty,
                    $unit,
                    $code,
                    $status,
                    $id,
                    $tol,
                    $remark,
                    $today,
                    $qtyChange,
                    $addSub
                    );
                // Execute the INSERT query
                $stmt4->execute();
                $stmt3->close();
                $stmt4->close();
            }
        } else {
            $item_jig = $arr_item_jig[0];
            $status = ($arr_qty_per_unit[$i] == 0) ? 'SPSD' : 'active';
            if ($max_id > 9) {
                $code = $item_jig."--0".($max_id+1);
            } else if ($max_id > 99) {
                $code = $item_jig."--".($max_id+1);
            } else {
                $code = $item_jig."--00".($max_id+1);
            }
            $idNew = ($max_id+1);
            $query3 = 'INSERT INTO jig_location (item_jig, lokasi, qty_per_unit, unit, code, status, id, toleransi) VALUES (?,?,?,?,?,?,?,?)';
            $stmt3 = $conn->prepare($query3);
            $stmt3->bind_param("ssisssii",
                $item_jig,
                $lokasi,
                $qty,
                $unit,
                $code,
                $status,
                $idNew,
                $tol);
            if ($stmt3 && $stmt3->execute()) {
                $query4 = 'INSERT INTO log_location (item_jig, lokasi, qty_per_unit, unit, code, status, id, toleransi, remark, trans_date, qty_change, addSub) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)';
                $stmt4 = $conn->prepare($query4);
                // Bind parameters for the INSERT query
                $stmt4->bind_param("ssisssiiss",
                    $item_jig,
                    $lokasi,
                    $qty,
                    $unit,
                    $code,
                    $status,
                    $idNew,
                    $tol,
                    $remark,
                    $today,
                    $qtyChange,
                    $addSub
                    );
                // Execute the INSERT query
                $stmt4->execute();
                $stmt3->close();
                $stmt4->close();
            }
        }
    }
    unlink($cacheFile1);
    unlink($cacheFile2); 
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/update/index.php?status=success");
    exit;
}


if(isset($_POST['update_type'])) {
    //input form 
    $fullItem = $_POST['item_type'];
    $separator = " ";
    $array = explode($separator, $fullItem);
    $item_type = $array[0];
    $arr_description = $_POST['desc'];
    $arr_item_jig = $_POST['item_jig'];
    $arr_opt_on = $_POST['opt_on'];
    $arr_opt_off = $_POST['opt_off'];
    $arr_remark = $_POST['remark2'];
    $arr_status = $_POST['status'];
    $arr_id = $_POST['id_func'];
    //additional input
    $conn = connectToDatabase();
	$today = date("Y-m-d");
    $cacheFolder = CACHE;
    $cacheFile1 = $cacheFolder . md5('jig_function') . '.json';
    $cacheFile2 = $cacheFolder . md5('log_function') . '.json';
    $cekKey = array('item_jig','opt_on', 'opt_off');

    for ($i = 0; $i < count($arr_item_jig); $i++) {    
        $desc = $arr_description[$i];
        $item_jig = $arr_item_jig[$i];
        $opt_on = $arr_opt_on[$i];
        $opt_off = $arr_opt_off[$i];
        $remark = $arr_remark[$i];
        $statusOri = $arr_status[$i];
        $idOri= $arr_id[$i];

        $stmt5 = null;
        $stmt6 = null;
        $id = null;
        $status = null;
        $change = false;

        if ($idOri !== "") {
            //check changes
            $id = $idOri;
            $status = $statusOri;
            $queryCheck = "SELECT * FROM jig_function WHERE id=?";
            $stmt = $conn->prepare($queryCheck);
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $check = $stmt->get_result();
            $currentData = $check->fetch_assoc();
            $newValue = array('item_jig'=>$item_jig, 'opt_on'=>$opt_on, 'opt_off'=>$opt_off);
            foreach ($cekKey as $key) {
                if( isset($currentData[$key]) && isset($newValue[$key])) {
                    if ($currentData[$key] != $newValue[$key]) {
                        $change = true;
                        break;
                        }                     
                    }
                }
            if($change){
                $query5= "UPDATE jig_function SET item_jig=?, opt_on=?, opt_off=?, status=? WHERE id=?";
                $stmt5 = $conn->prepare($query5);
                $stmt5->bind_param("sddsd",
                    $item_jig,
                    $opt_on,
                    $opt_off,
                    $status,
                    $id);
                if ($stmt5 && $stmt5->execute()) {
                    $query6 = "INSERT INTO log_function(id, item_jig, item_type, opt_on, opt_off, status, remark, trans_date ) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt6 = $conn->prepare($query6);
                        $stmt6->bind_param("dssddsss",
                        $id, 
                        $item_jig, 
                        $item_type, 
                        $opt_on, 
                        $opt_off, 
                        $status, 
                        $remark, 
                        $today     
                            );  
                    $stmt6->execute();
                    $stmt6->close();
                    $stmt5->close();
                }
            }
        } else {
            $query5= "INSERT INTO jig_function(item_jig, item_type, opt_on, opt_off, status ) VALUES (?,?,?,?,?)";
            $stmt5 = $conn->prepare($query5);
            $stmt5->bind_param("ssdds",
                $item_jig,
                $item_type,
                $opt_on,
                $opt_off,
                $status);
            if ($stmt5 && $stmt5->execute()) {
                $queryID = "SELECT max(id) as id FROM jig_function WHERE item_type=?";
                $stmt7 = $conn->prepare($queryID);
                $stmt7->bind_param("s", $item_type);
                $stmt7->execute();
                $check2 = $stmt7->get_result();
                $idData = $check2->fetch_assoc();
                $id = $idData['id'];
                echo $id;
                $query6 = "INSERT INTO log_function(id, item_jig, item_type, opt_on, opt_off, status, remark, trans_date ) VALUES (?,?,?,?,?,?,?,?)";
                $stmt6 = $conn->prepare($query6);
                    $stmt6->bind_param("dssddsss",
                    $id, 
                    $item_jig, 
                    $item_type, 
                    $opt_on, 
                    $opt_off, 
                    $status, 
                    $remark, 
                    $today     
                        );  
                $stmt6->execute();
                $stmt6->close();
                $stmt5->close();
            }
        }   
        }
    unlink($cacheFile1);
    unlink($cacheFile2); 
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/update/index.php?status=success");
    exit;
}