<?php
  session_start();
  if($_SESSION["pusername"]){

  }
   else {
	   header("location: index.php");
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
    <title>Placement - Home</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <?php
		  $Welcome = "How are You?";
          echo "<h1>" . $Welcome . "<br>". $_SESSION['pusername']. "</h1>";
		  ?>>
        </header>
        <div class="profile-photo-container">
          <img src="images/bicycle.jpg" alt="Profile Photo" class="img-responsive">
          <div class="profile-photo-overlay"></div>
        </div>
        <!-- Search box -->
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
            <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
            <li><a href="Placement Drives.php"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
            <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
            <li><a href="queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
            li><a href="Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
            <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
          </ul>
        </nav>
      </div>
      <!-- Main content -->
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
               <li><a href="../../Homepage/index.php">Home KARE</a></li>
                <li><a href="../../Drives/index.php">Drives Home</a></li>
                <li><a href="Notif.php">Notifications</a></li>
                <li><a href="Change Password.php">Change Password</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">Welcome to KARE</h2>
              <p></p>
              <p>Hello Officer! Have a great day with us! With KARE Account, You can add drives, Send Notifications and View the Eligibility Criteria of Students.</p>
              <p>Hope you enjoy doing that. Greetings!!</p>
              <p><a href="Placement Drives.php">Placement Drives</a></p>
              <p><a href="manage-users.php">View Students</a></p>
              <p><a href="preferences.php">Update your Profile</a></p>

            </div>
            <div class="templatemo-content-widget white-bg col-1 text-center">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">Our Motto</h2>
              <h5 class="text-uppercase margin-bottom-10">Working with Confidence</h5>
              <img src="images/bicycle.jpg" alt="Bicycle" class="img-circle img-thumbnail">
            </div>
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">GRADES</h2><hr>
              <div class="progress">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
              </div>
            </div>
          </div>
          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">
              <div class="templatemo-content-widget orange-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase">Updates</h2>
                    <p>View the New updates and Update the things Required to Keep Moving</p>
                  </div>
                </div>
              </div>
              <div class="templatemo-content-widget white-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase">Upcomming Events</h2>
                    <p>Get the Latest on going Events in the campus and you can add one so that it reflects all the user database</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Other PTO Details</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Username</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>John</td>
                        <td>Smith</td>
                        <td>@jS</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Bill</td>
                        <td>Jones</td>
                        <td>@bJ</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Mary</td>
                        <td>James</td>
                        <td>@mJ</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Steve</td>
                        <td>Bride</td>
                        <td>@sB</td>
                      </tr>
                      <tr>
                        <td>5.</td>
                        <td>Paul</td>
                        <td>Richard</td>
                        <td>@pR</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> <!-- Second row ends -->

          <footer class="text-right">
           <p>Copyright &copy; 2024 KARE-PMS | Developed by
              <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a>
            </p>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>
