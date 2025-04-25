<?php
$conn = mysqli_connect("localhost","root","","throughtheages");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $people = mysqli_real_escape_string($conn, $_POST['people']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $message = mysqli_real_escape_string($conn, $_POST['message']); // Optional

  
    if (empty($name) || empty($phone) || empty($people) || empty($date) || empty($time)) {
        echo "All fields except message are required.";
    } else {
        $sql = "INSERT INTO reservations (name, phone, people, date, time, message) 
                VALUES ('$name', '$phone', '$people', '$date', '$time', '$message')";
        if (mysqli_query($conn, $sql)) {
            echo "Reservation successfully submitted!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>