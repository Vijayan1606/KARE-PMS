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
    <title>Company Name Entry</title>

    <!-- Custom Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group button {
            width: 48%;
            padding: 12px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .templatemo-blue-button {
            background-color: #0056b3;
            color: white;
            border: none;
        }

        .templatemo-blue-button:hover {
            background-color: #004494;
        }

        .templatemo-white-button {
            background-color: #f1f1f1;
            color: #333;
            border: 1px solid #ccc;
        }

        .templatemo-white-button:hover {
            background-color: #e0e0e0;
        }

        footer {
            text-align: center;
            margin-top: 40px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            .form-group button {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>Enter Company Name</h2>

        <form action="COUNT2.php" class="templatemo-login-form" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="cname">Company Name</label>
                <input type="text" name="cname" class="form-control" id="cname" placeholder="Enter the company name">
            </div>

            <div class="form-group text-right">
                <button type="submit" name="submit" class="templatemo-blue-button">Submit</button>
                <button type="reset" class="templatemo-white-button">Reset</button>
            </div>

        </form>

        <footer>
            <p>Copyright &copy; 2024 KARE-PMS | Developed by
                <a href="https://personal-portfolio-4i59.vercel.app/" target="_parent">Vijay</a>
            </p>
        </footer>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
    <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
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
