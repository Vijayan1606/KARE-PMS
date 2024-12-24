<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    exit("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database connection
$connect = mysqli_connect("localhost", "root", "", "placement");
if (!$connect) {
    die("Couldn't connect to database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set
    if (isset($_POST['subject']) && isset($_POST['message'])) {
        // Sanitize user input
        $subject = mysqli_real_escape_string($connect, $_POST['subject']);
        $message = mysqli_real_escape_string($connect, $_POST['message']);
        $sender = $_SESSION['pusername'];

        // Prepare the SQL statement to prevent SQL injection
        $sql1 = "INSERT INTO notifications (subject, message, sender) VALUES (?, ?, ?)";
        $stmt1 = mysqli_prepare($connect, $sql1);
        
        // Insert into the notifications table
        if ($stmt1) {
            mysqli_stmt_bind_param($stmt1, "sss", $subject, $message, $sender);
            if (mysqli_stmt_execute($stmt1)) {
                echo "<h2>Notification Sent!</h2>";
                echo "<p>Subject: " . htmlspecialchars($subject) . "</p>";
                echo "<p>Message: " . nl2br(htmlspecialchars($message)) . "</p>";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt1);
            }
            mysqli_stmt_close($stmt1);
        } else {
            echo "Error preparing statement: " . mysqli_error($connect);
        }

        // Prepare the SQL statement for RNoti
        $sql2 = "INSERT INTO rmessage (subject, message, sender) VALUES (?, ?, ?)";
        $stmt2 = mysqli_prepare($connect, $sql2);

        // Insert into the RNoti table
        if ($stmt2) {
            mysqli_stmt_bind_param($stmt2, "sss", $subject, $message, $sender);
            if (!mysqli_stmt_execute($stmt2)) {
                echo "Error sending notification to RNoti: " . mysqli_stmt_error($stmt2);
            }
            mysqli_stmt_close($stmt2);
        } else {
            echo "Error preparing RNoti statement: " . mysqli_error($connect);
        }

    } else {
        echo "Please fill in all fields.";
    }

    // Close the database connection
    mysqli_close($connect);
} else {
    echo "Invalid request.";
}
?>
