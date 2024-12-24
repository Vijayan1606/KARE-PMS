<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection with the server using mysqli
    $connect = new mysqli("localhost", "root", "", "placement");

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Collecting and sanitizing form data
    $usn = $connect->real_escape_string(trim($_POST['usn']));
    $comname = $connect->real_escape_string(trim($_POST['comname']));
    $date = $connect->real_escape_string(trim($_POST['Date']));
    $attend = $connect->real_escape_string(trim($_POST['Attendance']));
    $wt = $connect->real_escape_string(trim($_POST['WrittenTest']));
    $gd = $connect->real_escape_string(trim($_POST['GD']));
    $tech = $connect->real_escape_string(trim($_POST['Tech']));
    $placed = $connect->real_escape_string(trim($_POST['Placed']));

    // Check if CompanyName and Date exist in addpdrive
    $checkQuery = $connect->prepare("SELECT * FROM addpdrive WHERE CompanyName = ? AND Date = ?");
    $checkQuery->bind_param("ss", $comname, $date);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        // Prepare the SQL statement for inserting data into updatedrive
        $stmt = $connect->prepare("INSERT INTO updatedrive (usn, CompanyName, Date, Attendence, WT, GD, Techical, Placed) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssssssss", $usn, $comname, $date, $attend, $wt, $gd, $tech, $placed);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect or display success message
                echo "<center>Data Inserted successfully...!!</center>";
            } else {
                echo "<center>Failed to insert data: " . htmlspecialchars($stmt->error) . "</center>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<center>Failed to prepare statement: " . htmlspecialchars($connect->error) . "</center>";
        }
    } else {
        echo "<center>The Company Name and Date do not exist in the addpdrive table.</center>";
    }

    // Close the check statement
    $checkQuery->close();
    // Close the connection
    $connect->close();
}
?>
