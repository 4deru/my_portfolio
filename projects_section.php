<?php
// Fetch projects section content
$projects_result = $conn->query("SELECT * FROM projects_section");

// Handle projects section form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_action'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $media_type = filter_var($_POST['media_type'], FILTER_SANITIZE_STRING);

    if (empty($title) || empty($description) || empty($media_type)) {
        die("Title, description, and media type are required.");
    }

    $media_path = '';

    if ($_POST['project_action'] === 'edit') {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if (!$id) {
            die("Invalid ID.");
        }
        $media_path = filter_var($_POST['existing_media'], FILTER_SANITIZE_STRING);
    }

    if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'video/mp4'];
        if (!in_array($_FILES['media']['type'], $allowed_types)) {
            die("Invalid file type.");
        }
        if ($_FILES['media']['size'] > 5 * 1024 * 1024) { 
            die("File size exceeds the limit of 5MB.");
        }

        $upload_dir = 'uploads/projects/';
        $media_name = basename(filter_var($_FILES['media']['name'], FILTER_SANITIZE_STRING));
        $media_name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $media_name); 
        $target_file = $upload_dir . $media_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['media']['tmp_name'], $target_file)) {
            die("Failed to upload media.");
        }
        $media_path = $target_file;
    }

    if ($_POST['project_action'] === 'add') {
        $stmt = $conn->prepare("INSERT INTO projects_section (title, description, media_type, media_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $media_type, $media_path);
    } elseif ($_POST['project_action'] === 'edit') {
        $stmt = $conn->prepare("UPDATE projects_section SET title = ?, description = ?, media_type = ?, media_path = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $media_type, $media_path, $id);
    }
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit;
}

// Handle delete action
if (isset($_GET['delete_project'])) {
    $id = filter_var($_GET['delete_project'], FILTER_VALIDATE_INT);
    if ($id) {
        $conn->query("DELETE FROM projects_section WHERE id = $id");
    }
    header("Location: dashboard.php");
    exit;
}
