<?php include("partials/_navbar.php"); ?>
        <?php include("partials/_sidebar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .nav-tabs {
            display: flex;
            list-style: none;
            padding: 0;
            background: #444;
        }
        .nav-tabs li {
            flex: 1;
        }
        .nav-tabs button {
            width: 100%;
            padding: 15px;
            border: none;
            background: #444;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        .nav-tabs button.active {
            background: #666;
        }
        .tab-content {
            background: white;
            padding: 20px;
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .subject-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="content">

        <div class="container">
            <div class="header">
                <h1>Curriculum Management</h1>
            </div>

            <ul class="nav-tabs">
                <li><button class="tab-btn active" data-tab="add-curriculum">Add Curriculum</button></li>
                <li><button class="tab-btn" data-tab="show-curriculum">Show Curriculums</button></li>
            </ul>

            <div id="add-curriculum" class="tab-content active">
                <div class="form-container">
                    <h3>Add New Curriculum</h3>
                    <form id="add-curriculum-form" method="POST" action="process_curriculum.php">
                        <input type="hidden" name="add_curriculum" value="1">
                        <div class="mb-3">
                            <label for="curriculum_code">Curriculum Code</label>
                            <input type="text" class="form-control" id="curriculum_code" name="curriculum_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="curriculum_name">Curriculum Name</label>
                            <input type="text" class="form-control" id="curriculum_name" name="curriculum_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="educational_level">Educational Level</label>
                            <select class="form-select" id="educational_level" name="educational_level" required>
                                <option value="">Select Level</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Junior High">Junior High</option>
                                <option value="Senior High">Senior High</option>
                                <option value="College">College</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="academic_year">Academic Year</label>
                            <input type="text" class="form-control" id="academic_year" name="academic_year" required>
                        </div>
                        <div class="mb-3">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Curriculum</button>
                    </form>
                </div>
            </div>

            <div id="show-curriculum" class="tab-content">
                <h3>Curriculums</h3>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Curriculum Code</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Academic Year</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $curriculums->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['curriculum_code']); ?></td>
                                    <td><?php echo htmlspecialchars($row['curriculum_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['educational_level']); ?></td>
                                    <td><?php echo htmlspecialchars($row['academic_year']); ?></td>
                                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                    <td>
                                        <a href="edit_curriculum.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_curriculum.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll(".tab-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
                document.querySelectorAll(".tab-content").forEach(tab => tab.classList.remove("active"));

                this.classList.add("active");
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('partials/_footer.php'); ?>
<?php
include('partials/_header.php');
include('partials/_sidebar.php');
include('db_connection.php');

// Add new curriculum
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_curriculum'])) {
    $curriculum_code = $_POST['curriculum_code'];
    $curriculum_name = $_POST['curriculum_name'];
    $educational_level = $_POST['educational_level'];
    $academic_year = $_POST['academic_year'];
    $department = $_POST['department'];
    $status = $_POST['status'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO curriculums (
        curriculum_code, curriculum_name, educational_level, academic_year, 
        department, status, created_at, updated_at
    ) VALUES (
        '$curriculum_code', '$curriculum_name', '$educational_level', 
        '$academic_year', '$department', '$status', '$created_at', '$updated_at'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New curriculum added successfully'); window.location.href='curriculum.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Add new subject
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_subject'])) {
    $curriculum_id = $_POST['curriculum_id'];
    $subject_code = $_POST['subject_code'];
    $subject_name = $_POST['subject_name'];
    $description = $_POST['description'];
    $units = $_POST['units'];
    $prerequisite = $_POST['prerequisite'];
    $semester = $_POST['semester'];
    $grade_level = $_POST['grade_level'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO subjects (
        curriculum_id, subject_code, subject_name, description, units, 
        prerequisite, semester, grade_level, created_at, updated_at
    ) VALUES (
        '$curriculum_id', '$subject_code', '$subject_name', '$description', 
        '$units', '$prerequisite', '$semester', '$grade_level', 
        '$created_at', '$updated_at'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New subject added successfully'); window.location.href='curriculum.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Update curriculum
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_curriculum'])) {
    $id = $_POST['id'];
    $curriculum_code = $_POST['curriculum_code'];
    $curriculum_name = $_POST['curriculum_name'];
    $educational_level = $_POST['educational_level'];
    $academic_year = $_POST['academic_year'];
    $department = $_POST['department'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $sql = "UPDATE curriculums SET 
        curriculum_code='$curriculum_code', 
        curriculum_name='$curriculum_name', 
        educational_level='$educational_level', 
        academic_year='$academic_year', 
        department='$department', 
        status='$status', 
        updated_at='$updated_at' 
        WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Curriculum updated successfully'); window.location.href='curriculum.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Delete curriculum
if (isset($_GET['delete_curriculum'])) {
    $id = $_GET['delete_curriculum'];
    $sql = "DELETE FROM curriculums WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Curriculum deleted successfully'); window.location.href='curriculum.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Get all curriculums
$sql = "SELECT * FROM curriculums ORDER BY id DESC";
$curriculums = $conn->query($sql);

// Get all subjects for a specific curriculum
if (isset($_GET['curriculum_id'])) {
    $curriculum_id = $_GET['curriculum_id'];
    $sql = "SELECT * FROM subjects WHERE curriculum_id = $curriculum_id ORDER BY grade_level, semester";
    $subjects = $conn->query($sql);
}
?>