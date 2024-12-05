<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'] ?? '';
    $departure = $_POST['departure'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $dtime = $_POST['dtime'] ?? '';
    $atime = $_POST['atime'] ?? '';
    $price = $_POST['price'] ?? '';
    $errors = [];

    if (empty($name)) $errors[] = 'name';
    if (empty($departure)) $errors[] = 'departure';
    if (empty($destination)) $errors[] = 'destination';
    if (empty($dtime)) $errors[] = 'dtime';
    if (empty($atime)) $errors[] = 'atime';
    if (empty($price)) $errors[] = 'price';

    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => 'Missing fields: ' . implode(', ', $errors)
        ]);
        exit();
    }

    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . basename($image['name']);
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
            exit();
        }
    }

    $sql = "UPDATE routes SET 
            name = ?, 
            departure = ?, 
            destination = ?, 
            dtime = ?, 
            atime = ?, 
            price = ?";
    
    if ($imagePath) {
        $sql .= ", image = ?";
    }

    $sql .= " WHERE rid = ?";

    $stmt = $conn->prepare($sql);
    if ($imagePath) {
        $stmt->bind_param('sssssisi', $name, $departure, $destination, $dtime, $atime, $price, $imagePath, $id);
    } else {
        $stmt->bind_param('sssssis', $name, $departure, $destination, $dtime, $atime, $price, $id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Route updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating route: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>
