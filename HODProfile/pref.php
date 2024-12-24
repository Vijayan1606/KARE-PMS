<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['husername'])) {
    header("location: index.php");
    die("You must be logged in to view this page.");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'placement');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data with sanitization
    $firstName = htmlspecialchars($_POST['FirstName']);
    $lastName = htmlspecialchars($_POST['LastName']);
    $username = htmlspecialchars($_POST['Username']);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $note = htmlspecialchars($_POST['Note']);

    // File upload logic
    $fileName = '';
    if ($_FILES['fileToUpload']['name']) {
        $targetDir = "uploads/"; // Ensure this directory exists and is writable
        $targetFile = $targetDir . basename($_FILES['fileToUpload']['name']);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Debug: Check if the file has been uploaded successfully
        if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
            echo "File uploaded successfully to: " . $_FILES['fileToUpload']['tmp_name'];
        } else {
            die("Error: " . $_FILES['fileToUpload']['error']);
        }

        // Check file size (5MB max)
        if ($_FILES['fileToUpload']['size'] > 5000000) {
            die("File is too large. Maximum size is 5MB.");
        }

        // Check file type (JPG, PNG, JPEG)
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileType, $allowedTypes)) {
            die("Only JPG, PNG, and JPEG files are allowed.");
        }

        // Check if directory exists and is writable
        if (!is_dir($targetDir)) {
            die("Target directory does not exist.");
        }
        if (!is_writable($targetDir)) {
            die("Target directory is not writable.");
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            $fileName = basename($_FILES['fileToUpload']['name']);
        } else {
            die("There was an error uploading the file.");
        }
    }

    // Prepare SQL statement
    $sql = "UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, note = ?, profile_pic = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters and execute
    if ($stmt) {
        $stmt->bind_param("sssssss", $firstName, $lastName, $username, $email, $note, $fileName, $_SESSION['husername']);
        
        // Execute the update and check for success
        if ($stmt->execute()) {
            echo "<script>alert('Preferences updated successfully'); window.location.href = 'preferences.php';</script>";
        } else {
            echo "<script>alert('Error updating preferences');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Database error: unable to prepare SQL statement.');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>
