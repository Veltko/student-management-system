<?php

// Start a session
session_start();

// Check if the user is logged in
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
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Get the student ID from the URL
$id = $_GET['id'];

// If the user confirmed that they want to delete the student, delete the student record from the database
if (isset($_POST['submit'])) {
    try {
        $sql = 'DELETE FROM students WHERE stu_enrollment_number = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Redirect to the dashboard page
    header('Location: dashboard.php');
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Delete Record?</title>

  <link rel="icon" href="./assets/img/fav.png">

  <link rel="stylesheet" href="./assets/styles/delete_student.css">

</head>

<body>

  <header>
    <h1>Student Management System</h1>
  </header>

  <main>
    <div id=" status-bar">
    </div>
    <div id="delete-student-confirmation">
      <h2>Are you sure you want to delete this student?</h2>
      <form action="delete_student.php?id=<?php echo $id; ?>" method="post">
        <button type="submit" name="submit">Yes</button>
        <button type="button" onclick="redirectToDashboard()">No</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; All Rights Reserved 2023</p>
  </footer>

</body>

</html>

<script>
function redirectToDashboard() {
  window.location.href = "dashboard.php";
}
</script>