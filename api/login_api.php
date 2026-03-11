<?php
header('Content-Type: application/json');
session_start();
include '../db.php'; 

// Validate JSON input
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Username and password are required.'
    ]);
    exit();
}

// Sanitize inputs
$username = filter_var($data['username'], FILTER_SANITIZE_STRING);
$password = $data['password'];

// Query database for user credential
$stmt = $conn->prepare("SELECT password FROM login WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        session_regenerate_id(true); 
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time(); 

        echo json_encode([
            'success' => true,
            'message' => 'Login successful.',
            'redirect' => 'dashboard.php'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid username or password.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid username or password.'
    ]);
}

$stmt->close();
$conn->close();
?>