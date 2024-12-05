<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$sql = "SELECT * FROM routes";
$result = $conn->query($sql);



$vehicles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
}

echo json_encode($vehicles);
$conn->close();
?>
