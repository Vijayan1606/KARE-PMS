<?php
$connect = new mysqli("localhost", "root", "", "placement"); // Establishing connection with the database

// Check if the connection is successful
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_POST['submit'])) {
    // Fetching form data
    $Name = $_POST['Fullname'];
    $USN = $_POST['USN'];
    $password = $_POST['PASSWORD'];
    $repassword = $_POST['repassword'];
    $Email = $_POST['Email'];
    $Question = $_POST['Question'];
    $Answer = $_POST['Answer'];

    // Input validation
    if (empty($Name) || empty($USN) || empty($password) || empty($repassword) || empty($Email) || empty($Question) || empty($Answer)) {
        echo "<center>All fields are required.</center>";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<center>Invalid email format.</center>";
    } else {
        // Check if the USN already exists in the database
        $check = $connect->prepare("SELECT * FROM plogin WHERE Username = ?");
        if ($check === false) {
            die("Prepare failed: " . $connect->error);
        }

        $check->bind_param("s", $USN);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows == 0) {
            // Check if passwords match
            if ($repassword === $password) {
                // Hash the password before storing it
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and execute the SQL query to insert the new user
                $query = $connect->prepare("INSERT INTO plogin (Name, Username, PASSWORD, Email, Question, Answer) VALUES (?, ?, ?, ?, ?, ?)");
                if ($query === false) {
                    die("Prepare failed: " . $connect->error);
                }

                $query->bind_param("ssssss", $Name, $USN, $hashedPassword, $Email, $Question, $Answer);

                if ($query->execute()) {
                    echo "<center>You have registered successfully! Go back to </center>";
                    echo "<center><a href='index.php'>Login here</a></center>";
                } else {
                    echo "<center>Error during registration. Please try again later.</center>";
                }
            } else {
                echo "<center>Your passwords do not match.</center>";
            }
        } else {
            echo "<center>This USN already exists.</center>";
        }

        // Close the prepared statements
        $check->close();
        if (isset($query)) {
            $query->close();
        }
    }
}

// Close the database connection
$connect->close();
?>
