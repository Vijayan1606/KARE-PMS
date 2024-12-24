<?php
session_start();
if (isset($_SESSION['pusername'])) {
    echo "Welcome, " . htmlspecialchars($_SESSION['pusername']) . "!";
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
    <title>Departmental Search</title>
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
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped table-bordered templatemo-user-table">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>Sem</th>
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

                            if (isset($_POST['s4'])) {
                                $Cbranch = $_POST['cbranch'];

                                // Prepared statement to count students
                                $stmt = $conn->prepare("SELECT COUNT(*) FROM basicdetails WHERE `Approve`='1' AND Branch=?");
                                $stmt->bind_param("s", $Cbranch);
                                $stmt->execute();
                                $stmt->bind_result($count);
                                $stmt->fetch();
                                $stmt->close();

                                echo "<br><h3>Students in '$Cbranch' Branch: $count</h3>";

                                // Prepared statement to select students
                                $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE `Approve`='1' AND Branch=? ORDER BY Sem");
                                $stmt->bind_param("s", $Cbranch);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo '<td>' . htmlspecialchars($row['Branch']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Sem']) . '</td>';
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
    <script>
        $(document).ready(function () {
            // Content widget with background image
            var imageUrl = $('img.content-bg-img').attr('src');
            $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
            $('img.content-bg-img').hide();
        });
    </script>
</body>

</html>
