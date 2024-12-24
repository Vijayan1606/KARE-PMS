<?php
session_start();

// Establishing connection with the server using mysqli
$connect = mysqli_connect("localhost", "root", "", "placement");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $USN = $_POST['USN'];
    $Question = $_POST['Question'];
    $Answer = $_POST['Answer'];

    // Prepared statement to check if the user exists
    $stmt = $connect->prepare("SELECT * FROM plogin WHERE Username = ?");
    $stmt->bind_param("s", $USN);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        $dbQuestion = $row['Question'];
        $dbAnswer = $row['Answer'];

        // Verify the security question and answer
        if ($dbQuestion === $Question && $dbAnswer === $Answer) {
            $_SESSION['reset'] = $USN;
            header("Location: Reset password.php");
            exit(); // Make sure to exit after redirecting
        } else {
            echo "<center>Failed! Incorrect Credentials</center>";
        }
    } else {
        echo "<center>Enter Something Correctly!!!</center>";
    }

    // Close the statement and connection
    $stmt->close();
    mysqli_close($connect);
}
?>
