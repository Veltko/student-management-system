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

//Setting the start from, value. (Pagination)
$start = 0;

//Setting the number of rows to display in a page. (Pagination)
$rows_per_page = 8;

// Get total number of rows (Pagination)
$records = $conn->query("SELECT * FROM students");
$total_rows = $records->rowCount();

//Calculate the total number of pages required (Pagination)
$pages = ceil($total_rows / $rows_per_page);

//check if the user clicks on the pagination buttons we set a new starting point.
if (isset($_GET['page-no']) && $_GET['page-no'] > 0) {
    $page = $_GET['page-no'] - 1;
    $start = $page * $rows_per_page;
}

// Get all students from the database
$sql = "SELECT * FROM students LIMIT $start, $rows_per_page";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Student Dashboard</title>

  <link rel="icon" href="./assets/img/fav.png">

  <link rel="stylesheet" href="./assets/styles/dashboard.css">
</head>

<?php
//This is checking if the `page-no` parameter is set in the URL.
    if(isset($_GET['page-no'])) {
        $id = $_GET['page-no'];
    } else {
        $id = 1;
    }
?>

<body id=" <?php echo $id ?>">

  <header>
    <h1>Student Dashboard</h1>

    <nav>
      <ul id="navbar">
        <div id="welcome-user">
          <li>Welcome, <?php echo $_SESSION['username']; ?></li>
        </div>
        <li id="manage-users"><a href="manage_users.php">Manage Users</a></li>
        <li id="logout"><a href="logout.php">Log Out</a></li>
        <div id="add-record-button">
          <li><a href="add_student.php">Add Record</a></li>
        </div>
      </ul>
    </nav>

    <div id="hline"></div>
  </header>

  <main>
    <div id="student-database">
      <div class="table-wrapper">

        <table class="student-table">

          <thead>
            <tr>
              <th>Enrollment Number</th>
              <th>Name</th>
              <th>Marks</th>
              <th>Attendance</th>
              <th>Fee</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
              <td><?php echo $student['stu_enrollment_number']; ?></td>
              <td><?php echo $student['stu_name']; ?></td>
              <td><?php echo $student['stu_marks_status']; ?></td>
              <td><?php echo $student['stu_attendance']; ?></td>
              <td><?php echo $student['stu_fee_status']; ?></td>

              <td><a id="edit-button" onclick="editStudent(<?php echo $student['stu_enrollment_number']; ?>)">Edit</a>
              </td>
              <td><a id="delete-button"
                  href="delete_student.php?id=<?php echo $student['stu_enrollment_number']; ?>">Delete</a></td>
            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

      <!-- Pagination -->

      <div class="page-info">
        <?php
            if(!isset($_GET['page-no'])) {
                $page = 1;
            } else {
                $page = $_GET['page-no'];
            }
        ?>

        Showing <?php echo $page ?> of <?php echo $pages ?> pages
      </div>

      <!-- Displaying the pagination buttons -->
      <div class="pagination">

        <!-- Go to the first page -->
        <a href="?page-no=1">First</a>

        <!-- Go to the previous page -->
        <?php
            if (isset($_GET['page-no']) && $_GET['page-no'] > 1) {
        ?>
        <a href="?page-no=<?php echo $_GET['page-no'] - 1 ?>">Previous</a>
        <?php
        } else {
            ?>
        <a>Previous</a>
        <?php
        }
        ?>

        <!-- Displaying the page numbers -->
        <div class="page-numbers">
          <?php
            for ($counter = 1; $counter <= $pages; $counter++) { 
                ?>
          <a href="?page-no=<?php echo $counter ?>"><?php echo $counter ?></a>
          <?php
            }
        ?>
        </div>

        <!-- Go to the next page -->
        <?php
            if (isset($_GET['page-no'])) {
                ?>
        <a href="?page-no=<?php echo $_GET['page-no'] + 1 ?>">Next</a>
        <?php 
            } else {
                if($_GET['page-no'] >= $pages) {
                    ?>
        <a>Next</a>
        <?php
                } else {
                    ?>
        <a href="?page-no=<?php echo $_GET['page-no'] + 1 ?>">Next</a>
        <?php
                }
            }
        ?>

        <!-- Go to the last page -->
        <a href="?page-no=<?php echo $pages ?>">Last</a>

      </div> <!-- pagination div close -->
    </div>
  </main>

  <footer>
    <p>&copy; All Rights Reserved 2023</p>
  </footer>

</body>

</html>

<script>
// Function to redirect to the edit_student.php page using GET
function editStudent(enrollmentNumber) {
  window.location = "edit_student.php?id=" + enrollmentNumber;
}

// Setting the active page
let links = document.querySelectorAll('.page-numbers > a');
let bodyId = parseInt(document.body.id) - 1;
links[bodyId].classList.add('active');
</script>