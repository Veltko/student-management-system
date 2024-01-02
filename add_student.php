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

// If the form was submitted, save the new student to the database
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $enrollment_number = $_POST['enrollment_number'];
    $attendance = $_POST['attendance'];
    $marks_status = $_POST['marks_status'];
    $fee_status = $_POST['fee_status'];

    try {
        $sql = 'INSERT INTO students (stu_name, stu_enrollment_number, stu_attendance, stu_marks_status, stu_fee_status) VALUES (?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $enrollment_number, $attendance, $marks_status, $fee_status]);
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
  <title>Add Users</title>

  <link rel="icon" href="./assets/img/fav.png">

  <link rel="stylesheet" href="./assets/styles/add_student.css">

</head>

<body>

  <header>
    <h1>Add Student</h1>
  </header>

  <main>
    <div id="status-bar"></div>
    <div id="add-student-form">
      <form action="add_student.php" method="post">
        <input type="text" name="enrollment_number" placeholder="Enrollment Number">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="attendance" placeholder="Attendance Status">
        <input type="text" name="marks_status" placeholder="Marks Status">
        <input type="text" name="fee_status" placeholder="Fee Status">

        <button type="submit" name="submit">Add Student</button>
        <button type="button" onclick="window.location.href='dashboard.php'">Cancel</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; All Rights Reserved 2023</p>
  </footer>

</body>

</html>