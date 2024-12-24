<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.png" type="image/icon">
    <link rel="icon" href="favicon.png" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT Students</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <a href="../PProfile/manage-users.php" target="_parent" rel="noopener noreferrer"><h1>Welcome<br><?php echo $_SESSION['pusername']; ?></h1></a>
            </header>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="ise.php" class="active"><i class="fa fa-home fa-fw"></i>IT</a></li>
                    <li><a href="cse.php"><i class="fa fa-home fa-fw"></i>CSE</a></li>
                    <li><a href="ece.php"><i class="fa fa-home fa-fw"></i>ECE</a></li>
                    <li><a href="eee.php"><i class="fa fa-home fa-fw"></i>EEE</a></li>
                    <li><a href="cve.php"><i class="fa fa-home fa-fw"></i>CVE</a></li>
                    <li><a href="me.php"><i class="fa fa-home fa-fw"></i>ME</a></li>
                    <li><a href="bs.php"><i class="fa fa-home fa-fw"></i>BASIC SCIENCE</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <div class="row">
                    <nav class="templatemo-top-nav col-lg-12 col-md-12">
                        <ul class="text-uppercase">
                            <li><a href="../../Homepage/index.php">Home KARE-PMS</a></li>
                            <li><a href="../Drives/index.php">Drives Home</a></li>
                            <li><a href="Notif.php">Notifications</a></li>
                            <li><a href="Change Password.php">Change Password</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <center>
                        <h2>Approved Students List of IT</h2>
                    </center>
                    <div class="templatemo-content-widget no-padding">
                        <div class="panel panel-default table-responsive">
                            <table class="table table-striped table-bordered templatemo-user-table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>USN</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>Sem</th>
                                        <th>Branch</th>
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
                                    $num_rec_per_page = 15;
                                    $connect = mysqli_connect('localhost', 'root', '', 'placement');
                                    if (!$connect) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    // Pagination
                                    if (isset($_GET["page"])) {
                                        $page  = $_GET["page"];
                                    } else {
                                        $page = 1;
                                    }
                                    $start_from = ($page - 1) * $num_rec_per_page;

                                    // Query to fetch approved IT students
                                    $sql = "SELECT * FROM basicdetails WHERE Approve = 1 AND Branch = 'IT' LIMIT $start_from, $num_rec_per_page";
                                    $rs_result = $connect->query($sql);

                                    if ($rs_result->num_rows > 0) {
                                        while ($row = $rs_result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['USN']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['Mobile']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['Sem']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['Branch']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['SSLC']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['PU/Dip']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['BE']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['Backlogs']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['HofBacklogs']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['DetainYears']) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='14' class='text-center'>No records found</td></tr>";
                                    }

                                    mysqli_close($connect);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrap">
                    <ul class="pagination">
                        <?php
                        $connect = mysqli_connect('localhost', 'root', '', 'placement');
                        if (!$connect) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM basicdetails WHERE Approve = 1 AND Branch = 'IT'";
                        $rs_result = $connect->query($sql);
                        $total_records = $rs_result->num_rows;
                        $total_pages = ceil($total_records / $num_rec_per_page);

                        $current_page = (isset($_GET['page']) ? $_GET['page'] : 1);

                        // Previous Page Link
                        if ($current_page > 1) {
                            echo "<li><a href='ise.php?page=" . ($current_page - 1) . "'><</a></li>";
                        }

                        // Page Links
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active_class = ($i == $current_page) ? "class='active'" : "";
                            echo "<li $active_class><a href='ise.php?page=$i'>$i</a></li>";
                        }

                        // Next Page Link
                        if ($current_page < $total_pages) {
                            echo "<li><a href='ise.php?page=" . ($current_page + 1) . "'>></a></li>";
                        }

                        echo "<li><a>Total Pages: $total_pages</a></li>";

                        mysqli_close($connect);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
