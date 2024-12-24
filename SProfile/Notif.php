<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database connection
$connect = mysqli_connect("localhost", "root", "", "placement") or die("Couldn't connect to database");

// Define how many notifications to display per page
$limit = 5;

// Get the current page number from the URL, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total notifications
$total_result = mysqli_query($connect, "SELECT COUNT(*) as count FROM notifications");
$total_row = mysqli_fetch_assoc($total_result);
$total_notifications = $total_row['count'];

// Calculate total pages
$total_pages = ceil($total_notifications / $limit);

// Fetch notifications for the current page
$result = mysqli_query($connect, "SELECT * FROM notifications ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

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
  <title>Notification</title>
  <meta name="description" content="">
  <meta name="author" content="templatemo">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
  
  <!-- HTML5 shim for IE support -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
      <header class="templatemo-site-header">
        <div class="square"></div>
        <h1>Welcome<br><?php echo htmlspecialchars($_SESSION['username']); ?></h1>
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
      <nav class="templatemo-left-nav">
        <ul>
          <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
          <li><a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
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
              <li><a href="../Drives/index.php">Drives Homepage</a></li>
              <li><a href="#" class="active">Notifications</a></li>
              <li><a href="Change Password.php">Change Password</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <div class="templatemo-content-container">
        <div class="templatemo-content-widget white-bg">
          <h1 class="text-center">Department Messages</h1>
          <h2>Notifications</h2>

          <?php
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $subject = htmlspecialchars($row['SUBJECT'] ?? "Subject not provided");
                  $message = nl2br(htmlspecialchars($row['message'] ?? "Message content not available"));
                  $sender = htmlspecialchars($row['sender'] ?? "Sender information not available");
                  $created_at = htmlspecialchars($row['created_at'] ?? "Date not available");

                  echo "<h3>$subject</h3>";
                  echo "<p>$message</p>";
                  echo "<small>Sent by: $sender on $created_at</small><hr>";
              }
          } else {
              echo "<p>No notifications found.</p>";
          }

          // Pagination Links
          echo '<nav aria-label="Page navigation">';
          echo '<ul class="pagination justify-content-center">';
          for ($i = 1; $i <= $total_pages; $i++) {
              $active = ($i === $page) ? 'active' : '';
              echo "<li class='page-item $active'><a class='page-link' href='Notif.php?page=$i'>$i</a></li>";
          }
          echo '</ul>';
          echo '</nav>';
          ?>

        </div>
        <footer class="text-right">
          <p>Copyright &copy; 2024 KARE-PMS | Developed by <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a></p>
        </footer>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
  <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
