<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    exit();
}

// Establish database connection for placement database
$connect = new mysqli("localhost", "root", "", "placement"); // Connection to the placement database

// Check if the connection was successful
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Fetch student data from the placement database
$studentQuery = "SELECT usn FROM basicdetails"; // Assuming 'basicdetails' table contains 'usn'
$studentResult = $connect->query($studentQuery);

// Fetch company data from the 'addpdrive' database
$companyConnect = new mysqli("localhost", "root", "", "placement"); // Connection to the addpdrive database
if ($companyConnect->connect_error) {
    die("Company Database connection failed: " . $companyConnect->connect_error);
}

$companyQuery = "SELECT CompanyName FROM addpdrive"; // Assuming 'addpdrive' table contains 'CompanyName'
$companyResult = $companyConnect->query($companyQuery);

// Check if student data query was successful
if (!$studentResult) {
    die('Student Query Failed: ' . $connect->error);
}

// Check if company data query was successful
if (!$companyResult) {
    die('Company Query Failed: ' . $companyConnect->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.png" type="image/icon">
    <link rel="icon" href="../favicon.png" type="image/icon">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Placement Drive Details</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
</head>

<body>
    <!-- Left Column (Sidebar) -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <h1>Update Drive Details</h1>
            </header>
            <div class="profile-photo-container">
                <img src="../images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
            </div>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="../login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="../Placement Drives.php" class="active"><i class="fa fa-briefcase fa-fw"></i>Placement Drives</a></li>
                    <li><a href="../manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                    <li><a href="../queries.php"><i class="fa fa-comments fa-fw"></i>Queries</a></li>
                    <li><a href="../Students Eligibility.php"><i class="fa fa-check-circle fa-fw"></i>Students Eligibility Status</a></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i>Sign Out</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <nav class="templatemo-top-nav col-lg-12 col-md-12">
                    <ul class="text-uppercase">
                        <li><a href="../../../Homepage/index.php">Home KARE-PMS</a></li>
                        <li><a href="../../../Drives/index.php">Drives Home</a></li>
                        <li><a href="../Notif.php">Notifications</a></li>
                        <li><a href="../Change Password.php">Change Password</a></li>
                    </ul>
                </nav>
            </div>

            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <h2 class="margin-bottom-10">Placement Drives</h2>
                    <p>Update Students Details</p>
                    <form action="updatedrive1.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <!-- USN Select -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="usn">USN</label>
                                <select name="usn" class="form-control" id="inputusn" required>
                                    <option value="">Select USN</option>
                                    <?php
                                    // Populate USN dropdown with student data
                                    while ($row = $studentResult->fetch_assoc()) {
                                        echo "<option value='" . $row['usn'] . "'>" . $row['usn'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Company Name Select -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="comname">Company Name</label>
                                <select name="comname" class="form-control" id="inputComName" required>
                                    <option value="">Select Company Name</option>
                                    <?php
                                    // Populate Company Name dropdown from addpdrive database
                                    while ($row = $companyResult->fetch_assoc()) {
                                        echo "<option value='" . $row['CompanyName'] . "'>" . $row['CompanyName'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Date -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="date">Date</label>
                                <input type="date" name="Date" class="form-control" id="inputDate" required>
                            </div>

                            <!-- Attendance -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="attendance">Attendance</label>
                                <select name="Attendance" class="form-control" id="inputAttendance" required>
                                    <option value="select">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Written Test -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="writtentest">Written Test</label>
                                <select name="WrittenTest" class="form-control" id="inputWrittenTest" required>
                                    <option value="select">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Group Discussion -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="gd">Group Discussion</label>
                                <select name="GD" class="form-control" id="inputGD" required>
                                    <option value="select">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Technical Interview -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="tech">Technical Interview</label>
                                <select name="Tech" class="form-control" id="inputTech" required>
                                    <option value="select">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Placed -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="placed">Placed</label>
                                <select name="Placed" class="form-control" id="inputPlaced" required>
                                    <option value="select">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="submit" class="templatemo-blue-button">Submit</button>
                            <button type="reset" class="templatemo-white-button">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-right">
        <p>Copyright &copy; 2024 KARE-PMS | Developed by
            <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a>
        </p>
    </footer>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
