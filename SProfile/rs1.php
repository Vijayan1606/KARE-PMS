<?php
session_start();

// Fetch input values
$USN1 = $_POST['USN'];
$password = $_POST['PASSWORD'];
$confirm = $_POST['repassword'];
$USN2 = $_SESSION['reset'];

// Database connection
$connect = mysqli_connect("localhost", "root", "", "placement"); 

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($USN1) && isset($password) && isset($confirm)) {

    // Check if the password and confirm password match
    if ($password == $confirm) {

        // Ensure the correct USN is being reset
        if ($USN2 == $USN1) {

            // Use prepared statements to prevent SQL injection
            $stmt = $connect->prepare("UPDATE `placement`.`slogin` SET `PASSWORD` = ? WHERE `USN` = ?");
            $stmt->bind_param("ss", $password, $USN1);

            // Execute query
            if ($stmt->execute()) {
                echo "<center>Password Reset Complete</center>";
                session_unset();  // Unset session after successful update
                session_destroy(); // Also destroy session for extra security
            } else {
                echo "<center>Update Failed: " . $stmt->error . "</center>";
            }

            // Close the prepared statement
            $stmt->close();

        } else {
            session_unset();
            die("Error: Invalid USN provided");
        }

    } else {
        echo "<center>Password and Confirm Password do not match</center>";
        session_unset();
    }

} else {
    echo "<center>All fields must be filled</center>";
    session_unset();
}

// Close the database connection
mysqli_close($connect);

?>
