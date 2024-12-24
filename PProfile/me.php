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

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                    <li><a href="cse.php" ><i class="fa fa-home fa-fw"></i>CSE</a></li>
                    <li><a href="ece.php"><i class="fa fa-home fa-fw"></i>ECE</a></li>
                    <li><a href="eee.php"><i class="fa fa-home fa-fw"></i>EEE</a></li>
                    <li><a href="cve.php"><i class="fa fa-home fa-fw"></i>CVE</a></li>
                    <li><a href="me.php" class="active"><i class="fa fa-home fa-fw"></i>ME</a></li>
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
                        <h2>Approved Students List of ME</h2>
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
                                    $num_rec_per_page = 2;
                                    $conn = new mysqli('localhost', 'root', '', 'placement');

                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                                    $start_from = ($page - 1) * $num_rec_per_page;

                                    // Fetch approved CSE students
                                    $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE Approve='1' AND Branch='ME' LIMIT ?, ?");
                                    $stmt->bind_param("ii", $start_from, $num_rec_per_page);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
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

                                    $stmt->close();
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
                        // Get total records for pagination
                        $sql = "SELECT COUNT(*) AS total FROM basicdetails WHERE Approve='1' AND Branch='ME'";
                        $result = $conn->query($sql);
                        $total_records = $result->fetch_assoc()['total'];
                        $total_pages = ceil($total_records / $num_rec_per_page);

                        $currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                        if ($currentpage > 1) {
                            $prev = $currentpage - 1;
                            echo "<li><a href='me.php?page=" . $prev . "'><</a></li>";
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $currentpage) {
                                echo "<li class='active'><a href='me.php?page=" . $i . "'>" . $i . "</a></li>";
                            } else {
                                echo "<li><a href='me.php?page=" . $i . "'>" . $i . "</a></li>";
                            }
                        }

                        if ($currentpage < $total_pages) {
                            $nxt = $currentpage + 1;
                            echo "<li><a href='me.php?page=" . $nxt . "'>></a></li>";
                        }

                        echo "<li><a>Total Pages: " . $total_pages . "</a></li>";

                        // Close the connection
                        $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>