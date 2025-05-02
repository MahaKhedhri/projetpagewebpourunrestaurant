<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "throughtheages");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$contactMessage = "";
$contactClass = "";

// Contact Form Handling
if (isset($_POST['contact_submit'])) {
  $contactName = mysqli_real_escape_string($conn, $_POST['contact_name']);
  $contactEmail = mysqli_real_escape_string($conn, $_POST['contact_email']);
  $contactMessageInput = mysqli_real_escape_string($conn, $_POST['contact_message']);

  if (empty($contactName) || empty($contactEmail) || empty($contactMessageInput)) {
    $contactMessage = "All fields are required.";
    $contactClass = "error";
  } else {
    $sql = "INSERT INTO contact (name, email, message) 
              VALUES ('$contactName', '$contactEmail', '$contactMessageInput')";
    if (mysqli_query($conn, $sql)) {
      $contactMessage = "Message sent successfully!";
      $contactClass = "success";
    } else {
      $contactMessage = "Failed to send your message. Please try again.";
      $contactClass = "error";
    }
  }
}

mysqli_close($conn);
?>