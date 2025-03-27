<?php
include '../assets/config.php';

header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            $subjectCode = $_POST['subject_code'];
            $subjectName = $_POST['subject_name'];
            $description = $_POST['description'];
            $gradeLevelId = $_POST['grade_level_id'];
            $status = $_POST['status'];

            $stmt = $conn->prepare("INSERT INTO subjects (subject_code, subject_name, description, grade_level_id, status) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $subjectCode, $subjectName, $description, $gradeLevelId, $status);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Subject added successfully']);
            break;

        case 'edit':
            $id = $_POST['id'];
            $subjectCode = $_POST['subject_code'];
            $subjectName = $_POST['subject_name'];
            $description = $_POST['description'];
            $gradeLevelId = $_POST['grade_level_id'];
            $status = $_POST['status'];

            $stmt = $conn->prepare("UPDATE subjects SET subject_code=?, subject_name=?, description=?, grade_level_id=?, status=? 
                                  WHERE id=?");
            $stmt->bind_param("ssisis", $subjectCode, $subjectName, $description, $gradeLevelId, $status, $id);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Subject updated successfully']);
            break;

        case 'delete':
            $id = $_POST['id'];
            $stmt = $conn->prepare("DELETE FROM subjects WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Subject deleted successfully']);
            break;

        case 'get':
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT s.*, gl.grade_level 
                                  FROM subjects s 
                                  JOIN grade_levels gl ON s.grade_level_id = gl.id 
                                  WHERE s.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $subject = $result->fetch_assoc();

            if ($subject) {
                echo json_encode($subject);
            } else {
                echo json_encode(['error' => 'Subject not found']);
            }
            break;

        case 'get_all':
            $stmt = $conn->prepare("SELECT s.*, gl.grade_level 
                                  FROM subjects s 
                                  JOIN grade_levels gl ON s.grade_level_id = gl.id 
                                  ORDER BY s.subject_name");
            $stmt->execute();
            $result = $stmt->get_result();
            $subjects = $result->fetch_all(MYSQLI_ASSOC);

            echo json_encode($subjects);
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>