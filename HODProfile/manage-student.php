<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['husername'])) {
  header("location: index.php");
  exit();
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
  <title>Manage Students</title>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">

  <style>
    input[type="checkbox"] {
      display: inline-block;
      margin: 5px;
    }
  </style>
</head>

<body>
  <!-- Left Sidebar -->
  <div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
    <header class="templatemo-site-header" style="background-color: #343a40; color: #f8f9fa; padding: 20px;">
    <h1 style="font-size: 24px; color: #f8f9fa;">Welcome <?php echo $_SESSION['husername']; ?></h1>
    <h2 style="font-size: 20px; color: #00bbbb;">(<?php echo $_SESSION['department']; ?>)</h2>
</header>

      <nav class="templatemo-left-nav">
        <ul>
          <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
          <li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>Manage Students</a></li>
          <li><a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
          <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
        </ul>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="templatemo-content col-1 light-gray-bg">
      <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
          <div class="panel panel-default table-responsive">
            <form action="approve.php" method="POST">
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <!-- Select All Checkbox -->
                    <th><input type="checkbox" id="select-all"> Select All</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>USN</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Dob</th>
                    <th>Current Sem</th>
                    <th>Branch</th>
                    <th>SSLC Percentage</th>
                    <th>PU Percentage</th>
                    <th>BE Aggregate</th>
                    <th>Current Backlogs</th>
                    <th>History of Backlogs</th>
                    <th>Detain Years</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Database connection
                  $p = $_SESSION['department'];
                  $num_rec_per_page = 15;
                  $conn = mysqli_connect('localhost', 'root', '', 'placement');
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                  }

                  // Get the current page number
                  $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                  $start_from = ($page - 1) * $num_rec_per_page;

                  // Query to fetch students
                  $sql = "SELECT * FROM basicdetails WHERE Approve=0 AND Branch='$p' LIMIT $start_from, $num_rec_per_page";
                  $rs_result = $conn->query($sql);

                  // Loop through results and display rows
                  while ($row = $rs_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='students[]' value='" . $row['USN'] . "' class='student-checkbox'></td>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['LastName'] . "</td>";
                    echo "<td>" . $row['USN'] . "</td>";
                    echo "<td>" . $row['Mobile'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['DOB'] . "</td>";
                    echo "<td>" . $row['Sem'] . "</td>";
                    echo "<td>" . $row['Branch'] . "</td>";
                    echo "<td>" . $row['SSLC'] . "</td>";
                    echo "<td>" . $row['PU/Dip'] . "</td>";
                    echo "<td>" . $row['BE'] . "</td>";
                    echo "<td>" . $row['Backlogs'] . "</td>";
                    echo "<td>" . $row['HofBacklogs'] . "</td>";
                    echo "<td>" . $row['DetainYears'] . "</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>

              <!-- Approve Button -->
              <div class="pagination-wrap">
                <button type="submit" class="templatemo-edit-btn">Approve Selected</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="pagination-wrap">
        <ul class="pagination">
          <?php
          // Pagination logic
          $sql = "SELECT * FROM basicdetails WHERE Approve=0 AND Branch='$p'";
          $rs_result = $conn->query($sql);
          $total_records = $rs_result->num_rows;
          $total_pages = ceil($total_records / $num_rec_per_page);
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

          // Previous button
          if ($current_page > 1) {
            $prev = $current_page - 1;
            echo "<li><a href='manage-student.php?page=" . $prev . "'><</a></li>";
          }

          // Page numbers
          for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li><a href='manage-student.php?page=" . $i . "'>" . $i . "</a></li>";
          }

          // Next button
          if ($current_page < $total_pages) {
            $next = $current_page + 1;
            echo "<li><a href='manage-student.php?page=" . $next . "'>></a></li>";
          }
          ?>
        </ul>
      </div>

      <center>
        <label class="control-label" for="inputNote">
          <center>
            <h2>OR</h2>
          </center>
          <br /><br />
          To View All Students, Click the Link below:
        </label><br /><br />
        <a href="manage-users1.php" class="templatemo-blue-button">View All</a>
      </center>
    </div>
  </div>

  <footer class="text-center py-4" style="background-color: #343a40; color: #f8f9fa; font-size: 14px;">
    <p>&copy; 2024 KARE-PMS | Developed By <a href="https://personal-portfolio-4i59.vercel.app/" target="_blank" style="color: #f8f9fa; text-decoration: none; font-weight: bold;">Vijay</a></p>
</footer>

  <!-- JS -->
  <script src="js/jquery-1.11.2.min.js"></script>
  <script>
    $(document).ready(function () {
      // 'Select All' checkbox functionality
      $('#select-all').click(function () {
        var checkedStatus = this.checked; // Check whether the "Select All" checkbox is checked
        $('.student-checkbox').each(function () {
          this.checked = checkedStatus; // Update each checkbox status to match the "Select All" checkbox
        });
      });
    });
  </script>
</body>

</html>
