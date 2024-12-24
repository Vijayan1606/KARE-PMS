<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    exit();
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
  <title>Company Details</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
  <div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
      <header class="templatemo-site-header">
        <h1>Welcome<br><?php echo htmlspecialchars($_SESSION['pusername']); ?></h1>
        <br>
      </header>
      <nav class="templatemo-left-nav">
        <ul>
          <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
          <li><a href="Placement Drives.php"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
          <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
          <li><a href="queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
          <li><a href="Students Eligibility.php" class="active"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
          <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
        </ul>
      </nav>
    </div>
    <div class="templatemo-content col-1 light-gray-bg">
      <div class="templatemo-top-nav-container">
        <nav class="templatemo-top-nav col-lg-12 col-md-12">
          <ul class="text-uppercase">
            <li><a href="../../Homepage/index.php">Home KARE-PMS</a></li>
            <li><a href="../Drives/index.php">Drives Home</a></li>
            <li><a href="Notif.php">Notifications</a></li>
            <li><a href="Change Password.php">Change Password</a></li>
          </ul>
        </nav>
      </div>
      <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
          <div class="panel panel-default table-responsive">
            <table class="table table-striped table-bordered templatemo-user-table">
              <thead>
                <tr>
                  <td>First Name</td>
                  <td>Last Name</td>
                  <td>USN</td>
                  <td>Mobile</td>
                  <td>Email</td>
                  <td>DOB</td>
                  <td>Current Sem</td>
                  <td>Branch</td>
                  <td>SSLC Percentage</td>
                  <td>PU Percentage</td>
                  <td>BE Aggregate</td>
                  <td>Current Backlogs</td>
                  <td>History of Backlogs</td>
                  <td>Detain Years</td>
                </tr>
              </thead>
              <tbody>
              <?php
              $num_rec_per_page = 15;
              $connect = mysqli_connect('localhost', 'root', '', 'placement');

              if (isset($_GET["page"])) {
                  $page  = $_GET["page"];
              } else {
                  $page = 1;
              }

              $start_from = ($page - 1) * $num_rec_per_page;
              $sql = "SELECT * FROM basicdetails WHERE Approve='1' ORDER BY FirstName DESC LIMIT $start_from, $num_rec_per_page";
              $rs_result = $connect->query($sql);

              if ($rs_result) {
                  while ($row = $rs_result->fetch_assoc()) {
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
              } else {
                  echo "<tr><td colspan='14'>No results found.</td></tr>";
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="pagination-wrap">
        <ul class="pagination">
          <?php
          // Resetting the connection for pagination count
          $sql = "SELECT * FROM basicdetails WHERE Approve='1'";
          $rs_result = $connect->query($sql);
          $total_records = $rs_result->num_rows;  // Count number of records
          $totalpage = ceil($total_records / $num_rec_per_page);

          if ($totalpage > 1) {
              for ($i = 1; $i <= $totalpage; $i++) {
                  if ($i == $page) {
                      echo "<li class='active'><strong>$i</strong></li>";
                  } else {
                      echo "<li><a href='eligibility.php?page=" . $i . "'>$i</a></li>";
                  }
              }
          }
          ?>
        </ul>
      </div>

      <footer class="text-right">
        <p>Copyright &copy; 2024 KARE-PMS | Developed by <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a></p>
      </footer>
    </div>
  </div>

  <!-- JS -->
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
