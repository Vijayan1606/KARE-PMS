<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the posted values
    $USN1 = $_POST['USN'];
    $password = $_POST['PASSWORD'];
    $confirm = $_POST['repassword'];

    // Establishing connection with the server using mysqli
    $connect = mysqli_connect("localhost", "root", "", "placement");

    // Check connection
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the passwords match
    if ($password === $confirm) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $connect->prepare("UPDATE plogin SET Password = ? WHERE Username = ?");
        $stmt->bind_param("ss", $password, $USN1);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<center>Password Reset Complete</center>";
            // Optionally destroy the session if needed
            session_unset();
            session_destroy(); // Destroy the session if necessary
        } else {
            echo "<center>Update Failed: " . $stmt->error . "</center>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<center>Passwords do not match.</center>";
    }

    // Close the database connection
    mysqli_close($connect);
}
?>
