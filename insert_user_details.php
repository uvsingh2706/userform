<?php
// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// Check if the file is uploaded successfully
if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
  $pdf_name = $_FILES['pdf']['name'];
  $pdf_tmp_name = $_FILES['pdf']['tmp_name'];

  // Specify the target directory to save the uploaded PDF file
  $upload_directory = 'pdf_files/';
  $pdf_path = $upload_directory . $pdf_name;

  // Move the uploaded file to the target directory
  if (move_uploaded_file($pdf_tmp_name, $pdf_path)) {
    // Connect to MySQL database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'userinfo';

    $conn = new mysqli($host, $username, $password, $db_name);
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    // Insert user details and PDF file path into the database
    $sql = "INSERT INTO user_details (name, age, weight, email, pdf_path) VALUES ('$name', '$age', '$weight', '$email', '$pdf_path')";
    if ($conn->query($sql) === TRUE) {
      echo 'User details and PDF file inserted successfully.';
    } else {
      echo 'Error: ' . $conn->error;
    }

    $conn->close();
  } else {
    echo 'Failed to move the uploaded file.';
  }
} else {
  // File upload error
  die('PDF upload failed.');
}
?>
