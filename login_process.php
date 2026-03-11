<?php
session_start();
include 'db.php'; 

// Get values from the form
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = $_POST['password']; 

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
        header("Location: dashboard.php"); 
        exit();
    } else {
        echo "<script>alert('Invalid username or password!'); window.location.href = 'login.php';</script>";
    }
} else {
    echo "<script>alert('Invalid username or password!'); window.location.href = 'login.php';</script>";
}

$stmt->close();
$conn->close();
?>
