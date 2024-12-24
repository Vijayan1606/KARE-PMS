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
    // Validate if the required fields are set
    if (isset($_POST['Branch'], $_POST['sslc'], $_POST['pugg'], $_POST['beagg'], $_POST['curback'], $_POST['hob'], $_POST['dy'])) {
        // Sanitize the user input to prevent SQL Injection
        $branch = mysqli_real_escape_string($connect, $_POST['Branch']);
        $sslc = mysqli_real_escape_string($connect, $_POST['sslc']);
        $pugg = mysqli_real_escape_string($connect, $_POST['pugg']);
        $beagg = mysqli_real_escape_string($connect, $_POST['beagg']);
        $curback = mysqli_real_escape_string($connect, $_POST['curback']);
        $hob = mysqli_real_escape_string($connect, $_POST['hob']);
        $dy = mysqli_real_escape_string($connect, $_POST['dy']);
        $sender = $_SESSION['pusername'];

        // Prepare the subject and message for the notifications
        $subject = "Placement Eligibility Update";
        $message = "Dear Student,\n\nYour eligibility details have been updated as follows:\n\n"
                 . "Branch of Study: $branch\n"
                 . "SSLC/10th Aggregate: $sslc\n"
                 . "12th/Diploma Aggregate: $pugg\n"
                 . "BE Aggregate: $beagg\n"
                 . "Current Backlogs: $curback\n"
                 . "History of Backlogs: $hob\n"
                 . "Detain Years: $dy\n\n"
                 . "Best Regards,\nThe Placement Team";

        // Prepare the SQL statement to insert the notification for the student (rmessage table)
        $sql1 = "INSERT INTO rmessage (subject, message, sender) VALUES (?, ?, ?)";
        $stmt1 = mysqli_prepare($connect, $sql1);

        if ($stmt1) {
            // Insert into the student notification table
            mysqli_stmt_bind_param($stmt1, "sss", $subject, $message, $sender);
            if (mysqli_stmt_execute($stmt1)) {
                echo "<h2>Notification Sent to Student!</h2>";
                echo "<p>Subject: " . htmlspecialchars($subject) . "</p>";
                echo "<p>Message: " . nl2br(htmlspecialchars($message)) . "</p>";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt1);
            }
            mysqli_stmt_close($stmt1);
        } else {
            echo "Error preparing statement for student notification: " . mysqli_error($connect);
        }

        // Prepare the message for HOD notification
        $hod_subject = "Student Eligibility Details Updated";
        $hod_message = "Dear HOD,\n\nThe eligibility details of a student have been updated as follows:\n\n"
                      . "Branch of Study: $branch\n"
                      . "SSLC/10th Aggregate: $sslc\n"
                      . "12th/Diploma Aggregate: $pugg\n"
                      . "BE Aggregate: $beagg\n"
                      . "Current Backlogs: $curback\n"
                      . "History of Backlogs: $hob\n"
                      . "Detain Years: $dy\n\n"
                      . "Best Regards,\nThe Placement Team";

        // Prepare the SQL statement to insert the notification for the HOD (notifications table)
        $sql2 = "INSERT INTO notifications (subject, message, sender) VALUES (?, ?, ?)";
        $stmt2 = mysqli_prepare($connect, $sql2);

        if ($stmt2) {
            // Insert into the HOD notification table
            mysqli_stmt_bind_param($stmt2, "sss", $hod_subject, $hod_message, $sender);
            if (mysqli_stmt_execute($stmt2)) {
                echo "<h2>Notification Sent to HOD!</h2>";
                echo "<p>Subject: " . htmlspecialchars($hod_subject) . "</p>";
                echo "<p>Message: " . nl2br(htmlspecialchars($hod_message)) . "</p>";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt2);
            }
            mysqli_stmt_close($stmt2);
        } else {
            echo "Error preparing statement for HOD notification: " . mysqli_error($connect);
        }

    } else {
        echo "<div class='alert alert-danger'>Please fill in all fields!</div>";
    }

    // Close the database connection
    mysqli_close($connect);
} else {
    echo "<div class='alert alert-danger'>Invalid request.</div>";
}
?>
