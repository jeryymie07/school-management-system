<?php include('partials/_header.php') ?>

<!-- Add Curriculum Modal -->
<div class="modal fade" id="addCurriculumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Curriculum</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="curriculum-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <!-- General Information -->
                        <div class="mb-3">
                            <label for="curriculum_name" class="form-label">Curriculum Name</label>
                            <input type="text" class="form-control" id="curriculum_name" name="curriculum_name" required>
                            <div class="invalid-feedback">
                                Please enter a curriculum name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Please provide a description.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="school_year" class="form-label">School Year</label>
                            <input type="text" class="form-control" id="school_year" name="school_year" placeholder="e.g., 2024-2025" required>
                            <div class="invalid-feedback">
                                Please enter a school year.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="grade_levels" class="form-label">Grade Levels</label>
                            <input type="text" class="form-control" id="grade_levels" name="grade_levels" placeholder="e.g., Grade 7-10" required>
                            <div class="invalid-feedback">
                                Please enter grade levels.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option selected disabled value="">--select--</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a status.
                            </div>
                        </div>

                        <!-- Subjects and Course Structure -->
                        <h5 class="mt-4">Subjects and Course Structure</h5>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6>Add Subject</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="add-subject-btn">
                                    <i class='bx bx-plus'></i> Add Subject
                                </button>
                            </div>
                            <div id="subjects-container">
                                <!-- Subjects will be added here dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Curriculum Modal -->
<div class="modal fade" id="editCurriculumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Curriculum</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="edit-curriculum-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <input type="hidden" id="edit_curriculum_id" name="edit_curriculum_id">
                        <!-- General Information -->
                        <div class="mb-3">
                            <label for="edit_curriculum_name" class="form-label">Curriculum Name</label>
                            <input type="text" class="form-control" id="edit_curriculum_name" name="edit_curriculum_name" required>
                            <div class="invalid-feedback">
                                Please enter a curriculum name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="edit_description" rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Please provide a description.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_school_year" class="form-label">School Year</label>
                            <input type="text" class="form-control" id="edit_school_year" name="edit_school_year" required>
                            <div class="invalid-feedback">
                                Please enter a school year.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_grade_levels" class="form-label">Grade Levels</label>
                            <input type="text" class="form-control" id="edit_grade_levels" name="edit_grade_levels" required>
                            <div class="invalid-feedback">
                                Please enter grade levels.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="edit_status" required>
                                <option selected disabled value="">--select--</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a status.
                            </div>
                        </div>

                        <!-- Subjects and Course Structure -->
                        <h5 class="mt-4">Subjects and Course Structure</h5>
                        <div id="edit-subjects-container">
                            <!-- Subjects will be loaded here dynamically -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Curriculum Management</h1>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link active" id="addCurriculumTab" data-bs-toggle="tab" data-bs-target="#add-curriculum-tab"
                            type="button" role="tab" aria-controls="add-curriculum-tab" aria-selected="true">Add Curriculum</button>
                    </li>
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link" id="showCurriculumTab" data-bs-toggle="tab" data-bs-target="#show-curriculum-tab"
                            type="button" role="tab" aria-controls="show-curriculum-tab" aria-selected="false">Show Curriculums</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="add-curriculum-tab" role="tabpanel" aria-labelledby="add-curriculum-tab" tabindex="0">
                        <br>
                        <div class="header">
                            <i class='bx bx-book-reader'></i>
                            <h3>Curriculum Management</h3>
                            <div class="student-btns">
                                <div class="student-btns">
                                    <div class="dropdown dropdown-center">
                                        <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                            <i class='bx bx-filter'></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" id="add_curriculum_dropdown" data-bs-toggle="modal" data-bs-target="#addCurriculumModal">Add Curriculum</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="container add-remove">
                            <ul class="insights">
                                <a class="addlink" data-bs-toggle="modal" data-bs-target="#addCurriculumModal">
                                    <li class="additem">
                                        <i class='bx bxs-book-add'></i>
                                        <span class="info">
                                            <h3>Add</h3>
                                            <h3>Curriculum</h3>
                                        </span>
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <hr>
                    </div>

                    <div class="tab-pane" id="show-curriculum-tab" role="tabpanel" aria-labelledby="show-curriculum-tab" tabindex="0">
                        <div class="showAttendence">
                            <div class="container">
                                <br>
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-list-ul'></i>
                                        <h3>Curriculum List</h3>
                                        <div class="_flex-container">
                                            <input class="form-control me-2" type="search" placeholder="Search" style="max-width: 225px;height: 40px;" id="search-curriculum-name"
                                                aria-label="Search">
                                            <button class="btn btn-success" type="button" id="searchCurriculumByNameBtn" disabled><i class='bx bx-search-alt'></i></button>
                                        </div>
                                    </div>
                                    <hr class="text-danger">
                                    <div class="students-table">
                                        <table class="remove-cursor-pointer">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="thead col-2">#</th>
                                                    <th scope="col" class="thead col-3">Curriculum Name</th>
                                                    <th scope="col" class="thead col-2">School Year</th>
                                                    <th scope="col" class="thead col-2">Grade Levels</th>
                                                    <th scope="col" class="thead col-2">Status</th>
                                                    <th scope="col" class="thead col-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="curriculum-table-body">
                                                <!-- content come form database -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="curriculumDataNotAvailable">
                                        <div class="_flex-container box-hide">
                                            <div class="no-data-box">
                                                <div class="no-dataicon">
                                                    <i class='bx bx-data'></i>
                                                </div>
                                                <p>No Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="text-danger">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary" id="prev-curriculum-page-btn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true" id="curriculum-page-number">1</a>
                                        <button type="button" class="btn btn-secondary" id="next-curriculum-page-btn">next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/curriculum.js"></script>
<?php include('partials/_footer.php'); ?>