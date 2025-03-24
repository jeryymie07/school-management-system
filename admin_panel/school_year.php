<?php include('partials/_header.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Year Management</title>
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
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="content">
        <?php include("partials/_navbar.php"); ?>

        <div class="container">
            <div class="header">
                <h1>School Year Management</h1>
            </div>

            <ul class="nav-tabs">
                <li><button class="tab-btn active" data-tab="add-school-year">Add School Year</button></li>
                <li><button class="tab-btn" data-tab="show-school-year">Show School Years</button></li>
            </ul>

            <div id="add-school-year" class="tab-content active">
                <div class="add-item">
                    <button onclick="document.getElementById('add-school-year-form').style.display='block'" class="btn btn-primary">Add School Year</button>
                </div>
                <form id="add-school-year-form" style="display: none;" method="POST" action="">
                    <input type="hidden" name="add_school_year" value="1">
                    <div class="mb-3">
                        <label for="start_year">Start Year</label>
                        <input type="number" class="form-control" id="start_year" name="start_year" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_year">End Year</label>
                        <input type="number" class="form-control" id="end_year" name="end_year" required>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

            <div id="show-school-year" class="tab-content">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Start Year</th>
                                <th>End Year</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM school_year ORDER BY id DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0):
                            while($row = $result->fetch_assoc()):
                        ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['start_year'] ?></td>
                                        <td><?= $row['end_year'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td><?= $row['created_at'] ?></td>
                                        <td><?= $row['updated_at'] ?></td>
                                        <td>
                                            <a href="edit_school_year.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                        <?php
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">No Data Available</td>
                            </tr>
                        <?php
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                document.getElementById(this.dataset.tab).classList.add('active');

                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

    <?php include('partials/_footer.php'); ?>
</body>
</html>

<?php
include('partials/_header.php');
include('partials/_sidebar.php');
include('db_connection.php');

// Add new school year
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_school_year'])) {
    $start_year = $_POST['start_year'];
    $end_year = $_POST['end_year'];
    $status = $_POST['status'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO school_year (start_year, end_year, status, created_at, updated_at) 
            VALUES ('$start_year', '$end_year', '$status', '$created_at', '$updated_at')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New school year added successfully'); window.location.href='school_year.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Get all school years
$sql = "SELECT * FROM school_year ORDER BY id DESC";
$result = $conn->query($sql);
$result->close();
?>