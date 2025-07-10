<?php
session_start();
include '../includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch user's role
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

if ($user_role == 'teacher') {
    $sql = "SELECT a.id, u.name AS student_name, c.class_name, a.date, a.status 
            FROM attendance a 
            JOIN users u ON a.student_id = u.id 
            JOIN classes c ON a.class_id = c.id 
            WHERE c.teacher_id = '$user_id'";
} else {
    $sql = "SELECT a.id, c.class_name, a.date, a.status 
            FROM attendance a 
            JOIN classes c ON a.class_id = c.id 
            WHERE a.student_id = '$user_id'";
}

$attendance = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Attendance</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h2>Attendance Records</h2>
    <table border="1">
        <tr>
            <th>Class Name</th>
            <?php if ($user_role == 'teacher') echo "<th>Student Name</th>"; ?>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $attendance->fetch_assoc()): ?>
            <tr>
                <td><?= $row['class_name']; ?></td>
                <?php if ($user_role == 'teacher') echo "<td>{$row['student_name']}</td>"; ?>
                <td><?= $row['date']; ?></td>
                <td><?= $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
