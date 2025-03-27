<?php
// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            try {
                $stmt = $conn->prepare("INSERT INTO curriculums (curriculum_name, description, school_year, grade_levels, status) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", 
                    $_POST['curriculum_name'],
                    $_POST['description'],
                    $_POST['school_year'],
                    $_POST['grade_levels'],
                    $_POST['status']
                );
                $stmt->execute();
                
                $curriculum_id = $conn->insert_id;
                
                // Insert subjects
                if (isset($_POST['subjects'])) {
                    $subjects = json_decode($_POST['subjects']);
                    foreach ($subjects as $subject) {
                        $stmt = $conn->prepare("INSERT INTO curriculum_subjects (curriculum_id, name, code, units, type) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("issss", 
                            $curriculum_id,
                            $subject->name,
                            $subject->code,
                            $subject->units,
                            $subject->type
                        );
                        $stmt->execute();
                    }
                }
                
                echo json_encode(['success' => true, 'message' => 'Curriculum added successfully']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;

        case 'edit':
            try {
                $stmt = $conn->prepare("UPDATE curriculums SET curriculum_name=?, description=?, school_year=?, grade_levels=?, status=? WHERE id=?");
                $stmt->bind_param("sssssi", 
                    $_POST['edit_curriculum_name'],
                    $_POST['edit_description'],
                    $_POST['edit_school_year'],
                    $_POST['edit_grade_levels'],
                    $_POST['edit_status'],
                    $_POST['edit_curriculum_id']
                );
                $stmt->execute();
                
                // Delete existing subjects
                $stmt = $conn->prepare("DELETE FROM curriculum_subjects WHERE curriculum_id = ?");
                $stmt->bind_param("i", $_POST['edit_curriculum_id']);
                $stmt->execute();
                
                // Insert new subjects
                if (isset($_POST['edit_subjects'])) {
                    $subjects = json_decode($_POST['edit_subjects']);
                    foreach ($subjects as $subject) {
                        $stmt = $conn->prepare("INSERT INTO curriculum_subjects (curriculum_id, name, code, units, type) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("issss", 
                            $_POST['edit_curriculum_id'],
                            $subject->name,
                            $subject->code,
                            $subject->units,
                            $subject->type
                        );
                        $stmt->execute();
                    }
                }
                
                echo json_encode(['success' => true, 'message' => 'Curriculum updated successfully']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;

        case 'fetch':
            try {
                $result = $conn->query("
                    SELECT c.*, GROUP_CONCAT(CONCAT(s.name, ' (', s.code, ')')) as subjects 
                    FROM curriculums c 
                    LEFT JOIN curriculum_subjects s ON c.id = s.curriculum_id 
                    GROUP BY c.id 
                    ORDER BY c.id DESC
                ");
                
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                
                echo json_encode($data);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Management</title>
    <?php include_once('./partials/_header.php'); ?>
</head>
<body>
    <?php include_once('./partials/_navbar.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include('partials/_sidebar.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Curriculum Management</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCurriculumModal">
                        <i class='bx bx-plus'></i> Add Curriculum
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Curriculum Name</th>
                                <th>Description</th>
                                <th>School Year</th>
                                <th>Grade Levels</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="curriculum-table-body">
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Curriculum Modal -->
    <div class="modal fade" id="addCurriculumModal" tabindex="-1" aria-labelledby="addCurriculumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCurriculumModalLabel">Add New Curriculum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="curriculum-form">
                        <div class="mb-3">
                            <label for="curriculum_name" class="form-label">Curriculum Name</label>
                            <input type="text" class="form-control" id="curriculum_name" name="curriculum_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="school_year" class="form-label">School Year</label>
                            <input type="text" class="form-control" id="school_year" name="school_year" required>
                        </div>
                        <div class="mb-3">
                            <label for="grade_levels" class="form-label">Grade Levels</label>
                            <input type="text" class="form-control" id="grade_levels" name="grade_levels" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="add-subject-btn">
                                <i class='bx bx-plus'></i> Add Subject
                            </button>
                        </div>
                        <div id="subjects-container" class="mb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Curriculum</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Curriculum Modal -->
    <div class="modal fade" id="editCurriculumModal" tabindex="-1" aria-labelledby="editCurriculumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCurriculumModalLabel">Edit Curriculum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-curriculum-form">
                        <input type="hidden" id="edit_curriculum_id" name="edit_curriculum_id">
                        <div class="mb-3">
                            <label for="edit_curriculum_name" class="form-label">Curriculum Name</label>
                            <input type="text" class="form-control" id="edit_curriculum_name" name="edit_curriculum_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="edit_description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_school_year" class="form-label">School Year</label>
                            <input type="text" class="form-control" id="edit_school_year" name="edit_school_year" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_grade_levels" class="form-label">Grade Levels</label>
                            <input type="text" class="form-control" id="edit_grade_levels" name="edit_grade_levels" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="edit_status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div id="edit-subjects-container" class="mb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Curriculum</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('partials/_footer.php'); ?>
    <script src="../assets/js/curriculum.js"></script>
</body>
</html>
