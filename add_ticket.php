<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}
$name = $_POST['name'];
$route = $_POST['route'];
$date = $_POST['date'];
$amount = $_POST['amount'];
$method = $_POST['method'];

if (empty($name) || empty($route) || empty($date) ||  empty($amount) || empty($method)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

$conn->begin_transaction();

try {
    $ticketSql = "INSERT INTO ticket (name, route, date) 
                  VALUES (?, ?, ?)";
    $stmt = $conn->prepare($ticketSql);
    $stmt->bind_param('sss', $name, $route, $date);

    if (!$stmt->execute()) {
        throw new Exception('Error inserting ticket data: ' . $stmt->error);
    }

    $paymentSql = "INSERT INTO payments (route, name, amount, method) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($paymentSql);
    $stmt->bind_param('ssds', $route, $name, $amount, $method);

    if (!$stmt->execute()) {
        throw new Exception('Error inserting payment data: ' . $stmt->error);
    }

    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Ticket booked successfully and payment recorded']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
