<?php
session_start();
if (isset($_SESSION['pusername'])) {
    echo "Welcome, " . htmlspecialchars($_SESSION['pusername']) . "!";
} else {
    header("location: index.php");
    exit(); // It's good practice to exit after a header redirect
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="favicon.png" type="image/icon">
    <link rel="icon" href="favicon.png" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
    <div class="bg">
        <div class="templatemo-content-container">
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped table-bordered templatemo-user-table">
                        <thead>
                            <tr>
                                <th>Sem</th>
                                <th>Branch</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>USN</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>SSLC</th>
                                <th>PU/Dip</th>
                                <th>BE</th>
                                <th>Backlogs</th>
                                <th>History Of Backlogs</th>
                                <th>Detain Years</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection
                            $conn = mysqli_connect('localhost', 'root', '', 'placement');

                            // Check connection
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            if (isset($_POST['s3'])) {
                                $Csem = $_POST['csem'];

                                // Prepared statement to count students
                                $stmt = $conn->prepare("SELECT COUNT(*) FROM basicdetails WHERE `Approve`='1' AND Sem=?");
                                $stmt->bind_param("s", $Csem);
                                $stmt->execute();
                                $stmt->bind_result($count);
                                $stmt->fetch();
                                $stmt->close();

                                echo "<br><h3>Students in Semester '$Csem': $count</h3>";

                                // Prepared statement to select students
                                $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE `Approve`='1' AND Sem=? ORDER BY Branch");
                                $stmt->bind_param("s", $Csem);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo '<td>' . htmlspecialchars($row['Sem']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Branch']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['USN']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Mobile']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Email']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['DOB']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['SSLC']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['PU/Dip']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['BE']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Backlogs']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['HofBacklogs']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['DetainYears']) . '</td>';
                                    echo "</tr>";
                                }

                                $stmt->close();
                            }

                            // Close connection
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="text-right">
            <p>Copyright &copy; 2015 KARE | Developed by
                <a href="http://znumerique.azurewebsites.net" target="_parent">Vijay</a>
            </p>
        </footer>
    </div>
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
