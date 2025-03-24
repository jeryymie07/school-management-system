<?php include('partials/_header.php') ?>

<!-- Add Teacher Room Assignment Modal -->
<div class="modal fade" id="addTeacherRoomModal" tabindex="-1" aria-labelledby="addTeacherRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTeacherRoomLabel">Assign Teacher to Room</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="teacher-room-form" novalidate>
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
                                            <label for="teacher_name" class="form-label">Teacher Name</label>
                                            <select class="form-select" id="teacher_name" name="teacher_name" required>
                                                <option value="" disabled selected>--Select Teacher--</option>
                                                <?php
                                                // This would typically come from your database
                                                $teachers = [
                                                    "Juan Dela Cruz", "Maria Santos", "Pedro Ramirez"
                                                ];
                                                foreach ($teachers as $teacher) {
                                                    echo "<option value='$teacher'>$teacher</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a teacher.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="teacher_id" class="form-label">Teacher ID</label>
                                            <input type="text" class="form-control" id="teacher_id" name="teacher_id" required>
                                            <div class="invalid-feedback">
                                                Please enter a teacher ID.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="room_name" class="form-label">Room Name/Number</label>
                                            <select class="form-select" id="room_name" name="room_name" required>
                                                <option value="" disabled selected>--Select Room--</option>
                                                <?php
                                                // This would typically come from your database
                                                $rooms = [
                                                    "Room 101", "Room 102", "Room 103",
                                                    "Kinder Room A", "Kinder Room B",
                                                    "Grade 1 Room A", "Grade 1 Room B"
                                                ];
                                                foreach ($rooms as $room) {
                                                    echo "<option value='$room'>$room</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a room.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="building_name" class="form-label">Building Name</label>
                                            <select class="form-select" id="building_name" name="building_name" required>
                                                <option value="" disabled selected>--Select Building--</option>
                                                <option value="Main Building">Main Building</option>
                                                <option value="Annex">Annex</option>
                                                <option value="Pre-School Wing">Pre-School Wing</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a building.
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

                        <!-- Assignment Details Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Assignment Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="subject_taught" class="form-label">Subject Taught</label>
                                            <select class="form-select" id="subject_taught" name="subject_taught">
                                                <option value="" disabled selected>--Select Subject--</option>
                                                <option value="Mathematics">Mathematics</option>
                                                <option value="Science">Science</option>
                                                <option value="English">English</option>
                                                <option value="Filipino">Filipino</option>
                                                <option value="Social Studies">Social Studies</option>
                                                <option value="Physical Education">Physical Education</option>
                                            </select>
                                            <div class="form-text">
                                                Optional field - Select if applicable
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="grade_level" class="form-label">Grade Level</label>
                                            <select class="form-select" id="grade_level" name="grade_level">
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
                                            <div class="form-text">
                                                Optional field - For homeroom teachers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="days_of_week" class="form-label">Days of the Week</label>
                                            <select class="form-select" id="days_of_week" name="days_of_week" required>
                                                <option value="" disabled selected>--Select Days--</option>
                                                <option value="Monday-Friday">Monday-Friday</option>
                                                <option value="MWF">MWF</option>
                                                <option value="TThS">TThS</option>
                                                <option value="Monday-Wednesday">Monday-Wednesday</option>
                                                <option value="Tuesday-Thursday">Tuesday-Thursday</option>
                                                <option value="Friday">Friday</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select days of the week.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="time_start" class="form-label">Time Start</label>
                                            <input type="time" class="form-control" id="time_start" name="time_start" required>
                                            <div class="invalid-feedback">
                                                Please select a start time.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="time_end" class="form-label">Time End</label>
                                            <input type="time" class="form-control" id="time_end" name="time_end" required>
                                            <div class="invalid-feedback">
                                                Please select an end time.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Room Availability & Usage Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Room Availability & Usage (Optional)</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="room_type" class="form-label">Room Type</label>
                                            <select class="form-select" id="room_type" name="room_type">
                                                <option value="" disabled selected>--Select Room Type--</option>
                                                <option value="Classroom">Classroom</option>
                                                <option value="Laboratory">Laboratory</option>
                                                <option value="Faculty Room">Faculty Room</option>
                                                <option value="Conference Room">Conference Room</option>
                                            </select>
                                            <div class="form-text">
                                                Optional field - Room type
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="session_type" class="form-label">Session Type</label>
                                            <select class="form-select" id="session_type" name="session_type">
                                                <option value="" disabled selected>--Select Session Type--</option>
                                                <option value="Morning">Morning</option>
                                                <option value="Afternoon">Afternoon</option>
                                                <option value="Whole Day">Whole Day</option>
                                            </select>
                                            <div class="form-text">
                                                Optional field - Session type
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="room_status" class="form-label">Room Status</label>
                                            <select class="form-select" id="room_status" name="room_status">
                                                <option value="" disabled selected>--Select Status--</option>
                                                <option value="Available">Available</option>
                                                <option value="Under Maintenance">Under Maintenance</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                            <div class="form-text">
                                                Optional field - Room status
                                            </div>
                                        </div>
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
                <h1>Teacher Room Assignment</h1>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link active" id="addAssignmentTab" data-bs-toggle="tab" data-bs-target="#add-assignment-tab"
                            type="button" role="tab" aria-controls="add-assignment-tab" aria-selected="true">Assign Teacher</button>
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
                            <i class='bx bx-building'></i>
                            <h3>Teacher Room Assignment</h3>
                            <div class="student-btns">
                                <div class="student-btns">
                                    <div class="dropdown dropdown-center">
                                        <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                            <i class='bx bx-filter'></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" id="add_assignment_dropdown" data-bs-toggle="modal" data-bs-target="#addTeacherRoomModal">Assign Teacher</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="container add-remove">
                            <ul class="insights">
                                <a class="addlink" data-bs-toggle="modal" data-bs-target="#addTeacherRoomModal">
                                    <li class="additem">
                                        <i class='bx bxs-building'></i>
                                        <span class="info">
                                            <h3>Assign</h3>
                                            <h3>Teacher</h3>
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
                                        <h3>Teacher Room Assignments List</h3>
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
                                                    <th scope="col" class="thead col-2">Teacher Name</th>
                                                    <th scope="col" class="thead col-2">Teacher ID</th>
                                                    <th scope="col" class="thead col-2">Room Name/Number</th>
                                                    <th scope="col" class="thead col-2">Building</th>
                                                    <th scope="col" class="thead col-2">Subject</th>
                                                    <th scope="col" class="thead col-2">Grade Level</th>
                                                    <th scope="col" class="thead col-2">Days</th>
                                                    <th scope="col" class="thead col-2">Time</th>
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

<script src="../assets/js/teacher_room_assignment.js"></script>
<?php include('partials/_footer.php'); ?>