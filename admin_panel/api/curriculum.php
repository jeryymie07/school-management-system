<?php
include('../../assets/config.php');

header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            $curriculumName = $_POST['curriculum_name'] ?? '';
            $description = $_POST['description'] ?? '';
            $schoolYear = $_POST['school_year'] ?? '';
            $gradeLevels = $_POST['grade_levels'] ?? '';
            $status = $_POST['status'] ?? 'Active';

            if (empty($curriculumName) || empty($description) || empty($schoolYear) || empty($gradeLevels)) {
                throw new Exception('All fields are required');
            }

            $stmt = $conn->prepare("INSERT INTO curriculums (curriculum_name, description, school_year, grade_levels, status) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $curriculumName, $description, $schoolYear, $gradeLevels, $status);
            $stmt->execute();

            $curriculumId = $conn->insert_id;

            // Insert subjects
            if (isset($_POST['subject_name'])) {
                foreach ($_POST['subject_name'] as $index => $subjectName) {
                    if (!empty($subjectName)) {
                        $subjectCode = $_POST['subject_code'][$index] ?? '';
                        $units = $_POST['units'][$index] ?? 1;
                        $subjectType = $_POST['subject_type'][$index] ?? '';

                        $stmt = $conn->prepare("INSERT INTO curriculum_subjects (curriculum_id, subject_name, subject_code, units, subject_type) 
                                              VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("isssi", $curriculumId, $subjectName, $subjectCode, $units, $subjectType);
                        $stmt->execute();
                    }
                }
            }

            echo json_encode(['success' => true, 'message' => 'Curriculum added successfully']);
            break;

        case 'edit':
            $id = $_POST['edit_curriculum_id'] ?? 0;
            $curriculumName = $_POST['edit_curriculum_name'] ?? '';
            $description = $_POST['edit_description'] ?? '';
            $schoolYear = $_POST['edit_school_year'] ?? '';
            $gradeLevels = $_POST['edit_grade_levels'] ?? '';
            $status = $_POST['edit_status'] ?? 'Active';

            if (empty($id) || empty($curriculumName) || empty($description) || empty($schoolYear) || empty($gradeLevels)) {
                throw new Exception('All fields are required');
            }

            // Update curriculum
            $stmt = $conn->prepare("UPDATE curriculums SET curriculum_name=?, description=?, school_year=?, 
                                  grade_levels=?, status=? WHERE id=?");
            $stmt->bind_param("sssssi", $curriculumName, $description, $schoolYear, $gradeLevels, $status, $id);
            $stmt->execute();

            // Delete existing subjects
            $stmt = $conn->prepare("DELETE FROM curriculum_subjects WHERE curriculum_id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            // Insert new subjects
            if (isset($_POST['edit_subject_name'])) {
                foreach ($_POST['edit_subject_name'] as $index => $subjectName) {
                    if (!empty($subjectName)) {
                        $subjectCode = $_POST['edit_subject_code'][$index] ?? '';
                        $units = $_POST['edit_units'][$index] ?? 1;
                        $subjectType = $_POST['edit_subject_type'][$index] ?? '';

                        $stmt = $conn->prepare("INSERT INTO curriculum_subjects (curriculum_id, subject_name, subject_code, units, subject_type) 
                                              VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("isssi", $id, $subjectName, $subjectCode, $units, $subjectType);
                        $stmt->execute();
                    }
                }
            }

            echo json_encode(['success' => true, 'message' => 'Curriculum updated successfully']);
            break;

        case 'delete':
            $id = $_POST['id'] ?? 0;
            
            if (empty($id)) {
                throw new Exception('Curriculum ID is required');
            }

            // Delete curriculum and its subjects
            $stmt = $conn->prepare("DELETE FROM curriculums WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Curriculum deleted successfully']);
            break;

        case 'fetch':
            $stmt = $conn->prepare("SELECT * FROM curriculums ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            
            $curriculums = [];
            while ($curriculum = $result->fetch_assoc()) {
                $stmt = $conn->prepare("SELECT * FROM curriculum_subjects WHERE curriculum_id=?");
                $stmt->bind_param("i", $curriculum['id']);
                $stmt->execute();
                $subjects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                
                $curriculum['subjects'] = $subjects;
                $curriculums[] = $curriculum;
            }

            echo json_encode($curriculums);
            break;

        case 'get':
            $id = $_POST['id'] ?? 0;
            
            if (empty($id)) {
                throw new Exception('Curriculum ID is required');
            }

            $stmt = $conn->prepare("SELECT * FROM curriculums WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $curriculum = $stmt->get_result()->fetch_assoc();
            
            if ($curriculum) {
                $stmt = $conn->prepare("SELECT * FROM curriculum_subjects WHERE curriculum_id=?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $curriculum['subjects'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }

            echo json_encode($curriculum ?? ['success' => false, 'message' => 'Curriculum not found']);
            break;

        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}