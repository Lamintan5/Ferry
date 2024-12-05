<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$ferryId = $_GET['id'];
$sql = "SELECT * FROM routes WHERE rid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $ferryId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $ferry = $result->fetch_assoc();
    echo json_encode($ferry);
} else {
    echo json_encode(['error' => 'ferry not found']);
}

$stmt->close();
$conn->close();
?>
