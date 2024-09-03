<?php
/*==================================================================================================================
global
==================================================================================================================*/
/*------------------------------------------------------
cek user
------------------------------------------------------*/
function cekUser($user_log, $prog) {
    $conn = connectToDatabase();
    $query = "SELECT user, role FROM access_config.access_wbd WHERE user = '$user_log' AND prog= '$prog'";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        $userRole = $result->fetch_assoc();
        return $userRole["role"];
    } else {
        return null; // User not found or error occurred
    }
}

/*==================================================================================================================
Cache function
==================================================================================================================*/
/*------------------------------------------------------
with wildcard
------------------------------------------------------*/
function getCachedWildcardResult($cacheKey, $query, $wildcard, $expirationTime, $cacheFolder) {
    $conn = connectToDatabase();
    if (empty($wildcard)) {
        $cacheKey = $cacheKey . '_';
    } else {
        $cacheKey = $cacheKey . '_' . $wildcard;
    }

    $cacheFile = $cacheFolder . md5($cacheKey) . '.json';
    
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $expirationTime) {
        $cachedData = file_get_contents($cacheFile);
        return json_decode($cachedData, true); 
    }

    if (empty($wildcard)) {
        $stmt = $conn->prepare($query);
    } else {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $wildcard);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array(); 

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $result->free();
    } else {
        echo "Error executing the query: " . $conn->error;
    }

    if (!is_dir($cacheFolder)) {
        mkdir($cacheFolder, 0755, true);
    }
    $jsonData = json_encode($data); 
    file_put_contents($cacheFile, $jsonData);
    return $data;
}

function fetchDataWildcard($arr, $wildcard) {
    $conn = connectToDatabase();
    $cacheFolder = $arr['cacheFolder'];
    $expirationTime = $arr['expTime'];
    $wildcardData = '%'. $wildcard. '%';
    if (empty($wildcardData)) {
        $cacheKey = $arr['cacheKey'] . '_';
    } else {
        $cacheKey = $arr['cacheKey'] . '_' . $wildcardData;
    }
    $cacheFile = $cacheFolder . md5($cacheKey) . '.json';

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $expirationTime) {
        $cachedData = file_get_contents($cacheFile);
        return json_decode($cachedData, true); 
    }

    if (empty($wildcardData)) {
        $stmt = $conn->prepare($arr['query']);
    } else {
        $stmt = $conn->prepare($arr['query']);
        $stmt->bind_param("s", $wildcardData);
    }

    $stmt->execute();
    $result = $conn->query($arr['query']);
    $data = array(); 

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $result->free();
    } else {
        echo "Error executing the query: " . $conn->error;
    }

    if (!is_dir($cacheFolder)) {
        mkdir($cacheFolder, 0755, true);
    }
    $jsonData = json_encode($data); 
    file_put_contents($cacheFile, $jsonData);
    return $data;
}


function getDataWildcard($query, $filter) {
    $conn = connectToDatabase();
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $filter);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $data = array(); 
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
    $result->free();
    $stmt->close();
    $conn->close();
    return $data;
}
/*------------------------------------------------------
Without wildcard
------------------------------------------------------*/
function getCachedResult($cacheKey, $query, $expirationTime, $cacheFolder) {
    $cacheFile = $cacheFolder . md5($cacheKey) . '.json';
    $conn = connectToDatabase();
    
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $expirationTime) {
        $cachedData = file_get_contents($cacheFile);
        return json_decode($cachedData, true); 
    }
    $result = $conn->query($query);
    $data = array(); 

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $result->free();
    } else {
        echo "Error executing the query: " . $conn->error;
    }

    if (!is_dir($cacheFolder)) {
        mkdir($cacheFolder, 0755, true);
    }
    $jsonData = json_encode($data); 
    file_put_contents($cacheFile, $jsonData);
    return $data;
}

function fetchData($arr) {
    $cacheFolder = $arr['cacheFolder'];
    $expirationTime = $arr['expTime'];
    $cacheFile = $cacheFolder . md5($arr['cacheKey']) . '.json';
    $conn = connectToDatabase();

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $expirationTime) {
        $cachedData = file_get_contents($cacheFile);
        return json_decode($cachedData, true); 
    }
    $result = $conn->query($arr['query']);
    $data = array(); 

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $result->free();
    } else {
        echo "Error executing the query: " . $conn->error;
    }

    if (!is_dir($cacheFolder)) {
        mkdir($cacheFolder, 0755, true);
    }
    $jsonData = json_encode($data); 
    file_put_contents($cacheFile, $jsonData);
    return $data;
}

function getData($query) {
    $conn = connectToDatabase();
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $data = array(); 
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
    $result->free();
    $stmt->close();
    $conn->close();
    return $data;
}

function checkFileExists($arr) {
    $cacheFolder = CACHE;
    $cacheFile = $cacheFolder . md5($arr['db']) . '.json';

    $fileExists = file_exists($cacheFile);

    // Respond with a JSON object indicating whether the file exists
    echo json_encode(['fileExists' => $fileExists]);
}


function updateCache($arr) {
    $cacheFolder = $arr['cacheFolder'];
    $cacheFile = $cacheFolder . md5($arr['cacheKey']) . '.json';
    
    if (file_exists($cacheFile)) {
        unlink($cacheFile); // Remove the cached file if it exists
        return true;
    }
    fetchData($arr);
}

function getWildcard($separator, $input) {
    $array = explode($separator, $input);
    $item = $array[0];
    $wildcard = '%'.$item.'%';
    return $wildcard;
}

function getRowsWithItem($result, $item) {
    $rows = array();
    foreach ($result as $row) {
        if ($row["item"] === $item) {
            $rows[] = $row;
        }
    }
    return $rows;
}

/*------------------------------------------------------
check change before update
------------------------------------------------------*/
function checkChanges($query, $newValues) {
    $conn = connectToDatabase();
    $result = $conn->query($query);

    if ($result) {
        $currentData = $result->fetch_assoc(); // Fetch the current data into an associative array
        $result->free(); // Free the result set to release memory

        // Compare the new values with the current data to detect changes
        $changesDetected = false;
        foreach ($newValues as $column => $newValue) {
            if ($currentData[$column] !== $newValue) {
                $changesDetected = true;
                break;
            }
        }
		if ($changesDetected) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

function codeFileName($input) {
    $code = md5($input) . '.json';
    return $code;
}

function getArrayList($arrList, $input) {
    $preResult = true;
    foreach ($arrList as $key=>$value) {
        if ($input == $key) {
            $result = $value;
            $preResult = false;
            return $result;
            break;
        }
    }
    if ($preResult) {
        echo "theres is no such";
    }
}

?>