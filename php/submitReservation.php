<?php
$conn = mysqli_connect("localhost", "root", "", "throughtheages");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$reservationMessage = "";
$reservationClass = "";

if (isset($_POST['reservation_submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $people = mysqli_real_escape_string($conn, $_POST['people']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $messageInput = mysqli_real_escape_string($conn, $_POST['message']); 

    if (empty($name) || empty($phone) || empty($people) || empty($date) || empty($time)) {
        $reservationMessage = "All fields except message are required.";
        $reservationClass = "error";
    } else {
        $sql = "INSERT INTO reservations (name, phone, people, date, time, message) 
                  VALUES ('$name', '$phone', '$people', '$date', '$time', '$messageInput')";
        if (mysqli_query($conn, $sql)) {
            $reservationMessage = "Reservation successfully submitted!";
            $reservationClass = "success";
        } else {
            $reservationMessage = "Failed to submit reservation. Please try again.";
            $reservationClass = "error";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>