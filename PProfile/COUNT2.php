<?php
  session_start();
 if (isset($_SESSION['pusername'])){
    
	
	   }
   else {
	   header("location: index.php");
   }
   
?>
<!DOCTYPE html>
<html>
<head>
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

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM addpdrive WHERE CompanyName = ?");
    $stmt->bind_param("s", $cname);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are results
    if ($result->num_rows > 0) {
        // Start a table for better structure
        echo "<table border='1'>";
        echo "<tr><th>Date</th><th>Campus/Pool</th><th>Pool Venue</th><th>SSLC</th><th>PU/Dip</th><th>BE Aggregate</th><th>Current Backlogs</th><th>History of Backlogs</th><th>Detain Years</th><th>Other Details</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>"; 
            echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['C/P']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['PVenue']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['SSLC']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['PU/Dip']) . "</td>";
            echo "<td>" . htmlspecialchars($row['BE']) . "</td>";	
            echo "<td>" . htmlspecialchars($row['Backlogs']) . "</td>";
            echo "<td>" . htmlspecialchars($row['HofBacklogs']) . "</td>";
            echo "<td>" . htmlspecialchars($row['DetainYears']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ODetails']) . "</td>";
            echo "</tr>"; 
        }
        echo "</table>";
    } else {
        echo "No results found for the specified company.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
mysqli_close($conn);
?>
</center>
</body></html>