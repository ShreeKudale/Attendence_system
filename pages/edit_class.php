<?php
session_start();
include '../includes/db.php';

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}

// Fetch class data if class ID is provided
if (isset($_GET['id'])) {
    $class_id = intval($_GET['id']);

    // Query to fetch class details
    $sql = "SELECT * FROM classes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if class exists
    if ($result->num_rows == 1) {
        $class = $result->fetch_assoc();
    } else {
        // If no class found, redirect back
        header("Location: manage_classes.php");
        exit();
    }
    $stmt->close();
}

// Handle the form submission to update class details
if (isset($_POST['update_class'])) {
    $class_name = trim($_POST['class_name']);

    // Check if class name is not empty
    if (!empty($class_name)) {
        $sql = "UPDATE classes SET class_name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $class_name, $class_id);
        
        if ($stmt->execute()) {
            $message = "Class updated successfully!";
        } else {
            $message = "Error updating class.";
        }
        $stmt->close();
    } else {
        $message = "Class name cannot be empty!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Edit Class</h1>
        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2>Edit Class Details</h2>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        
        <form method="POST">
            <input type="text" name="class_name" value="<?php echo htmlspecialchars($class['class_name']); ?>" required>
            <button type="submit" name="update_class">Update Class</button>
        </form>
        
        <a href="manage_classes.php">Back to Manage Classes</a>
    </div>
</body>
</html>
