<?php
session_start();
$branch = $_POST['Branch'];
$husername = $_POST['username'];
$password = $_POST['password'];

if ($husername && $password && $branch) {
    $connect = new mysqli("localhost", "root", "", "placement"); // Establishing connection

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Prepare statement to prevent SQL injection
    $stmt = $connect->prepare("SELECT Branch, Username, Password FROM hlogin WHERE Username = ?");
    $stmt->bind_param("s", $husername);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbbranch = $row['Branch'];
        $dbpassword = $row['Password'];

        // Verify the password
        if ($branch == $dbbranch && password_verify($password, $dbpassword)) {
            // Successful login
            echo "<center>Login Successful..!! <br/>Redirecting you to HomePage! </br>If not, go <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='3; url=index.php'>";
            $_SESSION['husername'] = $husername;
            $_SESSION['department'] = $branch;
        } else {
            // Incorrect credentials
            $message = "Username and/or Password and/or Department are incorrect.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<center>Redirecting you back to Login Page! If not, go <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='1; url=index.php'>";
        }
    } else {
        // User not found
        die("User does not exist");
    }

    // Close the statement
    $stmt->close();
    // Close the database connection
    $connect->close();
} else {
    // Handle empty fields
    $message = "Fields can't be left blank.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<center>Redirecting you back to Login Page! If not, go <a href='index.php'>Here</a></center>";
    echo "<meta http-equiv='refresh' content='1; url=index.php'>";
}
?>
