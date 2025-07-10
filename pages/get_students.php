<?php
include '../includes/db.php';

if (isset($_GET['class_id'])) {
    $class_id = intval($_GET['class_id']);

    // Query to fetch students for the selected class
    $sql = "SELECT s.id, s.name FROM students s
            JOIN class_students cs ON s.id = cs.student_id
            WHERE cs.class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    echo json_encode(['students' => $students]);

    $stmt->close();
    $conn->close();
}
?>
