<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

// Ensure only teachers can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../login.php");
    exit();
}

// Fetch the teacher's classes
$teacher_id = $_SESSION['user_id'];
$classes = $conn->query("SELECT * FROM classes WHERE teacher_id='$teacher_id'");

// Handle attendance submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    $class_id = $_POST['class_id'];
    $date = $_POST['date'];

    if (!empty($_POST['attendance'])) {
        foreach ($_POST['attendance'] as $student_id => $status) {
            $status = htmlspecialchars($status);
            $conn->query("INSERT INTO attendance (student_id, class_id, date, status) 
                          VALUES ('$student_id', '$class_id', '$date', '$status')");
        }
        echo "<p style='color:green;'>Attendance Marked Successfully!</p>";
    } else {
        echo "<p style='color:red;'>Please mark attendance for at least one student!</p>";
    }
}

// Fetch students for the selected class
$students = [];
if (isset($_POST['class_id']) && !empty($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $query = "SELECT * FROM users WHERE role='student' AND id IN 
              (SELECT student_id FROM enrollments WHERE class_id='$class_id')";
    $students = $conn->query($query);

    if (!$students) {
        die("<p style='color:red;'>Error fetching students: " . $conn->error . "</p>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h2>Mark Attendance</h2>

    <!-- Class Selection Form -->
    <form method="POST">
        <label>Select Class:</label>
        <select name="class_id" required onchange="this.form.submit()">
            <option value="">Select a class</option>
            <?php while ($row = $classes->fetch_assoc()): ?>
                <option value="<?= $row['id']; ?>" <?= isset($_POST['class_id']) && $_POST['class_id'] == $row['id'] ? 'selected' : '' ?>>
                    <?= $row['class_name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <!-- Attendance Form -->
    <?php if (isset($_POST['class_id']) && $students->num_rows > 0): ?>
        <form method="POST">
            <input type="hidden" name="class_id" value="<?= $_POST['class_id']; ?>">
            <label>Date:</label>
            <input type="date" name="date" required>
            
            <h3>Students:</h3>
            <table border="1">
                <tr><th>Student Name</th><th>Status</th></tr>
                <?php while ($student = $students->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['name']); ?></td>
                        <td>
                            <select name="attendance[<?= $student['id']; ?>]" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Late">Late</option>
                            </select>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            
            <button type="submit" >Submit Attendance</button>
        </form>
    <?php elseif (isset($_POST['class_id'])): ?>
        <p style="color:red;">No students found in this class.</p>
    <?php endif; ?>
</body>
</html>
