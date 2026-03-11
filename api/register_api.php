<?php
header("Content-Type: application/json");
include '../db.php';

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($username) || empty($password)) {
        $response = [
            "status" => "error",
            "message" => "Username and password are required."
        ];
    } else {

        $stmt = $conn->prepare("SELECT id FROM login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response = [
                "status" => "error",
                "message" => "Username already taken."
            ];
        } else {
            // Hash the pass
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $response = [
                    "status" => "success",
                    "message" => "User registered successfully."
                ];
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Something went wrong. Please try again."
                ];
            }
        }

        $stmt->close();
    }
}

$conn->close();
echo json_encode($response);
?>