<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "throughtheages");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: admin_dashboard.php"); // redirect after login
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Admin not found!";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="stylecss/style1.css">
</head>
<body>
  <div class="login-container">
    <div class="login-image"></div>
    <form class="login-form" action="" method="POST">
      <h1>Through The Ages</h1>
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="login">Login</button>
      <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
  </div>
</body>
</html>
