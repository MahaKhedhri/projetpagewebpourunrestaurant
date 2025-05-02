<?php
session_start();//on commence une session pour enregistrer les données de l'utilisateur
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "throughtheages");

if ($_SERVER["REQUEST_METHOD"] == "POST") {// check if the form is submitted
  // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);// bind the username parameter to the SQL query
    $stmt->execute();// execute the query
    $result = $stmt->get_result(); // get the result of the query
    if ($result->num_rows == 1) {// useres exists or not
        $user = $result->fetch_assoc();// fetch the user data
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
