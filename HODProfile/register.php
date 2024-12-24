<!DOCTYPE html>
<html lang="en">

<head>
	<!--favicon-->
	<link rel="shortcut icon" href="favicon.png" type="image/icon">
	<link rel="icon" href="favicon.png" type="image/icon">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HOD Register</title>
	<meta name="description" content="">
	<meta name="author" content="templatemo">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/templatemo-style.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../Homepage/css/style.css">
</head>

<body class="light-gray-bg">

	<div class="templatemo-content-widget templatemo-login-widget white-bg">
		<header class="text-center">
			<div class="square"></div>
			<h1>HOD Register</h1>
		</header>
		<form method="POST" class="templatemo-login-form" action="reg.php">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
					<input type="text" name="Fullname" class="form-control" placeholder="Full Name*" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
					<input type="text" name="Username" class="form-control" placeholder="Username*" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-university fa-fw"></i></div>
					<select class="form-control" name="Branch">
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
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
					<input type="password" name="Password" class="form-control" placeholder="Password*" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
					<input type="password" name="repassword" class="form-control" placeholder="Retype Password" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
					<input type="email" name="Email" class="form-control" placeholder="Email*" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-question fa-fw"></i></div>
					<select name="Question" class="form-control" required>
						<option value="">Select Security Question*</option>
						<option value="What is your nickname?">What is your nickname?</option>
						<option value="What is your fav spot?">What is your fav spot?</option>
						<option value="What is your fav dish?">What is your fav dish?</option>
						<option value="What is your dream land address?">What is your dream land address?</option>
						<option value="What is your first mobile number?">What is your first mobile number?</option>
						<option value="What is your one truth which others don’t know?">What is your one truth which others don’t know?</option>
						<option value="What is your detained years in life?">What is your detained years in life?</option>
						<option value="What is your enemy name?">What is your enemy name?</option>
						<option value="What is your pet name?">What is your pet name?</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></div>
					<input type="text" name="Answer" class="form-control" placeholder="Answer*" required>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="templatemo-blue-button width-100">Register</button>
			</div>
		</form>
	</div>

	<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
		<p>Have an Account? <strong><a href="index.php" class="blue-text">Sign in here!</a></strong></p>
	</div>

	<!--footer-->
	<div class="footer">
		<div class="container">
			<div class="col-md-3 ftr_navi ftr">
				<h3>NAVIGATION</h3>
				<ul>
					<li><a href="../../Homepage/index.php">Home</a></li>
					<li><a href="../SProfile/index.php">Student Login</a></li>
					<li><a href="../PProfile/index.php">Placement Login</a></li>
					<li><a href="../HODProfile/index.php">HOD Login</a></li>
					<li><a href="../PriProfile/index.php">Administrative Login</a></li>
				</ul>
			</div>
			<div class="col-md-3 ftr_navi ftr">
				<h3>MEMBERS</h3>
				<ul>
					<li><a href="#">Customer Support</a></li>
					<li><a href="#">Placement Support</a></li>
					<li><a href="#">Faculty Support</a></li>
					<li><a href="#">Registered Companies</a></li>
					<li><a href="#">Training</a></li>
				</ul>
			</div>
			<div class="col-md-3 get_in_touch ftr">
				<h3>GET IN TOUCH</h3>
				<p>Kalasalingam Academy of Research and Education</p>
				<p>Virudhunagar, Tamilnadu, India</p>
				<a href="mailto:muthuvijayan1606@gmail.com">muthuvijayan1606@gmail.com</a>
			</div>
			<div class="col-md-3 ftr-logo">
				<p>Copyright &copy; 2024 KARE-PMS | Developed by <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a></p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</body>

</html>
