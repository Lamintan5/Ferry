<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

if (isset($_GET['id'])) {
    $rid = intval($_GET['id']);
    $sql = "SELECT rid, name, departure, destination, dtime, atime, price, image FROM routes WHERE rid = $rid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $route = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $route]);
    } else {
        echo json_encode(['success' => false, 'message' => `route not found $rid`]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>
