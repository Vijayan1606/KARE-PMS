<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    die("You must be logged in to view this page. <a href='index.php'>Click here</a>");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'placement');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$num_rec_per_page = 2;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start_from = ($page - 1) * $num_rec_per_page;

// Query to fetch approved CVE students
$sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='CVE' LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $start_from, $num_rec_per_page);
$stmt->execute();
$result = $stmt->get_result();
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
    <div class="templatemo-flex-row">
        <!-- Sidebar -->
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <a href="../PProfile/manage-users.php" target="_parent" rel="noopener noreferrer">
                    <h1>Welcome<br><?php echo $_SESSION['pusername']; ?></h1>
                </a>
            </header>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="ise.php"><i class="fa fa-home fa-fw"></i>IT</a></li>
                    <li><a href="cse.php"><i class="fa fa-home fa-fw"></i>CSE</a></li>
                    <li><a href="ece.php"><i class="fa fa-home fa-fw"></i>ECE</a></li>
                    <li><a href="eee.php"><i class="fa fa-home fa-fw"></i>EEE</a></li>
                    <li><a href="cve.php" class="active"><i class="fa fa-home fa-fw"></i>CVE</a></li>
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
                        <h2>Approved Students List of CVE</h2>
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
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                                            <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                                            <td><?php echo htmlspecialchars($row['USN']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Mobile']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['DOB']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Sem']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Branch']); ?></td>
                                            <td><?php echo htmlspecialchars($row['SSLC']); ?></td>
                                            <td><?php echo htmlspecialchars($row['PU/Dip']); ?></td>
                                            <td><?php echo htmlspecialchars($row['BE']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Backlogs']); ?></td>
                                            <td><?php echo htmlspecialchars($row['HofBacklogs']); ?></td>
                                            <td><?php echo htmlspecialchars($row['DetainYears']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrap">
                    <ul class="pagination">
                        <?php
                        // Get total records for pagination
                        $total_sql = "SELECT COUNT(*) AS total FROM basicdetails WHERE Approve='1' AND Branch='CVE'";
                        $total_result = $conn->query($total_sql);
                        $total_records = $total_result->fetch_assoc()['total'];
                        $total_pages = ceil($total_records / $num_rec_per_page);

                        if ($page > 1) {
                            echo "<li><a href='cve.php?page=" . ($page - 1) . "'>&lt;</a></li>";
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li" . ($i == $page ? " class='active'" : "") . "><a href='cve.php?page=$i'>$i</a></li>";
                        }

                        if ($page < $total_pages) {
                            echo "<li><a href='cve.php?page=" . ($page + 1) . "'>&gt;</a></li>";
                        }
                        ?>
                        <li><a>Total Pages: <?php echo $total_pages; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>