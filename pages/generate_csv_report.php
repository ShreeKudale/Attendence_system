<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../login.php");
    exit();
}

$teacher_id = $_SESSION['user_id'];

// Fetch classes taught by the teacher
$classes = $conn->query("SELECT * FROM classes WHERE teacher_id='$teacher_id'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $date = $_POST['date'];

    // Get attendance for selected class and date
    $attendance = $conn->query("SELECT u.name AS student_name, a.status 
                                FROM attendance a
                                JOIN users u ON a.student_id = u.id
                                WHERE a.class_id = '$class_id' AND a.date = '$date'");

    // Output CSV to browser
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="attendance_report.csv"');
    $output = fopen('php://output', 'w');

    // Add CSV headers
    fputcsv($output, array('Student Name', 'Status'));

    // Add attendance data to CSV
    while ($row = $attendance->fetch_assoc()) {
        fputcsv($output, array($row['student_name'], $row['status']));
    }

    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate CSV Report</title>
</head>
<body>
    <h2>Generate Attendance CSV Report</h2>
    <form method="POST">
        <label>Select Class:</label>
        <select name="class_id" required>
            <?php while ($row = $classes->fetch_assoc()): ?>
                <option value="<?= $row['id']; ?>"><?= $row['class_name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Select Date:</label>
        <input type="date" name="date" required>

        <button type="submit">Generate Report</button>
    </form>
</body>
</html>
