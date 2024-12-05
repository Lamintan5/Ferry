<?php
header("Content-Type: application/json");
$conn = new mysqli('localhost', 'root', '', 'elite');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}
$sql = "SELECT payid, name, amount, method, time FROM payments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $vehicles = [];
    while ($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $vehicles]);
} else {
    echo json_encode(['success' => true, 'data' => []]); 
}

$conn->close();
?>
