<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

if (isset($_POST['rid'])) {
    $rid = intval($_POST['rid']);
    $sql = "DELETE FROM routes WHERE rid = $rid";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Routes deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting routes: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>
