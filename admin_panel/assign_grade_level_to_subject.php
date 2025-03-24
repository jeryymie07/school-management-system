<?php include('partials/_header.php') ?>

<!-- Add Grade Subject Assignment Modal -->
<div class="modal fade" id="addGradeSubjectModal" tabindex="-1" aria-labelledby="addGradeSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addGradeSubjectLabel">Assign Subject to Grade Level</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="grade-subject-form" novalidate>
                <div class="modal-body">
                    <div class="container">
                        <!-- Main Information Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Pangunahing Impormasyon</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="grade_level" class="form-label">Grade Level</label>
                                            <select class="form-select" id="grade_level" name="grade_level" required>
                                                <option value="" disabled selected>--Select Grade Level--</option>
                                                <option value="Pre-School">Pre-School</option>
                                                <option value="Kinder">Kinder</option>
                                                <option value="Grade 1">Grade 1</option>
                                                <option value="Grade 2">Grade 2</option>
                                                <option value="Grade 3">Grade 3</option>
                                                <option value="Grade 4">Grade 4</option>
                                                <option value="Grade 5">Grade 5</option>
                                                <option value="Grade 6">Grade 6</option>
                                                <option value="Grade 7">Grade 7</option>
                                                <option value="Grade 8">Grade 8</option>
                                                <option value="Grade 9">Grade 9</option>
                                                <option value="Grade 10">Grade 10</option>
                                                <option value="Grade 11">Grade 11</option>
                                                <option value="Grade 12">Grade 12</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a grade level.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="subject_name" class="form-label">Subject Name</label>
                                            <select class="form-select" id="subject_name" name="subject_name" required>
                                                <option value="" disabled selected>--Select Subject--</option>
                                                <option value="English">English</option>
                                                <option value="Mathematics">Mathematics</option>
                                                <option value="Science">Science</option>
                                                <option value="Filipino">Filipino</option>
                                                <option value="Social Studies">Social Studies</option>
                                                <option value="Physical Education">Physical Education</option>
                                                <option value="Music">Music</option>
                                                <option value="Arts">Arts</option>
                                                <option value="Technology">Technology</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a subject.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="school_year" class="form-label">School Year</label>
                                            <select class="form-select" id="school_year" name="school_year" required>
                                                <option value="" disabled selected>--Select School Year--</option>
                                                <?php
                                                // Generate school years for the next 5 years
                                                $current_year = date('Y');
                                                for ($i = 0; $i < 5; $i++) {
                                                    $start_year = $current_year + $i;
                                                    $end_year = $start_year + 1;
                                                    echo "<option value='{$start_year}-{$end_year}'>{$start_year}-{$end_year}</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a school year.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subject Details Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Subject Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="subject_code" class="form-label">Subject Code</label>
                                            <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="e.g., MATH101, ENG201" required>
                                            <div class="invalid-feedback">
                                                Please enter a subject code.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="subject_type" class="form-label">Subject Type</label>
                                            <select class="form-select" id="subject_type" name="subject_type" required>
                                                <option value="" disabled selected>--Select Subject Type--</option>
                                                <option value="Core Subject">Core Subject</option>
                                                <option value="Elective">Elective</option>
                                                <option value="Special Program">Special Program</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a subject type.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="units" class="form-label">Number of Units</label>
                                            <input type="number" class="form-control" id="units" name="units" min="0">
                                            <div class="form-text">
                                                Optional field - Enter if applicable
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="grading_periods" class="form-label">Grading Periods Covered</label>
                                    <select class="form-select" id="grading_periods" name="grading_periods" required>
                                        <option value="" disabled selected>--Select Grading Periods--</option>
                                        <option value="1st Quarter">1st Quarter</option>
                                        <option value="1st to 2nd Quarter">1st to 2nd Quarter</option>
                                        <option value="1st to 3rd Quarter">1st to 3rd Quarter</option>
                                        <option value="1st to 4th Quarter">1st to 4th Quarter</option>
                                        <option value="2nd Quarter">2nd Quarter</option>
                                        <option value="2nd to 3rd Quarter">2nd to 3rd Quarter</option>
                                        <option value="2nd to 4th Quarter">2nd to 4th Quarter</option>
                                        <option value="3rd Quarter">3rd Quarter</option>
                                        <option value="3rd to 4th Quarter">3rd to 4th Quarter</option>
                                        <option value="4th Quarter">4th Quarter</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select grading periods covered.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Assignment</button>
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
                <h1>Grade Level Subject Assignment</h1>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link active" id="addAssignmentTab" data-bs-toggle="tab" data-bs-target="#add-assignment-tab"
                            type="button" role="tab" aria-controls="add-assignment-tab" aria-selected="true">Assign Subject</button>
                    </li>
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link" id="showAssignmentsTab" data-bs-toggle="tab" data-bs-target="#show-assignments-tab"
                            type="button" role="tab" aria-controls="show-assignments-tab" aria-selected="false">View Assignments</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="add-assignment-tab" role="tabpanel" aria-labelledby="add-assignment-tab" tabindex="0">
                        <br>
                        <div class="header">
                            <i class='bx bx-book-reader'></i>
                            <h3>Grade Level Subject Assignment</h3>
                            <div class="student-btns">
                                <div class="student-btns">
                                    <div class="dropdown dropdown-center">
                                        <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                            <i class='bx bx-filter'></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" id="add_assignment_dropdown" data-bs-toggle="modal" data-bs-target="#addGradeSubjectModal">Assign Subject</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="container add-remove">
                            <ul class="insights">
                                <a class="addlink" data-bs-toggle="modal" data-bs-target="#addGradeSubjectModal">
                                    <li class="additem">
                                        <i class='bx bxs-book-add'></i>
                                        <span class="info">
                                            <h3>Assign</h3>
                                            <h3>Subject</h3>
                                        </span>
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <hr>
                    </div>

                    <div class="tab-pane" id="show-assignments-tab" role="tabpanel" aria-labelledby="show-assignments-tab" tabindex="0">
                        <div class="showAttendence">
                            <div class="container">
                                <br>
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-list-ul'></i>
                                        <h3>Subject Assignments List</h3>
                                        <div class="_flex-container">
                                            <input class="form-control me-2" type="search" placeholder="Search" style="max-width: 225px;height: 40px;" id="search-assignment-name"
                                                aria-label="Search">
                                            <button class="btn btn-success" type="button" id="searchAssignmentByNameBtn" disabled><i class='bx bx-search-alt'></i></button>
                                        </div>
                                    </div>
                                    <hr class="text-danger">
                                    <div class="students-table">
                                        <table class="remove-cursor-pointer">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="thead col-1">#</th>
                                                    <th scope="col" class="thead col-2">Grade Level</th>
                                                    <th scope="col" class="thead col-2">Subject Name</th>
                                                    <th scope="col" class="thead col-2">Subject Code</th>
                                                    <th scope="col" class="thead col-1">Subject Type</th>
                                                    <th scope="col" class="thead col-1">Units</th>
                                                    <th scope="col" class="thead col-2">Grading Periods</th>
                                                    <th scope="col" class="thead col-2">School Year</th>
                                                    <th scope="col" class="thead col-2">Status</th>
                                                    <th scope="col" class="thead col-2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="assignment-table-body">
                                                <!-- content come form database -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="assignmentDataNotAvailable">
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
                                        <button type="button" class="btn btn-secondary" id="prev-assignment-page-btn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true" id="assignment-page-number">1</a>
                                        <button type="button" class="btn btn-secondary" id="next-assignment-page-btn">next</button>
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

<script src="../assets/js/grade_subject_assignment.js"></script>
<?php include('partials/_footer.php'); ?>