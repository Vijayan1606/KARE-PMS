<?php
session_start();
if (isset($_SESSION['pusername'])) {
    echo "Welcome, " . $_SESSION['pusername'] . "!";
} else {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--favicon-->
    <link rel="shortcut icon" href="favicon.png" type="image/icon">
    <link rel="icon" href="favicon.png" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QUERIES</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">

</head>

<body>
    <div class="bg">
        <div class="templatemo-content-container">
            <div class="templatemo-content-widget no-padding">
                <?php
                $connect = mysqli_connect('localhost', 'root', '', 'placement');
                if (!$connect) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if (isset($_POST['s2'])) {
                    $Susn = mysqli_real_escape_string($connect, $_POST['susn']);
                    $RESULT = $connect->query("SELECT * FROM basicdetails WHERE USN='$Susn'");

                    if ($RESULT && $RESULT->num_rows > 0) {
                        $row = $RESULT->fetch_assoc();
                        echo "<br><h3>Details of Student '$Susn'</h3>";
                        echo "<br><table>";
                        echo "<tr><td>First Name :</td><td>" . htmlspecialchars($row['FirstName']) . "</td></tr>";
                        echo "<tr><td>Last Name :</td><td>" . htmlspecialchars($row['LastName']) . "</td></tr>";
                        echo "<tr><td>USN :</td><td>" . htmlspecialchars($row['USN']) . "</td></tr>";
                        echo "<tr><td>Mobile :</td><td>" . htmlspecialchars($row['Mobile']) . "</td></tr>";
                        echo "<tr><td>Email :</td><td>" . htmlspecialchars($row['Email']) . "</td></tr>";
                        echo "<tr><td>DOB :</td><td>" . htmlspecialchars($row['DOB']) . "</td></tr>";
                        echo "<tr><td>Semester :</td><td>" . htmlspecialchars($row['Sem']) . "</td></tr>";
                        echo "<tr><td>Branch :</td><td>" . htmlspecialchars($row['Branch']) . "</td></tr>";
                        echo "<tr><td>SSLC Percentage :</td><td>" . htmlspecialchars($row['SSLC']) . "</td></tr>";
                        echo "<tr><td>PU/Diploma Percentage :</td><td>" . htmlspecialchars($row['PU/Dip']) . "</td></tr>";
                        echo "<tr><td>BE Aggregate :</td><td>" . htmlspecialchars($row['BE']) . "</td></tr>";
                        echo "<tr><td>Current Backlogs :</td><td>" . htmlspecialchars($row['Backlogs']) . "</td></tr>";
                        echo "<tr><td>History of Backlogs :</td><td>" . htmlspecialchars($row['HofBacklogs']) . "</td></tr>";
                        echo "<tr><td>Detain Years :</td><td>" . htmlspecialchars($row['DetainYears']) . "</td></tr>";
                        echo "</table>";
                    } else {
                        echo "<br><h3>No details found for Student '$Susn'</h3>";
                    }
                }
                ?>
                <footer class="text-right">
                    <p>Copyright &copy; 2018 KARE | Developed by <a href="" target="_parent">Vijay</a></p>
                </footer>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
    <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
</body>

</html>
