<?php
// Fetch resume section content
$resume_result = $conn->query("SELECT * FROM resume_section");

// Handle resume section form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resume_action'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $icon = filter_var($_POST['icon'], FILTER_SANITIZE_STRING);

    if ($_POST['resume_action'] === 'add') {
        $stmt = $conn->prepare("INSERT INTO resume_section (title, content, icon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $icon);
    } elseif ($_POST['resume_action'] === 'edit') {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if (!$id) {
            die("Invalid ID.");
        }
        $stmt = $conn->prepare("UPDATE resume_section SET title = ?, content = ?, icon = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $content, $icon, $id);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit;
}

// Handle delete action
if (isset($_GET['delete_resume'])) {
    $id = filter_var($_GET['delete_resume'], FILTER_VALIDATE_INT);
    if ($id) {
        $conn->query("DELETE FROM resume_section WHERE id = $id");
    }
    header("Location: dashboard.php");
    exit;
}
