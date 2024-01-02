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
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

// Get the student ID from the URL
$id = $_GET['id'];

// Get the student data from the database
try {
    $sql = 'SELECT * FROM students WHERE stu_enrollment_number = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $student_data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// If the form was submitted, update the student data in the database
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $enrollment_number = $_POST['enrollment_number'];
    $attendance = $_POST['attendance'];
    $marks_status = $_POST['marks_status'];
    $fee_status = $_POST['fee_status'];

    try {
        $sql = 'UPDATE students SET stu_name = ?, stu_attendance = ?, stu_marks_status = ?, stu_fee_status = ? WHERE stu_enrollment_number = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $attendance, $marks_status, $fee_status, $enrollment_number]);
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
  <title>Edit Student</title>

  <link rel="icon" href="./assets/img/fav.png">

  <link rel="stylesheet" href="./assets/styles/edit_student.css">

</head>

<body>

  <header>
    <h1>Student Management System</h1>
  </header>

  <main>
    <div id=" status-bar">
    </div>
    <div id="edit-student-form">
      <h2>Edit Student</h2>
      <form action="edit_student.php?id=<?php echo $id; ?>" method="post">

        <div class="input-row">
          <div class="input-label">Enrollment No.</div>
          <input type="text" name="enrollment_number" value="<?php echo $student_data['stu_enrollment_number']; ?>">
        </div>
        <div class="input-row">
          <div class="input-label">Name</div>
          <input type="text" name="name" value="<?php echo $student_data['stu_name']; ?>">
        </div>
        <div class="input-row">
          <div class="input-label">Marks</div>
          <input type="text" name="marks_status" value="<?php echo $student_data['stu_marks_status']; ?>">
        </div>
        <div class="input-row">
          <div class="input-label">Attendance</div>
          <input type="text" name="attendance" value="<?php echo $student_data['stu_attendance']; ?>">
        </div>
        <div class="input-row">
          <div class="input-label">Fee Status</div>
          <select name="fee_status" id="fee-status">
            <option value="paid" <?php if ($student_data['stu_fee_status'] == 'Paid') echo 'selected'; ?>>Paid</option>
            <option value="not paid" <?php if ($student_data['stu_fee_status'] == 'Not Paid') echo 'selected'; ?>>Not
              Paid
            </option>
          </select>
        </div>
        <button type="submit" name="submit">Update Student</button>
        <button type="button" onclick="window.location.href='dashboard.php'">Cancel</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; All Rights Reserved 2023</p>
  </footer>

</body>

</html>