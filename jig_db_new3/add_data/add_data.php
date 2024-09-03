<?PHP
include_once "../config.php";

/*
function addJigData() {
    $conn = connectToDatabase();
    $conn->autocommit(false);
    $separator = " ";
    $today = date("Y-m-d"); // today date

    // Retrieve values from the form inputs
    $item_jig = $_POST['item_jig'];
    $desc_jig = $_POST['desc_jig'];
    $status = 'active';
    $new_jig = 'new jig';
    $new_type = 'new type';
    $type_jig = $_POST['type_jig'];
    $mat = $_POST['material'];
    $qty_tol = $_POST['qty_tolerance'];
    $id = 1;
    // array input
    $arr_inputloc = $_POST['loc'];
    $arr_qty_per_unit = $_POST['qty_per_unit'];
    $arr_unit = $_POST['unit'];
    $arr_inputtype = $_POST['item_type'];
    $arr_opt_on = $_POST['opt_on'];
    $arr_opt_off = $_POST['opt_off'];
    $jfIDQuery = "SELECT max(id) FROM jig_function";
    $result = $conn->query($jfIDQuery);
    $jfID = null;
    if ($result) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();
        // Access the value of the maximum id
        $jfID = $row['max(id)'] + 1;
    }


    // Variable to track the validity of executions
    $allExecutionsValid = true;

    // jig master
    $sqljigMstr = $conn->prepare("
        INSERT INTO 
        jig_master (
            item_jig,
            desc_jig,
            status_jig,
            material,
            type
        ) 
        VALUES (?,?,?,?,?)");

    $sqljigMstr->bind_param("sssss",
        $item_jig,
        $desc_jig,
        $status,
        $mat,
        $type_jig
    );
    if (!$sqljigMstr->execute()) {
        echo "Error: " . $sqljigMstr->error;
        $allExecutionsValid = false;
    }
    $sqllogMstr = $conn->prepare("
    INSERT INTO 
    log_master (
        item_jig,
        desc_jig,
        status_jig,
        material,
        type,
        trans_date,
        remark
    ) 
    VALUES (?,?,?,?,?,?,?)");

    $sqllogMstr->bind_param("sssssss",
        $item_jig,
        $desc_jig,
        $status,
        $mat,
        $type_jig,
        $today,
        $new_jig
    );

    // Execute the SQL query for jig master
    if (!$sqllogMstr->execute()) {
        echo "Error: " . $sqllogMstr->error;
        $allExecutionsValid = false;
    }

    // jig function
    $sqltype = $conn->prepare("
        INSERT INTO 
        jig_function (
            id,
            item_jig,
            item_type,
            opt_on,
            opt_off,
            status
        ) 
        VALUES (?,?,?,?,?,?)");


    $sqllogtype = $conn->prepare("
        INSERT INTO 
        log_function (
            id,
            item_jig,
            item_type,
            opt_on,
            opt_off,
            status,
            remark,
            trans_date
        ) 
        VALUES (?,?,?,?,?,?,?,?)");

    $counttype = count($arr_inputtype);
    for ($i = 0; $i < $counttype; $i++) {
        $item_type = explode($separator, $arr_inputtype[$i])[0];
        $opt_on = $arr_opt_on[$i];
        $opt_off = $arr_opt_off[$i];
        $status0 = 'active';

        $sqltype->bind_param("dssdds",
            $jfID,
            $item_jig,
            $item_type,
            $opt_on,
            $opt_off,
            $status0
        );

        if (!$sqltype->execute()) {
            echo "Error: " . $sqltype->error;
            $allExecutionsValid = false;
        }
        $jfID++;
        $sqllogtype->bind_param("dssddsss",
            $jfID,
            $item_jig,
            $item_type,
            $opt_on,
            $opt_off,
            $status0,
            $new_type,
            $today
        );

        // Execute the SQL query for jig function
        if (!$sqllogtype->execute()) {
            echo "Error: " . $sqllogtype->error;
            $allExecutionsValid = false;
        }

    }

    // jig location
    $sqlloc = $conn->prepare("
        INSERT INTO 
        jig_location (
            code,
            item_jig,
            qty_per_unit,
            unit,
            lokasi,
            status,
            id,
            toleransi
        ) 
        VALUES (?,?,?,?,?,?,?,?)");

    $sqllogloc = $conn->prepare("
        INSERT INTO 
        log_location (
            code,
            item_jig,
            qty_per_unit,
            unit,
            lokasi,
            trans_date,
            remark,
            status,
            id,
            toleransi
        ) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");


    $countloc = count($arr_inputloc);
    for ($i = 0; $i < $countloc; $i++) {
        $loc = $arr_inputloc[$i];
        $qty_per_unit = $arr_qty_per_unit[$i];
        $unit = $arr_unit[$i];
        $code = null;
        if ($id>9){
            $code = $item_jig . "--0" . $id;
        } elseif ($id>99) {
            $code = $item_jig . "--" . $id;
        } else {
            $code = $item_jig . "--00" . $id;
        }

        $sqlloc->bind_param("ssdsssds",
            $code,
            $item_jig,
            $qty_per_unit,
            $unit,
            $loc,
            $status,
            $id,
            $qty_tol
        );
        $id++;
        if (!$sqlloc->execute()) {
            echo "Error: " . $sqlloc->error;
            $allExecutionsValid = false;
        }

        $sqllogloc->bind_param("ssdsssssds",
            $code,
            $item_jig,
            $qty_per_unit,
            $unit,
            $loc,
            $today,
            $new_jig,
            $status,
            $id,
            $qty_tol
        );

        // Execute the SQL query for jig location
        if (!$sqllogloc->execute()) {
            echo "Error: " . $sqllogloc->error;
            $allExecutionsValid = false;
        }

    }

    // Commit changes if all executions are valid
    if ($allExecutionsValid) {
        $conn->commit();
        header("Location: http://192.168.2.103:8080/wbd/jig_db_new/add_data/index.php?status=success");
    } else {
        $conn->rollback(); // Rollback changes if any execution failed
        echo "Failed to insert data. Rolling back changes.";
    }
    $conn->autocommit(true);
    // Close the database connection
    $conn->close();
}
*/

