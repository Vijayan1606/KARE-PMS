<?php
session_start();
if (!isset($_SESSION["pusername"])) {
  header("location: index.php");
  exit("You must be logged in to view this page <a href='index.php'>Click here</a>");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="favicon.png" type="image/icon">
  <link rel="icon" href="favicon.png" type="image/icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Placement - Notifications</title>
  <meta name="description" content="">
  <meta name="author" content="templatemo">
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
        <h1>Welcome<br><?php echo htmlspecialchars($_SESSION['pusername']); ?></h1>
      </header>
      <div class="profile-photo-container">
        <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
        <div class="profile-photo-overlay"></div>
      </div>
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
          <li><a href="Placement Drives.php"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
          <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
          <li><a href="queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
          <li><a href="Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
          <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
        </ul>
      </nav>
    </div>

    <div class="templatemo-content col-1 light-gray-bg">
      <div class="templatemo-top-nav-container">
        <div class="row">
          <nav class="templatemo-top-nav col-lg-12 col-md-12">
            <ul class="text-uppercase">
              <li><a href="../../Homepage/index.php">Home KARE-PMS</a></li>
              <li><a href="../Drives/blog.php">Drives Home</a></li>
              <li><a href="Notif.php" class="active">Notifications</a></li>
              <li><a href="Change Password.php">Change Password</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="templatemo-content-container">
        <div class="templatemo-content-widget white-bg">
          <h2 class="margin-bottom-10">Write Messages</h2>
          <p>Department Notifications to Students</p>
          <form action="WN.php" method="POST">
            <div class="row form-group">
              <div class="col-lg-12 form-group">
                <label class="control-label" for="inputNote">Subject:</label>
                <input type="text" name="subject" class="form-control" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-lg-12 form-group">
                <label class="control-label" for="inputNote">Message:</label>
                <textarea class="form-control" id="inputNote" rows="5" name="message" required></textarea>
              </div>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="templatemo-blue-button">POST</button>
              <button type="reset" class="templatemo-white-button">Clear</button>
            </div>
          </form>

        </div>

        <footer class="text-right">
          <p>Copyright &copy; 2024 KARE-PMS | Developed By <a href="#" target="_parent">Vijay</a></p>
        </footer>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
  <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>