<?php
session_start();
if (!isset($_SESSION['husername'])) {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database connection
$connect = mysqli_connect("localhost", "root", "", "placement");
if (!$connect) {
    die("Couldn't connect to database: " . mysqli_connect_error());
}

// Fetch notifications from RNoti table
$sql = "SELECT subject, message, created_at FROM rmessage ORDER BY created_at DESC"; // Order by latest first
$result = mysqli_query($connect, $sql);
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
  <title>HOD - Preferences</title>
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
        <?php
        echo "<h1>Welcome<br>{$_SESSION['husername']}<br>({$_SESSION['department']})</h1>";
        ?>
      </header>
      <div class="profile-photo-container">
        <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
        <div class="profile-photo-overlay"></div>
      </div>
      <nav class="templatemo-left-nav">
        <ul>
          <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
          <li><a href="manage-student.php"><i class="fa fa-users fa-fw"></i>Manage Students</a></li>
          <li><a href="#"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
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
              <li><a href="Notif.php">Notification</a></li>
              <li><a href="Change Password.php">Change Password</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <div class="templatemo-content-container">
        <div class="templatemo-content-widget white-bg">
          <center>
            <h2 class="margin-bottom-10">Read Message</h2>
            <p>Notifications from Placement Department and Principal</p>
          </center>
          
          <div class="notification-list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='notification-item'>";
                    echo "<h4>" . htmlspecialchars($row['subject']) . "</h4>";
                    echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                    echo "<small>" . htmlspecialchars($row['created_at']) . "</small>";
                    echo "</div><hr>";
                }
            } else {
                echo "<p>No notifications found.</p>";
            }
            // Close the database connection
            mysqli_close($connect);
            ?>
          </div>
        </div>

        <footer class="text-right">
          <p>Copyright &copy; 2001-2024 KARE-PMS | Developed by <a href="" target="_parent">Vijay</a></p>
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
