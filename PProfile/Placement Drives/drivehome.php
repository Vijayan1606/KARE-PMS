<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit;
}

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'placement');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$num_rec_per_page = 15;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start_from = ($page - 1) * $num_rec_per_page;

// Fetch data from the database
$sql = "SELECT a.*, u.*
        FROM addpdrive a
        JOIN updatedrive u ON a.CompanyName = u.CompanyName AND a.Date = u.Date
        LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $start_from, $num_rec_per_page);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../favicon.png" type="image/icon">
    <link rel="icon" href="../favicon.png" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Drive Details</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
</head>
<body>
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <?php
                echo "<h1>Welcome<br>" . htmlspecialchars($_SESSION['pusername']) . "</h1><br>";
                ?>
            </header>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="../login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="../Placement Drives.php" class="active"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
                    <li><a href="../manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                    <li><a href="../queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
                    <li><a href="../Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
                    <li><a href="../logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
                </ul>
            </nav>
        </div>
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <nav class="templatemo-top-nav col-lg-12 col-md-12">
                    <ul class="text-uppercase">
                        <li><a href="../../../Homepage/index.php">Home KARE-PMS</a></li>
                        <li><a href="../../../Drives/index.php">Drives Home</a></li>
                        <li><a href="../Notif.php">Notifications</a></li>
                        <li><a href="Change Password.php">Change Password</a></li>
                    </ul>
                </nav>
            </div>
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget no-padding">
                    <div class="panel panel-default table-responsive">
                        <table class="table table-striped table-bordered templatemo-user-table">
                            <thead>
                                <tr>
                                    <td>Company Name</td>
                                    <td>Date</td>
                                    <td>C/P</td>
                                    <td>PVenue</td>
                                    <td>SSLC</td>
                                    <td>PU/Dip</td>
                                    <td>BE</td>
                                    <td>Backlogs</td>
                                    <td>History of Backlogs</td>
                                    <td>Detain years</td>
                                    <td>USN</td>
                                    <td>Name</td>
                                    <td>Placed</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['CompanyName']); ?></td>
                                        <td><?= htmlspecialchars($row['Date']); ?></td>
                                        <td><?= htmlspecialchars($row['C/P']); ?></td>
                                        <td><?= htmlspecialchars($row['PVenue']); ?></td>
                                        <td><?= htmlspecialchars($row['SSLC']); ?></td>
                                        <td><?= htmlspecialchars($row['PU/Dip']); ?></td>
                                        <td><?= htmlspecialchars($row['BE']); ?></td>
                                        <td><?= htmlspecialchars($row['Backlogs']); ?></td>
                                        <td><?= htmlspecialchars($row['HofBacklogs']); ?></td>
                                        <td><?= htmlspecialchars($row['DetainYears']); ?></td>
                                        <td><?= htmlspecialchars($row['USN']); ?></td>
                                        <td><?= htmlspecialchars($row['Name']); ?></td>
                                        <td><?= htmlspecialchars($row['Placed']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination-wrap">
                    <ul class="pagination">
                        <?php
                        $sql = "SELECT COUNT(*) FROM addpdrive a JOIN updatedrive u ON a.CompanyName = u.CompanyName AND a.Date = u.Date";
                        $result = $mysqli->query($sql);
                        $total_records = $result->fetch_row()[0];
                        $total_pages = ceil($total_records / $num_rec_per_page);

                        if ($page > 1) {
                            echo "<li><a href='drivehome.php?page=" . ($page - 1) . "'>&lt;</a></li>";
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li><a href='drivehome.php?page=$i'>$i</a></li>";
                        }
                        if ($page < $total_pages) {
                            echo "<li><a href='drivehome.php?page=" . ($page + 1) . "'>&gt;</a></li>";
                        }
                        ?>
                        <li><a>Total Pages: <?= $total_pages; ?></a></li>
                    </ul>
                </div>
                <footer class="text-right">
                    <p>Copyright &copy; 2024 KARE-PMS | Developed by <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a></p>
                </footer>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>
</html>
