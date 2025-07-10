<?php
session_start();
include '../includes/db.php';

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}

// Handle Add Class
if (isset($_POST['add_class'])) {
    $class_name = trim($_POST['class_name']);
    $teacher_id = $_SESSION['user_id'];

    if (!empty($class_name)) {
        $sql = "INSERT INTO classes (class_name, teacher_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $class_name, $teacher_id);
        if ($stmt->execute()) {
            $message = "Class added successfully!";
        } else {
            $message = "Error adding class.";
        }
        $stmt->close();
    } else {
        $message = "Class name cannot be empty!";
    }
}

// Handle Delete Class
if (isset($_GET['delete'])) {
    $class_id = intval($_GET['delete']);
    $sql = "DELETE FROM classes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    if ($stmt->execute()) {
        $message = "Class deleted successfully!";
    } else {
        $message = "Error deleting class.";
    }
    $stmt->close();
}

// Fetch Classes for This Teacher
$teacher_id = $_SESSION['user_id'];
$sql = "SELECT * FROM classes WHERE teacher_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$classes = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="/assets/css/style2.css">
</head>
<body>
    <header>
        <h1>Manage Classes</h1>
        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2>Add New Class</h2>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        <form method="POST">
            <input type="text" name="class_name" placeholder="Enter Class Name" required>
            <button type="submit" name="add_class">Add Class</button>
        </form>

        <h2>Existing Classes</h2>
        <table border="1">
            <tr>
                <th>Class Name</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?php echo htmlspecialchars($class['class_name']); ?></td>
                    <td>
                        <a href="edit_class.php?id=<?php echo $class['id']; ?>">Edit</a> | 
                        <a href="manage_classes.php?delete=<?php echo $class['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
