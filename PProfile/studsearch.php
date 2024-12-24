<!-- 
<!DOCTYPE html>
<html>

<head>
</head>

<body>
	<h2>Search By</h2>
	<center>
		<form action="COUNT3s1.php" method="POST">
			Student Name :
			<input type="text" name="sname">
			<button type="submit" name="s1">Search</button>
			<br><br>
		</form>
		<form action="COUNT3s2.php" method="POST">
			Student USN : &nbsp
			<input type="text" name="susn">
			<button type="submit" name="s2">Search</button>
			<br><br>
		</form>
		<form action="COUNT3s3.php" method="POST">
			Semister Wise :
			<input type="text" name="csem">
			<button type="submit" name="s3">Search</button>
			<br><br>
		</form>
		<form action="COUNT3s4.php" method="POST">
			Branch : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" name="cbranch">
			<button type="submit" name="s4">Search</button>
			<br><br>
		</form>
		<form action="COUNT3s5.php" method="POST">
			SSLC : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" name="csslc">
			<button type="submit" name="s5">search</button>
			<br><br>
		</form>
		<form action="COUNT3s6.php" method="POST">
			PU/Diploma : &nbsp
			<input type="text" name="cpu">
			<button type="submit" name="s6">search</button>
			<br><br>
		</form>
		<form action="COUNT3s7.php" method="POST">
			BE Aggregate :
			<input type="text" name="cbe">
			<button type="submit" name="s7">search</button>
			<br><br>
		</form>
	</center>
	<footer class="text-right">
		<p>Copyright &copy; 2024 KARE-PMS | Developed by
			<a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a>
	</footer>
	</div>
	</div>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> 
	<script type="text/javascript" src="js/templatemo-script.js"></script>
	<script>
		$(document).ready(function() {
			var imageUrl = $('img.content-bg-img').attr('src');
			$('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
			$('img.content-bg-img').hide();
		});
	</script>
</body>

</html> -->
<?php
session_start();
if (isset($_SESSION['pusername'])) {
} else {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="favicon.png" type="image/icon">
    <link rel="icon" href="favicon.png" type="image/icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Students</title>

    <!-- Add some basic styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            color: #0056b3;
            margin-top: 50px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 30px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 15px 0;
            width: 400px;
            text-align: center;
        }

        form input[type="text"] {
            width: 80%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        form button {
            background-color: #0056b3;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #004494;
        }

        footer {
            text-align: right;
            margin-top: 50px;
            font-size: 14px;
            color: #777;
        }

        footer a {
            color: #0056b3;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .form-title {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            form {
                width: 100%;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>Search By</h2>
        <form action="COUNT3s1.php" method="POST">
            <div class="form-title">Student Name :</div>
            <input type="text" name="sname" placeholder="Enter student name">
            <button type="submit" name="s1">Search</button>
        </form>

        <form action="COUNT3s2.php" method="POST">
            <div class="form-title">Student USN :</div>
            <input type="text" name="susn" placeholder="Enter student USN">
            <button type="submit" name="s2">Search</button>
        </form>

        <form action="COUNT3s3.php" method="POST">
            <div class="form-title">Semester Wise :</div>
            <input type="text" name="csem" placeholder="Enter semester">
            <button type="submit" name="s3">Search</button>
        </form>

        <form action="COUNT3s4.php" method="POST">
            <div class="form-title">Branch :</div>
            <input type="text" name="cbranch" placeholder="Enter branch name">
            <button type="submit" name="s4">Search</button>
        </form>

        <form action="COUNT3s5.php" method="POST">
            <div class="form-title">SSLC :</div>
            <input type="text" name="csslc" placeholder="Enter SSLC marks">
            <button type="submit" name="s5">Search</button>
        </form>

        <form action="COUNT3s6.php" method="POST">
            <div class="form-title">PU/Diploma :</div>
            <input type="text" name="cpu" placeholder="Enter PU/Diploma marks">
            <button type="submit" name="s6">Search</button>
        </form>

        <form action="COUNT3s7.php" method="POST">
            <div class="form-title">BE Aggregate :</div>
            <input type="text" name="cbe" placeholder="Enter BE aggregate marks">
            <button type="submit" name="s7">Search</button>
        </form>
    </div>

    <footer class="text-right">
        <p>Copyright &copy; 2024 KARE-PMS | Developed by
            <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a>
        </p>
    </footer>

    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
    <script>
        $(document).ready(function () {
            // Content widget with background image
            var imageUrl = $('img.content-bg-img').attr('src');
            $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
            $('img.content-bg-img').hide();
        });
    </script>
</body>

</html>
