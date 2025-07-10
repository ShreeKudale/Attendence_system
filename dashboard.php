<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Attendance System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Attendance Management System</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2>Welcome, <?php echo ucfirst($user_role); ?>!</h2>
        <p>Select an option below:</p>
        
        <div class="dashboard-links">
            <?php if ($user_role == 'teacher'): ?>
                <a href="pages/manage_classes.php" class="button">Manage Classes</a>
                <a href="pages/mark_attendance.php" class="button">Mark Attendance</a>
                <a href="pages/generate_csv_report.php" class="button">Generate CSV Report</a>
            <?php elseif ($user_role == 'student'): ?>
                <a href="pages/view_attendance.php" class="button">View Attendance</a>
            <?php endif; ?>
        </div>
        
        <br><br>
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
