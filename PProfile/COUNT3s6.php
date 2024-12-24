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
    <title>Manage Students</title>
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
                                <td><a class="white-text templatemo-sort-by">First Name </a></td>
                                <td><a class="white-text templatemo-sort-by">Last Name </a></td>
                                <td><a class="white-text templatemo-sort-by">USN </a></td>
                                <td><a class="white-text templatemo-sort-by">Mobile </a></td>
                                <td><a class="white-text templatemo-sort-by">Email </a></td>
                                <td><a class="white-text templatemo-sort-by">DOB</a></td>
                                <td><a class="white-text templatemo-sort-by">Sem </a></td>
                                <td><a class="white-text templatemo-sort-by">Branch </a></td>
                                <td><a class="white-text templatemo-sort-by">SSLC </a></td>
                                <td><a class="white-text templatemo-sort-by">PU/Dip </a></td>
                                <td><a class="white-text templatemo-sort-by">BE </a></td>
                                <td><a class="white-text templatemo-sort-by">Backlogs </a></td>
                                <td><a class="white-text templatemo-sort-by">History Of Backlogs </a></td>
                                <td><a class="white-text templatemo-sort-by">Detain Years </a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connect = mysqli_connect('localhost', 'root', '', 'placement');

                            if (!$connect) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            if (isset($_POST['s6'])) {
                                // Escape user input to prevent SQL injection
                                $Cpu = mysqli_real_escape_string($connect, $_POST['cpu']);
                                $RESULT = mysqli_query($connect, "SELECT COUNT(*) AS count FROM basicdetails WHERE `Approve`='1' AND `PU/Dip` >= '$Cpu'");

                                if ($data = mysqli_fetch_assoc($RESULT)) {
                                    echo "<br><h3>Students Scored Above '$Cpu' in PU/Diploma: " . $data['count'] . "</h3>";
                                }

                                $sql = mysqli_query($connect, "SELECT * FROM basicdetails WHERE `Approve`='1' AND `PU/Dip` >= '$Cpu'");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    echo "<tr>";
                                    echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['USN']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Mobile']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Email']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['DOB']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Sem']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Branch']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['SSLC']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['PU/Dip']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['BE']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Backlogs']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['HofBacklogs']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['DetainYears']) . '</td>';
                                    echo "</tr>";
                                }
                            }

                            // Close connection
                            mysqli_close($connect);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="text-right">
            <p>Copyright &copy; 2015 KARE | Developed by <a href="" target="_parent"> Vijay</a></p>
        </footer>
    </div>
    </div>
    </div>
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
    <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
    <script>
        $(document).ready(function() {
            // Content widget with background image
            var imageUrl = $('img.content-bg-img').attr('src');
            $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
            $('img.content-bg-img').hide();
        });
    </script>
</body>

</html>
