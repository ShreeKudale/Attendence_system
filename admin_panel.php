<?php
session_start();
include 'includes/db.php';

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirect non-admins to login page
    exit();
}

// Fetch pending users
$query = "SELECT * FROM users WHERE approval_status = 'pending'";
$result = $conn->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    // Approve the user
    $user_id = $_POST['user_id'];
    $conn->query("UPDATE users SET approval_status = 'approved' WHERE id = $user_id");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reject'])) {
    // Reject the user
    $user_id = $_POST['user_id'];
    $conn->query("UPDATE users SET approval_status = 'rejected' WHERE id = $user_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Approve Users</title>
</head>
<body>
    <h2>Admin Panel: Approve or Reject Users</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <form method="POST">
                            <button type="submit" name="approve" value="approve">Approve</button>
                            <button type="submit" name="reject" value="reject">Reject</button>
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
