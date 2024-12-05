<?php
session_start(); 

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$password = $data['password'];

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'type' => $user['type'],
        ];
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No user found with this email']);
}

$conn->close();
?>
