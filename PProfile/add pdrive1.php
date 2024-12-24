<?php
// Establishing connection with server using mysqli
$connect = new mysqli("localhost", "root", "", "placement");

// Check connection
if ($connect->connect_error) {
    error_log("Connection failed: " . $connect->connect_error);
    die("Connection to database failed.");
}

if (isset($_POST['submit'])) {
    // Collecting form data
    $cname = $connect->real_escape_string(trim($_POST['compny']));
    $date = $connect->real_escape_string(trim($_POST['date']));
    $campool = $connect->real_escape_string(trim($_POST['campool']));
    $poolven = $connect->real_escape_string(trim($_POST['pcv']));
    $per = $connect->real_escape_string(trim($_POST['sslc']));
    $puagg = $connect->real_escape_string(trim($_POST['puagg']));
    $beaggregate = $connect->real_escape_string(trim($_POST['beagg']));
    $back = $connect->real_escape_string(trim($_POST['curback']));
    $hisofbk = $connect->real_escape_string(trim($_POST['hob']));
    $breakstud = $connect->real_escape_string(trim($_POST['break']));
    $otherdet = $connect->real_escape_string(trim($_POST['odetails']));
    
    // Check if necessary fields are filled
    if (!empty($cname) && !empty($date)) {
        // Check for existing entry
        $checkQuery = $connect->prepare("SELECT * FROM addpdrive WHERE CompanyName = ? AND Date = ?");
        $checkQuery->bind_param("ss", $cname, $date);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            echo "<center>A drive with the same Company Name and Date already exists.</center>";
        } else {
            // Prepare the SQL statement
            $stmt = $connect->prepare("INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            if ($stmt) {
                // Bind parameters
                $stmt->bind_param("sssssssssss", $cname, $date, $campool, $poolven, $per, $puagg, $beaggregate, $back, $hisofbk, $breakstud, $otherdet);
                
                // Execute the statement
                if ($stmt->execute()) {
                    echo "<center>Drive Inserted successfully</center>";
                } else {
                    error_log("Execution failed: " . $stmt->error);
                    echo "<center>There was an error inserting the drive. Please try again later.</center>";
                }

                // Close the statement
                $stmt->close();
            } else {
                error_log("Statement preparation failed: " . $connect->error);
                echo "<center>There was an error processing your request. Please try again later.</center>";
            }
        }
        
        // Close the check statement
        $checkQuery->close();
    } else {
        echo "<center>Please fill in the required fields.</center>";
    }
}

// Close the connection
$connect->close();
?>
