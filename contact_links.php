<?php
// Fetch contact links content
$contact_links_result = $conn->query("SELECT * FROM contact_links");

// Handle contact links form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_links_action'])) {
    $platform_name = $_POST['platform_name'];
    $url = $_POST['url'];
    $icon_class = $_POST['icon_class'];
    $contact_info_id = $_POST['contact_info_id'];

    if ($_POST['contact_links_action'] === 'add') {
        $stmt = $conn->prepare("INSERT INTO contact_links (platform_name, url, icon_class, contact_info_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $platform_name, $url, $icon_class, $contact_info_id);
    } elseif ($_POST['contact_links_action'] === 'edit') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE contact_links SET platform_name = ?, url = ?, icon_class = ?, contact_info_id = ? WHERE id = ?");
        $stmt->bind_param("sssii", $platform_name, $url, $icon_class, $contact_info_id, $id);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit;
}

// Handle delete action
if (isset($_GET['delete_contact_link'])) {
    $id = $_GET['delete_contact_link'];
    $conn->query("DELETE FROM contact_links WHERE id = $id");

    header("Location: dashboard.php");
    exit;
}
