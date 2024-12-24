<?php
$connect = new mysqli("localhost", "root", "", "placement"); // Establishing Connection with Server

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_POST['submit'])) {
    $Name = $_POST['Fullname'];
    $USN = $_POST['USN'];
    $password = $_POST['PASSWORD'];
    $repassword = $_POST['repassword'];
    $Email = $_POST['Email'];
    $Question = $_POST['Question'];
    $Answer = $_POST['Answer'];

    // Check if USN already exists
    $check = $connect->prepare("SELECT * FROM slogin WHERE USN = ?");
    if ($check === false) {
        die("Prepare failed: " . $connect->error);
    }
    
    $check->bind_param("s", $USN);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        if ($repassword === $password) {
            // Insert new user
            $query = $connect->prepare("INSERT INTO slogin (Name, USN, PASSWORD, Email, Question, Answer) VALUES (?, ?, ?, ?, ?, ?)");
            if ($query === false) {
                die("Prepare failed: " . $connect->error);
            }
            
            $query->bind_param("ssssss", $Name, $USN, $password, $Email, $Question, $Answer);

            if ($query->execute()) {
                echo "<center>You have registered successfully...!! Go back to </center>";
                echo "<center><a href='index.php'>Login here</a></center>";
            } else {
                echo "<center>Error during registration. Please try again later.</center>";
            }
        } else {
            echo "<center>Your passwords do not match</center>";
        }
    } else {
        echo "<center>This USN already exists</center>";
    }

    // Close the prepared statements
    $check->close();
    if (isset($query)) {
        $query->close();
    }
}

// Close the database connection
$connect->close();
?>
