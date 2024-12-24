<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: index.php");
    exit("You must be logged in to view this page. <a href='index.php'>Click here</a>");
}
?>

<?php
$connect = mysqli_connect("localhost", "root", "", "placement"); // Establishing connection with the database

if (isset($_POST['submit'])) {
    // Sanitizing and storing form data
    $fname = mysqli_real_escape_string($connect, $_POST['Fname']);
    $lname = mysqli_real_escape_string($connect, $_POST['Lname']);
    $USN = mysqli_real_escape_string($connect, $_POST['USN']);
    $sun = $_SESSION["username"]; // The logged-in user's USN
    $phno = mysqli_real_escape_string($connect, $_POST['Num']);
    $email = mysqli_real_escape_string($connect, $_POST['Email']);
    $date = mysqli_real_escape_string($connect, $_POST['DOB']);
    $cursem = mysqli_real_escape_string($connect, $_POST['Cursem']);
    $branch = mysqli_real_escape_string($connect, $_POST['Branch']);
    $per = mysqli_real_escape_string($connect, $_POST['Percentage']);
    $puagg = mysqli_real_escape_string($connect, $_POST['Puagg']);
    $beaggregate = mysqli_real_escape_string($connect, $_POST['Beagg']);
    $back = mysqli_real_escape_string($connect, $_POST['Backlogs']);
    $hisofbk = mysqli_real_escape_string($connect, $_POST['History']);
    $detyear = mysqli_real_escape_string($connect, $_POST['Dety']);

    // Check if USN and Email are not empty
    if ($USN != '' && $email != '') {
        // Ensure that the logged-in user is inserting their own USN
        if ($USN == $sun) {
            // Check if the USN already exists in the database
            $checkQuery = "SELECT * FROM `basicdetails` WHERE `USN` = '$USN'";
            $checkResult = $connect->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                echo "<center>Record already exists for this USN. Please update the details instead.</center>";
            } else {
                // If no record exists, insert the new data
                $insertQuery = "INSERT INTO `basicdetails` (`FirstName`, `LastName`, `USN`, `Mobile`, `Email`, `DOB`, `Sem`, `Branch`, `SSLC`, `PU/Dip`, `BE`, `Backlogs`, `HofBacklogs`, `DetainYears`, `Approve`) 
                                VALUES ('$fname', '$lname', '$USN', '$phno', '$email', '$date', '$cursem', '$branch', '$per', '$puagg', '$beaggregate', '$back', '$hisofbk', '$detyear', '0')";

                if ($connect->query($insertQuery)) {
                    echo "<center>Details have been received successfully!</center>";
                } else {
                    echo "<center>Failed to insert details. Error: " . $connect->error . "</center>";
                }
            }
        } else {
            echo "<center>USN does not match the logged-in user!</center>";
        }
    } else {
        echo "<center>Please enter valid USN and Email!</center>";
    }
}
?>

<?php
// Update section: when the form is submitted with "update"
if (isset($_POST['update'])) {
    // Sanitizing and storing form data
    $fname = mysqli_real_escape_string($connect, $_POST['Fname']);
    $lname = mysqli_real_escape_string($connect, $_POST['Lname']);
    $USN = mysqli_real_escape_string($connect, $_POST['USN']);
    $sun = $_SESSION["username"]; // The logged-in user's USN
    $phno = mysqli_real_escape_string($connect, $_POST['Num']);
    $email = mysqli_real_escape_string($connect, $_POST['Email']);
    $date = mysqli_real_escape_string($connect, $_POST['DOB']);
    $cursem = mysqli_real_escape_string($connect, $_POST['Cursem']);
    $branch = mysqli_real_escape_string($connect, $_POST['Branch']);
    $per = mysqli_real_escape_string($connect, $_POST['Percentage']);
    $puagg = mysqli_real_escape_string($connect, $_POST['Puagg']);
    $beaggregate = mysqli_real_escape_string($connect, $_POST['Beagg']);
    $back = mysqli_real_escape_string($connect, $_POST['Backlogs']);
    $hisofbk = mysqli_real_escape_string($connect, $_POST['History']);
    $detyear = mysqli_real_escape_string($connect, $_POST['Dety']);

    // Check if USN and Email are not empty
    if ($USN != '' && $email != '') {
        // Ensure that the logged-in user is updating their own USN
        if ($USN == $sun) {
            // Check if the USN exists in the database
            $checkQuery = "SELECT * FROM `basicdetails` WHERE `USN` = '$USN'";
            $checkResult = $connect->query($checkQuery);

            if ($checkResult->num_rows == 1) {
                // If the USN exists, perform the update
                $updateQuery = "UPDATE `basicdetails` SET `FirstName` = '$fname', `LastName` = '$lname', `Mobile` = '$phno', `Email` = '$email', `DOB` = '$date', `Sem` = '$cursem', 
                                `Branch` = '$branch', `SSLC` = '$per', `PU/Dip` = '$puagg', `BE` = '$beaggregate', `Backlogs` = '$back', `HofBacklogs` = '$hisofbk', `DetainYears` = '$detyear', 
                                `Approve` = '0' WHERE `USN` = '$USN'";

                if ($connect->query($updateQuery)) {
                    echo "<center>Details have been updated successfully!</center>";
                } else {
                    echo "<center>Failed to update details. Error: " . $connect->error . "</center>";
                }
            } else {
                echo "<center>No record found for the provided USN.</center>";
            }
        } else {
            echo "<center>USN does not match the logged-in user!</center>";
        }
    } else {
        echo "<center>Please enter valid USN and Email!</center>";
    }
}
?>
