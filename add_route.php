<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    $output = ob_get_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed',
        'debug' => $output,
    ]);
    exit();
}

$name = $_POST['name'] ?? null;
$departure = $_POST['departure'] ?? null;
$destination = $_POST['destination'] ?? null;
$dtime = $_POST['dtime'] ?? null;
$atime = $_POST['atime'] ?? null;
$price = $_POST['price'] ?? null;

if (!$name || !$departure || !$destination || !$dtime || !$atime || !$price) {
    $output = ob_get_clean();
    echo json_encode([
        'success' => false,
        'message' => 'All fields are required',
        'debug' => $output,
    ]);
    exit();
}

$image = $_FILES['image'] ?? null;
if ($image && $image['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($image['name']);
    if (!move_uploaded_file($image['tmp_name'], $filePath)) {
        $output = ob_get_clean();
        echo json_encode([
            'success' => false,
            'message' => 'File upload failed',
            'debug' => $output,
        ]);
        exit();
    }
} else {
    $output = ob_get_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Image upload is required',
        'debug' => $output,
    ]);
    exit();
}

try {
    $sql = "INSERT INTO routes (name, departure, destination, dtime, atime, price, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $name, $departure, $destination, $dtime, $atime, $price, $filePath);

    if (!$stmt->execute()) {
        throw new Exception('Database insert failed: ' . $stmt->error);
    }

    $conn->close();
    $output = ob_get_clean();
    echo json_encode([
        'success' => true,
        'message' => 'Route added successfully',
        'debug' => $output,
    ]);
} catch (Exception $e) {
    $conn->close();
    $output = ob_get_clean();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'debug' => $output,
    ]);
}
