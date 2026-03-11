<?php
header('Content-Type: application/json');
include '../db.php';

$action = $_GET['api'] ?? '';

switch ($action) {
    case 'getHero':
        $result = $conn->query("SELECT * FROM hero_section WHERE id = 1");
        echo json_encode($result->fetch_assoc());
        exit;

    case 'updateHero':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("UPDATE hero_section SET heading = ?, description = ?, name = ? WHERE id = 1");
        $stmt->bind_param("sss", $data['heading'], $data['description'], $data['name']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    case 'getResumes':
        $result = $conn->query("SELECT * FROM resume_section");
        $resumes = [];
        while ($row = $result->fetch_assoc()) {
            $resumes[] = $row;
        }
        echo json_encode($resumes);
        exit;

    case 'addResume':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO resume_section (title, content, icon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['title'], $data['content'], $data['icon']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    case 'deleteResume':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("DELETE FROM resume_section WHERE id = ?");
        $stmt->bind_param("i", $data['id']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    case 'getProjects':
        $result = $conn->query("SELECT * FROM projects_section");
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        echo json_encode($projects);
        exit;

    case 'addProject':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO projects_section (title, description, media_type, media_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['title'], $data['description'], $data['media_type'], $data['media_path']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    case 'deleteProject':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("DELETE FROM projects_section WHERE id = ?");
        $stmt->bind_param("i", $data['id']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    case 'getContactInfo':
        $result = $conn->query("SELECT * FROM contact_info");
        $contactInfo = [];
        while ($row = $result->fetch_assoc()) {
            $contactInfo[] = $row;
        }
        echo json_encode($contactInfo);
        exit;

    case 'addContactInfo':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO contact_info (section_title, description, email, phone, location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['section_title'], $data['description'], $data['email'], $data['phone'], $data['location']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    case 'deleteContactInfo':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("DELETE FROM contact_info WHERE id = ?");
        $stmt->bind_param("i", $data['id']);
        $stmt->execute();
        echo json_encode(['status' => 'success']);
        exit;

    default:
        echo json_encode(['error' => 'Invalid API action']);
        exit;
}
?>
