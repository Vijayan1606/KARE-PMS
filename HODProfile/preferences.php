<?php
session_start();
if (!isset($_SESSION['husername'])) {
    header("location: index.php");
    die("You must be logged in to view this page. <a href='index.php'>Click here</a>");
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
    <title>HOD - Preferences</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet">
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
                $Welcome = "Welcome";
                echo "<h1>" . $Welcome . "<br>" . $_SESSION['husername'] . "</h1>";
                echo "<h1>(" . $_SESSION['department'] . ")</h1>";
                ?>
            </header>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="manage-student.php"><i class="fa fa-users fa-fw"></i>Manage Students</a></li>
                    <li><a href="#" class="active"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
                    <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
                </ul>
            </nav>
        </div>

        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <h2 class="margin-bottom-10">Preferences</h2>
                    <p>Update your Details here:</p>
                    <form action="pref.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputFirstName">First Name</label>
                                <input type="text" class="form-control" name="FirstName" id="inputFirstName" placeholder="John" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputLastName">Last Name</label>
                                <input type="text" class="form-control" name="LastName" id="inputLastName" placeholder="Smith" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputUsername">Username</label>
                                <input type="text" class="form-control" name="Username" id="inputUsername" placeholder="Admin" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" name="Email" id="inputEmail" placeholder="admin@company.com" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-12 form-group">
                                <label for="inputNote">Note</label>
                                <textarea class="form-control" name="Note" id="inputNote" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="control-label templatemo-block">File Input</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="filestyle" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                                <p>Maximum upload size is 5 MB.</p>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="templatemo-blue-button">Update</button>
                            <button type="reset" class="templatemo-white-button">Reset</button>
                        </div>
                    </form>
                </div>

                <footer class="text-right">
                    <p>&copy; 2024 KARE-PMS | Developed By <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a></p>
                </footer>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>

</html>
