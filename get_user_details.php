<?php
$email = $_GET['email'];

// Connect to MySQL database
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'userinfo';

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Fetch the PDF file path based on email ID
$sql = "SELECT pdf_path FROM user_details WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $pdf_path = $row['pdf_path'];

  // Send the PDF file as a response
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . basename($pdf_path) . '"');
  header('Content-Length: ' . filesize($pdf_path));
  readfile($pdf_path);
} else {
  echo 'No health report found for the given email ID.';
}

$conn->close();
?>
