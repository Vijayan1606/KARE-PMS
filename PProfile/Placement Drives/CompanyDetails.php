<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}

// Establish database connection
$connect = new mysqli('localhost', 'root', '', 'placement');

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../favicon.png" type="image/icon">
    <link rel="icon" href="../favicon.png" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Details</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
</head>
<body>
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <div class="square"></div>
            <h1>Welcome<br><?php echo $_SESSION['pusername']; ?></h1>
        </header>
        <div class="profile-photo-container">
            <img src="../images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
            <div class="profile-photo-overlay"></div>
        </div>
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
        <div class="templatemo-content-container">
            <h2>Company Details</h2>
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
                            <td>Detain Years</td>
                            <td>Others Details</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num_rec_per_page = 15;
                    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                    $start_from = ($page - 1) * $num_rec_per_page;

                    $sql = "SELECT * FROM addpdrive ORDER BY Date DESC LIMIT $start_from, $num_rec_per_page";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['CompanyName']}</td>";
                            echo "<td>{$row['Date']}</td>";
                            echo "<td>{$row['C/P']}</td>";
                            echo "<td>{$row['PVenue']}</td>";
                            echo "<td>{$row['SSLC']}</td>";
                            echo "<td>{$row['PU/Dip']}</td>";
                            echo "<td>{$row['BE']}</td>";
                            echo "<td>{$row['Backlogs']}</td>";
                            echo "<td>{$row['HofBacklogs']}</td>";
                            echo "<td>{$row['DetainYears']}</td>";
                            echo "<td>{$row['ODetails']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">
                <ul class="pagination">
                    <?php
                    $sql = "SELECT COUNT(*) FROM addpdrive";
                    $result = $connect->query($sql);
                    $total_records = $result->fetch_array()[0];
                    $total_pages = ceil($total_records / $num_rec_per_page);

                    if ($page > 1) {
                        echo "<li><a href='CompanyDetails.php?page=" . ($page - 1) . "'>&lt;</a></li>";
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                            echo "<li class='active'><a>$i</a></li>";
                        } else {
                            echo "<li><a href='CompanyDetails.php?page=$i'>$i</a></li>";
                        }
                    }

                    if ($page < $total_pages) {
                        echo "<li><a href='CompanyDetails.php?page=" . ($page + 1) . "'>&gt;</a></li>";
                    }
                    ?>
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

<?php
$connect->close(); // Close the database connection
?>
