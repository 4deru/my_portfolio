<?php
// Fetch contact info content
$contact_info_result = $conn->query("SELECT * FROM contact_info");

// Handle contact info form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_info_action'])) {
    $section_title = filter_var($_POST['section_title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);

    if ($_POST['contact_info_action'] === 'add') {
        $stmt = $conn->prepare("INSERT INTO contact_info (section_title, description, email, phone, location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $section_title, $description, $email, $phone, $location);
    } elseif ($_POST['contact_info_action'] === 'edit') {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if (!$id) {
            die("Invalid ID.");
        }
        $stmt = $conn->prepare("UPDATE contact_info SET section_title = ?, description = ?, email = ?, phone = ?, location = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $section_title, $description, $email, $phone, $location, $id);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit;
}

// Handle delete action
if (isset($_GET['delete_contact_info'])) {
    $id = $_GET['delete_contact_info'];
    $conn->query("DELETE FROM contact_info WHERE id = $id");

    header("Location: dashboard.php");
    exit;
}
