<?php
session_start();

$connect = mysqli_connect("localhost", "root", "", "placement"); // Establishing Connection with Server
   // mysql_select_db("placement") or die("Cant Connect to database"); // Selecting Database from Server

  $USN = $_POST['USN'];
  $Question = $_POST['Question'];
  $Answer = $_POST['Answer'];
  $check = $connect->query("SELECT * FROM slogin WHERE USN='".$USN."'") or die("Check Query");
 if($check->num_rows!= 0)
 {
	 $row = $check->fetch_assoc();
	 $dbQuestion = $row['Question'];
	 $dbAnswer = $row['Answer'];
  if($dbQuestion == $Question && $dbAnswer==$Answer)
  {
     $_SESSION['reset'] = $USN;
	   header("location: Reset password.php");

  }
  else
	  echo "<center>Failed! Incorrect Credentials</center>";
 } else
 echo "<center> Enter Something Correctly Champ!!! </center>";

   
?>
