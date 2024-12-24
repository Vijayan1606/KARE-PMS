<?php
session_start();

// Ensure that the session is set with the user’s USN before proceeding
if (!isset($_SESSION['reset'])) {
    die("Error: Session expired or invalid. Please try again.");
}

// Fetch input values from the form
$USN1 = $_POST['USN'] ?? ''; // Default to empty string if not set
$password = $_POST['PASSWORD'] ?? '';
$confirm = $_POST['repassword'] ?? '';
$USN2 = $_SESSION['reset'];  // The USN stored in the session

// Database connection
$connect = mysqli_connect("localhost", "root", "", "placement"); 

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure all fields are filled
if (isset($USN1) && isset($password) && isset($confirm)) {

    // Check if the password and confirm password match
    if ($password == $confirm) {

        // Ensure the correct USN is being reset
        if ($USN2 == $USN1) {

            // Hash the password before updating (important for security)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Use prepared statements to prevent SQL injection
            $stmt = $connect->prepare("UPDATE hlogin SET PASSWORD = ? WHERE Username = ?");
            $stmt->bind_param("ss", $hashedPassword, $USN1);

            // Execute query
            if ($stmt->execute()) {
                echo "<center>Password Reset Complete</center>";

                // Clear session variables and destroy the session after successful update
                session_unset();  // Unset all session variables
                session_destroy(); // Destroy the session for added security
            } else {
                echo "<center>Update Failed: " . $stmt->error . "</center>";
            }

            // Close the prepared statement
            $stmt->close();

        } else {
            session_unset();
            die("Error: Invalid USN provided.");
        }

    } else {
        echo "<center>Password and Confirm Password do not match</center>";
        session_unset(); // Unset session on failure to prevent further attempts
    }

} else {
    echo "<center>All fields must be filled</center>";
    session_unset();  // Unset session if fields are missing
}

// Close the database connection
mysqli_close($connect);
?>
