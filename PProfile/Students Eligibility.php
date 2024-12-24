<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    exit(); // Ensures that no further code is executed after redirect
}

// Handle form submission
if (isset($_POST['submit'])) {
    $branch = $_POST['Branch'];
    $sslc = $_POST['sslc'];
    $pugg = $_POST['pugg'];
    $beagg = $_POST['beagg'];
    $curback = $_POST['curback'];
    $hob = $_POST['hob'];
    $dy = $_POST['dy'];

    // Validate inputs (basic validation)
    if (empty($branch) || empty($sslc) || empty($pugg) || empty($beagg) || empty($curback) || $hob == 'Y/N' || $dy == 'select') {
        $error_message = "All fields are required!";
    } else {
        // Process the form data
        // Example: Save to database or perform other operations
        // Example: $_SESSION['message'] = 'Form submitted successfully!';
        
        // If successful, redirect or give a success message
        header('Location: success.php');
        exit();
    }
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
    <title>Principal - Student Details</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet">
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
                <h1>Welcome<br><?php echo $_SESSION['pusername']; ?></h1>
            </header>
            <div class="profile-photo-container">
                <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
            </div>
            <!-- Sidebar navigation -->
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="login.php"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
                    <li><a href="Placement Drives.php"><i class="fa fa-briefcase fa-fw"></i> Placement Drives</a></li>
                    <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i> View Students</a></li>
                    <li><a href="queries.php"><i class="fa fa-comments fa-fw"></i> Queries</a></li>
                    <li><a href="Students Eligibility.php" class="active"><i class="fa fa-sliders fa-fw"></i> Eligibility Status</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sign Out</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
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
                    <h2 class="margin-bottom-10">ELIGIBILITY CRITERIA</h2>

                    <?php
                    // Display error message if validation fails
                    if (isset($error_message)) {
                        echo "<div class='alert alert-danger'>$error_message</div>";
                    }
                    ?>

                    <form action="SEligible.php" method="POST" class="templatemo-login-form">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block" >Branch of Study</label>
                                <select name="Branch" class="form-control" required>
                                    <option value="">Branch</option>
                                    <option value="IT">IT</option>
                                    <option value="CSE">CSE</option>
                                    <option value="EEE">EEE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="ME">ME</option>
                                    <option value="CVE">CVE</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="sslc">SSLC/10th Aggregate</label>
                                <input type="text" name="sslc" class="form-control" id="sslc" required>
                            </div>

                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Pu">12th/Diploma Aggregate</label>
                                <input type="text" name="pugg" class="form-control" id="Pu" required>
                            </div>

                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="BE">BE Aggregate</label>
                                <input type="text" name="beagg" class="form-control" id="BE" required>
                            </div>

                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="curback">Current Backlogs</label>
                                <input type="number" name="curback" class="form-control" placeholder="Number of backlogs" required>
                            </div>

                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">History of Backlogs</label>
                                <select name="hob" class="form-control" required>
                                    <option value="Y/N">Y/N</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Detain Years</label>
                                <select name="dy" class="form-control" required>
                                    <option value="select">Years</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" name="submit" class="templatemo-blue-button">Submit</button>
                                <button type="reset" class="templatemo-white-button">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="text-right">
                <p>Copyright &copy; 2024 KARE-PMS | Developed By <a href="#" target="_parent">Vijay</a></p>
            </footer>
        </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
