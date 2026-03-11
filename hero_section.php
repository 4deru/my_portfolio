<?php
// Fetch existing hero section content
$result = $conn->query("SELECT * FROM hero_section WHERE id = 1");
$hero = $result->fetch_assoc();

// Handle hero section form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hero_action'])) {
    $heading = filter_var($_POST['heading'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            die("Invalid file type.");
        }

        $upload_dir = 'uploads/';
        $image_name = basename(filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING));
        $image_name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $image_name); // Sanitize file name
        $target_file = $upload_dir . $image_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            die("Failed to upload image.");
        }
        $image_path = $target_file;
    } else {
        $image_path = $hero['image_path'] ?? '';
    }

    if ($hero) {
        $stmt = $conn->prepare("UPDATE hero_section SET image_path = ?, heading = ?, description = ?, name = ? WHERE id = 1");
        $stmt->bind_param("ssss", $image_path, $heading, $description, $name);
    } else {
        $stmt = $conn->prepare("INSERT INTO hero_section (image_path, heading, description, name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $image_path, $heading, $description, $name);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit;
}
