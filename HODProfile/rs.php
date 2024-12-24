<?php
session_start();

// Establishing connection to the MySQL database
$connect = mysqli_connect("localhost", "root", "", "placement"); // Database connection

// Check if the connection was successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetching the data from the form
$Username = $_POST['Username'];  // Changing 'USN' to 'Username'
$Question = $_POST['Question'];
$Answer = $_POST['Answer'];

// Query to check if the username exists
$check = $connect->query("SELECT * FROM hlogin WHERE Username='" . $Username . "'") or die("Query Failed");

// If the username exists
if ($check->num_rows != 0) {
    $row = $check->fetch_assoc();
    
    // Fetch the security question and answer from the database
    $dbQuestion = $row['Question'];
    $dbAnswer = $row['Answer'];

    // Compare the entered question and answer with the stored ones
    if ($dbQuestion == $Question && $dbAnswer == $Answer) {
        $_SESSION['reset'] = $Username; // Store the username for password reset
        header("location: Reset password.php");  // Redirect to the reset password page
    } else {
        echo "<center>Failed! Incorrect Credentials</center>"; // Invalid credentials
    }
} else {
    echo "<center>Enter Something Correctly Champ!!!</center>";  // Username not found
}

// Close the database connection
mysqli_close($connect);
?>
