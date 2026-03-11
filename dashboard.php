<?php
session_start();
include 'db.php'; // Ensure session timeout logic is applied

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Regenerate session ID to prevent session fixation
if (!isset($_SESSION['session_regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['session_regenerated'] = true;
}

$conn = new mysqli('localhost', 'root', '', 'my_portfolio');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$dashboardApiUrl = 'api/dashboard_api.php';

include 'hero_section.php';
include 'resume_section.php';
include 'projects_section.php';
include 'contact_info.php';

$result = $conn->query("SELECT * FROM hero_section WHERE id = 1");
$hero = $result->fetch_assoc();
$resume_result = $conn->query("SELECT * FROM resume_section");
$projects_result = $conn->query("SELECT * FROM projects_section");
$contact_info_result = $conn->query("SELECT * FROM contact_info");
$contact_links_result = $conn->query("SELECT * FROM contact_links");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['resume_action'])) {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $icon = filter_var($_POST['icon'], FILTER_SANITIZE_STRING);

        if (empty($title) || empty($content)) {
            die("Title and content are required.");
        }

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
    } elseif (isset($_POST['project_action'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $media_type = $_POST['media_type'];
        $media_path = '';

        if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/projects/';
            $media_name = basename($_FILES['media']['name']);
            $target_file = $upload_dir . $media_name;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['media']['tmp_name'], $target_file)) {
                $media_path = $target_file;
            } else {
                die("Failed to upload media.");
            }
        }

        if ($_POST['project_action'] === 'add') {
            $stmt = $conn->prepare("INSERT INTO projects_section (title, description, media_type, media_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $description, $media_type, $media_path);
        } elseif ($_POST['project_action'] === 'edit') {
            $id = $_POST['id'];
            $stmt = $conn->prepare("UPDATE projects_section SET title = ?, description = ?, media_type = ?, media_path = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $title, $description, $media_type, $media_path, $id);
        }
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    } elseif (isset($_POST['hero_action'])) {
        $heading = $_POST['heading'];
        $description = $_POST['description'];
        $name = $_POST['name'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            $image_name = basename($_FILES['image']['name']);
            $target_file = $upload_dir . $image_name;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            } else {
                die("Failed to upload image.");
            }
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
    } elseif (isset($_POST['contact_info_action'])) {
        $section_title = $_POST['section_title'];
        $description = $_POST['description'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];

        $stmt = $conn->prepare("INSERT INTO contact_info (section_title, description, email, phone, location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $section_title, $description, $email, $phone, $location);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    } elseif (isset($_POST['contact_links_action'])) {
        $platform_name = $_POST['platform_name'];
        $url = $_POST['url'];
        $icon_class = $_POST['icon_class'];
        $contact_info_id = $_POST['contact_info_id'];

        $stmt = $conn->prepare("INSERT INTO contact_links (platform_name, url, icon_class, contact_info_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $platform_name, $url, $icon_class, $contact_info_id);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    }
}

if (isset($_GET['delete_resume'])) {
    $id = filter_var($_GET['delete_resume'], FILTER_VALIDATE_INT);
    if ($id) {
        $conn->query("DELETE FROM resume_section WHERE id = $id");
    }
    header("Location: dashboard.php");
    exit;
}
if (isset($_GET['delete_project'])) {
    $id = filter_var($_GET['delete_project'], FILTER_VALIDATE_INT);
    if ($id) {
        $conn->query("DELETE FROM projects_section WHERE id = $id");
    }
    header("Location: dashboard.php");
    exit;
}
if (isset($_GET['delete_contact_info'])) {
    $id = filter_var($_GET['delete_contact_info'], FILTER_VALIDATE_INT);
    if ($id) {
        $conn->query("DELETE FROM contact_info WHERE id = $id");
    }
    header("Location: dashboard.php");
    exit;
}
if (isset($_GET['delete_contact_link'])) {
    $id = filter_var($_GET['delete_contact_link'], FILTER_VALIDATE_INT);
    if ($id) {
        $conn->query("DELETE FROM contact_links WHERE id = $id");
    }
    header("Location: dashboard.php");
    exit;
}

$section = $_GET['section'] ?? 'hero';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        @font-face {
            font-family: '3Dventure';
            src: url('assets/3Dventure.ttf') format('truetype');
        }
        @font-face {
            font-family: 'PixelifySans-VariableFont_wght';
            src: url('assets/PixelifySans-VariableFont_wght.ttf') format('truetype');
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'PixelifySans-VariableFont_wght', sans-serif;
            display: flex;
            background: #C8BDDB;
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

        

    .sidebar {
        width: 260px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        position: sticky;
        top: 0;
        height: 100vh;
        box-shadow: 5px 0 10px rgba(0, 0, 0, 0.1);
    }


        .sidebar h2 {
            color: #55276C;
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar a {
            color: #AF5A97;
            text-decoration: none;
            padding: 12px 15px;
            background: #E5E5F4;
            border-left: 5px solid transparent;
            transition: 0.3s;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 8px;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #AF5A97;
            border-left: 5px solid #55276C;
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 40px;
            background: #E5E5F4;
        }

        h1, h2 {
            color: #55276C;
            margin-bottom: 20px;
        }

        form {
            background: #E5E5F4;
            padding: 20px;
            border: 2px solid #AF5A97;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        label {
            font-size: 1rem;
            color: #55276C;
        }

        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            background: #E5E5F4;
            border: 1px solid #AF5A97;
            color: #333;
            font-family: inherit;
            font-size: 1rem;
            border-radius: 5px;
        }

        button {
            background: #AF5A97;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #55276C;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            background: #D4D4ED;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #AF5A97;
            font-size: 1rem;
            border-radius: 8px;
        }

        ul li a {
            color: #55276C;
            font-weight: bold;
            margin-top: 5px;
            display: inline-block;
            text-decoration: none;
        }

        ul li a:hover {
            color: #AF5A97;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="?section=hero" class="<?= $section === 'hero' ? 'active' : '' ?>">Profile</a>
        <a href="?section=resume" class="<?= $section === 'resume' ? 'active' : '' ?>">Resume</a>
        <a href="?section=projects" class="<?= $section === 'projects' ? 'active' : '' ?>">Projects</a>
        <a href="?section=contact_info" class="<?= $section === 'contact_info' ? 'active' : '' ?>">Contact Info</a>
        <a href="?logout=true" style="color: red;">Logout</a>
    </div>
    <div class="content">
        <?php include __DIR__ . "/sections/{$section}_section.php"; ?>
    </div>
</body>
</html>
