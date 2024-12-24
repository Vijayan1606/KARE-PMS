<?php
$connect = new mysqli("localhost", "root", "", "placement"); // Establishing connection with the database

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_POST['submit'])) {
    // Fetching form data
    $Name = $_POST['Fullname'];
    $Username = $_POST['Username']; 
    $Branch = $_POST['Branch']; 
    $password = $_POST['Password']; 
    $repassword = $_POST['repassword'];
    $Email = $_POST['Email'];
    $Question = $_POST['Question'];
    $Answer = $_POST['Answer'];

    // Validate required fields
    if (empty($Name) || empty($Username) || empty($Branch) || empty($password) || empty($repassword) || empty($Email) || empty($Question) || empty($Answer)) {
        die("<center>All fields are required. Please fill in all the details.</center>");
    }

    // Validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die("<center>Invalid email format. Please enter a valid email address.</center>");
    }

    // Check if passwords match
    if ($password !== $repassword) {
        die("<center>Passwords do not match. Please make sure both passwords are the same.</center>");
    }

    // Check if Username already exists
    $check = $connect->prepare("SELECT * FROM hlogin WHERE Username = ?");
    if ($check === false) {
        die("Prepare failed: " . $connect->error);
    }
    
    $check->bind_param("s", $Username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        // Hash the password for security before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $query = $connect->prepare("INSERT INTO hlogin (Name, Username, Branch, Password, Email, Question, Answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($query === false) {
            die("Prepare failed: " . $connect->error);
        }

        // Bind the parameters
        $query->bind_param("sssssss", $Name, $Username, $Branch, $hashedPassword, $Email, $Question, $Answer);

        if ($query->execute()) {
            echo "<center>You have registered successfully! Go back to </center>";
            echo "<center><a href='index.php'>Login here</a></center>";
        } else {
            echo "<center>Error during registration. Please try again later.</center>";
        }

        // Close the query statement
        $query->close();
    } else {
        echo "<center>This username already exists. Please choose a different username.</center>";
    }

    // Close the prepared statements
    $check->close();
}

// Close the database connection
$connect->close();
?>
