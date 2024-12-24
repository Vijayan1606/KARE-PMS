<?php
  session_start();
  
  // Ensure the user is logged in
  if(!isset($_SESSION["username"])) {
    header("location: index.php");
    die("You must be logged in to view this page. <a href='index.php'>Click here</a> to log in.");
  }

  // Greet the logged-in user
  $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preferences</title>
    <meta name="description" content="User Preferences">
    <meta name="author" content="templatemo">

    <!-- External CSS Files -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">

</head>

<body>
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <h1>Welcome, <?php echo $username; ?>!</h1>
            </header>
            
            <div class="profile-photo-container">
                <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
            </div>
            
            <!-- Search Box -->
            <form class="templatemo-search-form" role="search">
                <div class="input-group">
                    <button type="submit" class="fa fa-search"></button>
                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                </div>
            </form>

            <div class="mobile-menu-icon">
                <i class="fa fa-bars"></i>
            </div>

            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="#" class="active"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
                    <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <div class="row">
                    <nav class="templatemo-top-nav col-lg-12 col-md-12">
                        <ul class="text-uppercase">
                            <li><a href="../../Homepage/index.html">Home KARE-PMS</a></li>
                            <li><a href="../Drives/index.php">Drives Homepage</a></li>
                            <li><a href="#">Overview</a></li>
                            <li><a href="login.html">Change Password</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Preferences Form -->
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <h2 class="margin-bottom-10">Preferences</h2>
                    <p>Update Your Details</p>

                    <!-- User Preferences Form -->
                    <form action="pref.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <!-- First Name & Last Name -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputFirstName">First Name</label>
                                <input type="text" name="Fname" class="form-control" id="inputFirstName" placeholder="Ram" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputLastName">Last Name</label>
                                <input type="text" name="Lname" class="form-control" id="inputLastName" placeholder="Laxman" required>
                            </div>

                            <!-- USN & Phone -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="usn">USN</label>
                                <input type="text" name="USN" class="form-control" id="usn" placeholder="1CG12IS000" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Phone">Phone:</label>
                                <input type="text" name="Num" class="form-control" id="Phone" placeholder="91xxxxxxxx" required>
                            </div>

                            <!-- Email & DOB -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Email">Email</label>
                                <input type="email" name="Email" class="form-control" id="Email" placeholder="abc@example.com" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="DOB">Date of Birth</label>
                                <input type="date" name="DOB" class="form-control" id="DOB" required>
                            </div>

                            <!-- Current Semester & Branch -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Current Semester</label>
                                <select name="Cursem" class="form-control" required>
                                    <option value="select">Semester</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Branch of Study</label>
                                <select name="Branch" class="form-control" required>
                                    <option value="select">Branch</option>
                                    <option value="BScience">Basic Science</option>
                                    <option value="IT">IT</option>
                                    <option value="CSE">CSE</option>
                                    <option value="EEE">EEE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="ME">ME</option>
                                    <option value="CVE">CVE</option>
                                </select>
                            </div>

                            <!-- Academic Details -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="sslc">SSLC/10th Aggregate</label>
                                <input type="text" name="Percentage" class="form-control" id="sslc" placeholder="e.g. 85%" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Pu">12th/Diploma Aggregate</label>
                                <input type="text" name="Puagg" class="form-control" id="Pu" placeholder="e.g. 90%" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="BE">BE Aggregate</label>
                                <input type="text" name="Beagg" class="form-control" id="BE" placeholder="e.g. 75%" required>
                            </div>

                            <!-- Backlogs & Detained Years -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Current Backlogs</label>
                                <select name="Backlogs" class="form-control" required>
                                    <option value="select">Numbers</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">History of Backlogs</label>
                                <select name="History" class="form-control" required>
                                    <option value="Y/N">Y/N</option>
                                    <option value="Y">Y</option>
                                    <option value="N">N</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Detained Years</label>
                                <select name="Dety" class="form-control" required>
                                    <option value="select">Years</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <!-- Profile Picture Upload -->
                            <div class="col-lg-12">
                                <label class="control-label templatemo-block">Upload your Profile Pic</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="filestyle" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                                <p>Maximum upload size is 5 MB.</p>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="form-group text-right">
                            <button type="submit" name="submit" class="templatemo-blue-button">Add</button>
                            <button type="submit" name="update" class="templatemo-blue-button">Update</button>
                            <button type="reset" class="templatemo-white-button">Reset</button>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <footer class="text-right">
                    <p>Copyright &copy; 2024 KARE-PMS | Developed by <a href="" target="_parent">Vijay</a></p>
                </footer>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
