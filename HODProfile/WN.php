<?php
session_start();
if (!isset($_SESSION["husername"])) {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database connection
$connect = mysqli_connect("localhost", "root", "", "placement") or die("Couldn't connect to database");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = mysqli_real_escape_string($connect, $_POST['subject']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    // Insert the notification into the database
    $sql = "INSERT INTO notifications (subject, message, sender) VALUES ('$subject', '$message', '{$_SESSION['husername']}')";
    
    if (mysqli_query($connect, $sql)) {
        echo "<h2>Notification Sent!</h2>";
        echo "<p>Subject: " . htmlspecialchars($subject) . "</p>";
        echo "<p>Message: " . nl2br(htmlspecialchars($message)) . "</p>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }
    
    mysqli_close($connect);
} else {
    echo "Invalid request.";
}
?>
