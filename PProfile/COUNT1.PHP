<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
</head>
<body>
<center>
<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'placement');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) { 
    $cname = $_POST['cname'];
    $date = $_POST['date'];

    // Array of column names to check
    $columns = ['Attendence', 'WT', 'GD', 'Technical', 'Placed'];

    foreach ($columns as $column) {
        // Check if column exists
        $checkColumn = $conn->query("SHOW COLUMNS FROM updatedrive LIKE '$column'");
        if ($checkColumn->num_rows > 0) {
            // Prepared statement
            $stmt = $conn->prepare("SELECT COUNT($column) as count FROM updatedrive WHERE $column=1 AND CompanyName=? AND Date=?");
            $stmt->bind_param("ss", $cname, $date);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            echo "<br>Number of Students Cleared " . htmlspecialchars($column) . ": " . $data['count'];
            // Close statement
            $stmt->close();
        } else {
            echo "<br>Column '$column' does not exist in the table.";
        }
    }
}

// Close connection
mysqli_close($conn);
?>
</center>
</body>
</html>
