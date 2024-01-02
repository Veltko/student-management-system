<?php

// Start a session
session_start();

// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$dbname = "students_DB";

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

// Initialize the $status variable to "Enter your credentials"
$status = "Enter your credentials";

// Check if the form has been submitted
if (!empty($_POST)) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a statement to select the user from the database
    $sql = 'SELECT * FROM admin WHERE username = ?';
    $stmt = $conn->prepare($sql);

    // Bind the user's username to the statement parameter
    $stmt->bindParam(1, $username);

    // Execute the statement
    $stmt->execute();

    // Get the user data from the statement result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the password
    if ($user && $password == $user['password']) {
        // If the password is correct, log the user in
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit; // Make sure to exit here to prevent the rest of the script from executing
    } else {
        // If the password is incorrect, set the $status variable to "Invalid login credentials"
        $status = "Invalid login credentials.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Student Management System</title>

  <link rel="icon" href="./assets/img/fav.png">

  <link rel="stylesheet" href="./assets/styles/index.css">

</head>

<body>

  <header>
    <h1>Student Management System</h1>
  </header>

  <main>
    <div id="login-form">
      <div id="h2">
        <h2>Login</h2>
      </div>
      <form action="index.php" method="post">
        <?php 
                // Display the $status variable inside the login-form div
                echo '<div id="login-status">' . $status . '</div>';
            ?>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
        <button type="button" name="change-password" id="change-pass"
          onclick="window.location.href='change_password.php'">Forgot Password</button>
        <button type="reset">Cancel</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; All Rights Reserved 2023</p>
  </footer>

</body>

</html>

<script>
// Add an event listener to the reset button
document.querySelector('button[type="reset"]').
addEventListener('click', function() {
  // Clear the login status and password
  document.getElementById('login-status').
  textContent = 'Enter your credentials';
});
</script>