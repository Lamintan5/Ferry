<?php
session_start(); 

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$email = $data['email'];
$type = $data['type'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$conn = new mysqli('localhost', 'root', '', 'ferry');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$sql = "SELECT email FROM users WHERE BINARY email = '".$email."'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
  
if($count == 1) {
    echo json_encode(['success' => false, 'message' => 'Email already exists. Please try a different email address.']);
} else {
    $insert = "INSERT INTO users (name, email, password, type) VALUES ('$name', '$email', '$password', '$type')";
    $query = mysqli_query($conn,$insert);
    
    if($query) {
        $userId = mysqli_insert_id($conn); 
        
        $_SESSION['user'] = [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'type' => $type
        ];
        
        echo json_encode(['success' => true, 'message' => 'Registration successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
}

$conn->close();
?>
