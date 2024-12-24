<?php
session_start();
if (!isset($_SESSION['husername'])) {
    header("location: index.php");
    exit();
}

if (isset($_POST['students'])) {
    $students = $_POST['students']; // Array of selected students
    $dob = $_POST["DOB"]; // DOB or approval date (adjust as needed)
    $conn = mysqli_connect('localhost', 'root', '', 'placement');

    if ($conn) {
        foreach ($students as $usn) {
            $sql = "UPDATE basicdetails SET Approve=1, ApprovalDate='$dob' WHERE USN='$usn'";
            if (mysqli_query($conn, $sql)) {
                echo "Student with USN $usn approved successfully.<br>";
            } else {
                echo "Error approving student with USN $usn: " . mysqli_error($conn) . "<br>";
            }
        }
        header("Location: manage-student.php"); // Redirect to the manage students page after approval
    } else {
        echo "Connection failed: " . mysqli_connect_error();
    }

    mysqli_close($conn);
} else {
    echo "No students selected for approval.";
}
?>
