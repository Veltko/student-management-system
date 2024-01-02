<?php

//Start a session
session_start();

//Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$dbname = "students_DB";

// Create connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the user type of the logged in user from the database
    $username = $_SESSION['username'];
    $sql = "SELECT user_type FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Store the user type in a variable
    $user_type = $user['user_type'];
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// If the form was submitted, save the new user to the database
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    try {
        $sql = 'INSERT INTO admin (username, password, email, user_type) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $password, $email, $user_type]);

        // Redirect the user to a new page
        header('Location: manage_users.php');
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Check if the delete button was clicked
if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
    // Get the ID of the user to delete
    $id = $_POST['id'];

    // Check if the user is an admin
    if ($user_type == 'admin') {
        try {
            // Delete the user from the database
            $sql = "DELETE FROM admin WHERE id = $id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            echo "User deleted successfully";
        } catch (PDOException $e) {
            echo "Error deleting user: " . $e->getMessage();
        }
    } else {
        echo "<p>You are not an admin and not authorized to delete this user.</p>";
    }
}

// Fetch all users
$sql = 'SELECT * FROM admin';
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>

  <link rel="icon" href="./assets/img/fav.png">

  <link rel="stylesheet" href="./assets/styles/manage_users.css">

</head>

<body>

  <header>
    <h1>Manage Users</h1>

    <nav id=" navbar">
      <div>
        <ul>
          <div id="welcome-user">
            <li>Welcome, <?php echo $_SESSION['username']; ?></li>
          </div>
          <li id="dashboard"><a href="dashboard.php">Dashboard</a></li>
          <li id="logout"><a href="logout.php">Log Out</a></li>
        </ul>
      </div>
    </nav>

    <div id="hline"></div>
  </header>

  <!-- The form for adding and deleting users -->

  <div class="form-wrapper">
    <form method="post">
      <input type="text" id="input" name="username" placeholder="Username" required>
      <input type="password" id="input" name="password" placeholder="Password" required>
      <input type="email" id="input" name="email" placeholder="Email" required>
      <select name="user_type" id="input">
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
      <input type="submit" id="btn" name="submit" value="Add User" class="add-user-btn"> <input type="reset" id="btn"
        value="Reset">
    </form>
  </div>

  <!-- Display all users -->
  <div id="user-db">
    <div class="table-wrapper">
      <table>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>User Type</th>
          <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo $user['id']; ?></td>
          <td><?php echo $user['username']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td><?php echo $user['user_type']; ?></td>
          <td>
            <form method="post">
              <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
              <?php if ($user_type == 'admin'): ?>
              <input type="submit" id="del-btn" name="action" value="Delete">
              <?php else: ?>
              <button type="button" id="del-btn">Delete</button>
              <?php endif; ?>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <footer>
    <p>&copy; All Rights Reserved 2023</p>
  </footer>

</body>

</html>

<script>
// Get the delete buttons
const deleteButtons = document.querySelectorAll('#del-btn');

// Loop through each delete button
deleteButtons.forEach(button => {
  // Add a click event listener to the button
  button.addEventListener('click', () => {
    // Check if the user is an admin
    if ('<?php echo $user_type; ?>' !== 'admin') {
      alert('You are not an admin and not authorized to delete this user.');
      return;
    }

    // Confirm if the user wants to delete the row
    if (confirm('Are you sure you want to delete this user?')) {
      // Get the form element
      const form = button.parentElement;

      // Submit the form
      form.submit();
    }
  });
});
</script>