function addTypeData() {
    $conn = connectToDatabase();
    $today = date("Y-m-d"); // today date
    // Retrieve values from the form inputs
    $arr_inputjig = $_POST['item_jig2'];
    $inputtype = $_POST['item_type2'];
    $separator = " ";
    $arr_opt_on = $_POST['opt_on2'];
    $arr_opt_off = $_POST['opt_off2'];
    $jfIDQuery = "SELECT max(id) FROM jig_function";
    $result = $conn->query($jfIDQuery);
    $jfID = null;
    if ($result) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();
        // Access the value of the maximum id
        $jfID = $row['max(id)'] + 1;
    }


    $sqltype = $conn->prepare("
    INSERT INTO 
    jig_function (
        id,
        item_jig,
        item_type,
        opt_on,
        opt_off,
        status
    ) 
    VALUES (?,?,?,?,?,?)");


    $sqllogtype = $conn->prepare("
        INSERT INTO 
        log_function (
            id,
            item_jig,
            item_type,
            opt_on,
            opt_off,
            status,
            remark,
            trans_date
        ) 
        VALUES (?,?,?,?,?,?,?,?)");

    $counttype = count($arr_inputjig);
    echo $counttype;
    for ($i = 0; $i < $counttype; $i++) {
        $jigarray = explode($separator, $arr_inputjig[$i]);
        $item_jig = $jigarray[0];
        $opt_on = $arr_opt_on[$i];
        $opt_off = $arr_opt_off[$i];
        $status = 'active';

        $sqltype->bind_param("dssdds",
            $jfID,
            $item_jig,
            $inputtype,
            $opt_on,
            $opt_off,
            $status
        );
        
        $sqllogtype->bind_param("dssddsss",
            $jfID,
            $item_jig,
            $inputtype,
            $opt_on,
            $opt_off,
            $status,
            $new_type,
            $today
        );

        // Execute the prepared statement
        if (!$sqltype->execute() && !$sqllogtype->execute()) {
            echo "Error: " . $sqltype->error;
        } else {
            $sqltype->execute(); 
            $sqllogtype->execute();
            $jfID++;
        }
    }
    // Close the database connection
    $conn->close();
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/add_data/index.php?status=success");
}

function addLocData()
{
    $conn = connectToDatabase();

    // Retrieve values from the form inputs
    $loc = $_POST['location'];

    // Prepare the SQL statement with parameter binding
    $sqlloc = "INSERT INTO list_location (name) VALUES (?)";
    $stmt = $conn->prepare($sqlloc);
    
    // Bind the parameter
    $stmt->bind_param("s", $loc);

    // Execute the SQL query
    if ($stmt->execute()) {
        header("Location: http://192.168.2.103:8080/wbd/jig_db_new/add_data/index.php?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}

function addMtncData() {
    $conn = connectToDatabase();

    // Retrieve values from the form inputs
    $type_jig = $_POST['type_jig2'];
    $std_life = $_POST['std_life'];
    $unit_lftm = $_POST['unit_lftm'];
    $mtnc_by = $_POST['mtnc_by'];

    // Insert data into Table A
    $sqlmtnc = $conn->prepare("
        INSERT INTO 
        list_mtnc (
            type_jig,
            mtnc_std_lifetime,
            mtnc_by,
            lftm_unit
            ) 
        VALUES (?,?,?,?)");

    // Corrected data type placeholders in bind_param
    $sqlmtnc->bind_param("sdss",
        $type_jig,
        $std_life,
        $mtnc_by,
        $unit_lftm
    );

    // Execute the SQL query
    if ($sqlmtnc->execute()) {
        header("Location: http://192.168.2.103:8080/wbd/jig_db_new/add_data/index.php?status=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the prepared statement and the database connection
    $sqlmtnc->close();
    $conn->close();
}

// Call the function to process the form submission
/*
if (isset($_POST['input_jig'])) {
    addJigData();
} elseif (isset($_POST['input_type'])) {
    addTypeData();
} elseif (isset($_POST['locate'])) {
    addLocData();
} elseif (isset($_POST['mtnc'])) {
    addMtncData();
} else {
    
}*/

?>

