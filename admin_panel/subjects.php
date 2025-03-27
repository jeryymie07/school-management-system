<?php include('partials/_header.php') ?>

<!-- Add Subject Modal -->
<div class="modal modal-md" style="z-index: 2000;" id="add-subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Subject</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="create-subject-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <div class="mb-3">
                            <label for="subject-code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" name="subject_code" id="subject-code" required>
                            <div class="invalid-feedback">This field can't be empty!</div>
                        </div>

                        <div class="mb-3">
                            <label for="subject-name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" name="subject_name" id="newSubjectName" required>
                            <div class="invalid-feedback">This field can't be empty!</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="class" class="form-label">Grade Level</label>
                            <select class="form-select" name="class" id="class" required>
                                <?php include('partials/select_classes.php') ?>
                            </select>
                            <div class="invalid-feedback">Please select grade level.</div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div class="invalid-feedback">Please select status.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add-subject-btn">
                        <i class='bx bx-book-add'></i>&nbsp;&nbsp;<span>Add</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal modal-md" style="z-index: 2000;" id="edit-subject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Subject</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="editSubjectForm" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <input type="hidden" id="edit-subject-id">

                        <div class="mb-3">
                            <label for="edit-subject-code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="edit-subject-code" name="subject_code" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject-edited-name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="subject-edited-name" name="subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-description" name="description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-class" class="form-label">Grade Level</label>
                            <select class="form-select" name="class" id="edit-class" required>
                                <?php include('partials/select_classes.php') ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="edit-status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save-new-subject-name">
                        <span>Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Subjects</h1>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-book-reader'></i>
                    <h3>Subject List</h3>
                    <div class="student-btns">
                        <div class="dropdown dropdown-center">
                            <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                <i class='bx bx-filter'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" id="add_subject_dropdown" data-bs-toggle="modal" data-bs-target="#add-subject">Add Subject</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="students-table">
                    <?php
                        $sql = "SELECT * FROM subjects";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-hover'><thead><tr><th>#</th><th>Subject Code</th><th>Subject Name</th><th>Description</th><th>Grade Level</th><th>Status</th></tr></thead><tbody>";
                            $counter = 1;
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$counter."</td><td>".$row['subject_code']."</td><td>".$row['subject']."</td><td>".$row['description']."</td><td>".$row['class']."</td><td>".$row['status']."</td></tr>";
                                $counter++;
                            }
                            echo "</tbody></table>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/subjects.js"></script>
<?php include('partials/_footer.php'); ?>