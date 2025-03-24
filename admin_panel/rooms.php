<?php include('partials/_header.php') ?>

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addRoomLabel">Add Room</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="room-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <h4>Pangunahing Impormasyon ng Room</h4>
                        <div class="mb-3">
                            <label for="room_name" class="form-label">Room Name/Number</label>
                            <input type="text" class="form-control" id="room_name" name="room_name" placeholder="e.g., Kinder Room A, Grade 1 - Room 101" required>
                            <div class="invalid-feedback">
                                Please enter a room name/number.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="building_name" class="form-label">Building Name</label>
                            <select class="form-select" id="building_name" name="building_name" required>
                                <option value="" disabled selected>--Select Building--</option>
                                <option value="Main Building">Main Building</option>
                                <option value="Pre-School Wing">Pre-School Wing</option>
                                <option value="Building 1">Building 1</option>
                                <option value="Building 2">Building 2</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a building.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="floor_number" class="form-label">Floor Number</label>
                            <select class="form-select" id="floor_number" name="floor_number">
                                <option value="" disabled selected>--Select Floor--</option>
                                <option value="Ground Floor">Ground Floor</option>
                                <option value="1st Floor">1st Floor</option>
                                <option value="2nd Floor">2nd Floor</option>
                                <option value="3rd Floor">3rd Floor</option>
                            </select>
                            <div class="form-text">
                                Optional field - Select if applicable
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="room_type" class="form-label">Room Type</label>
                            <select class="form-select" id="room_type" name="room_type" required>
                                <option value="" disabled selected>--Select Room Type--</option>
                                <option value="Classroom">Classroom</option>
                                <option value="Playroom">Playroom</option>
                                <option value="Library">Library</option>
                                <option value="Faculty Room">Faculty Room</option>
                                <option value="Laboratory">Laboratory</option>
                                <option value="Computer Lab">Computer Lab</option>
                                <option value="Auditorium">Auditorium</option>
                                <option value="Cafeteria">Cafeteria</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a room type.
                            </div>
                        </div>

                        <h4>Capacity at Grade Level Assignment</h4>
                        <div class="mb-3">
                            <label for="max_capacity" class="form-label">Maximum Capacity</label>
                            <input type="number" class="form-control" id="max_capacity" name="max_capacity" min="0" required>
                            <div class="form-text">
                                e.g., 25 students for Pre-School, 40 for Elementary
                            </div>
                            <div class="invalid-feedback">
                                Please enter a valid capacity.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="grade_level" class="form-label">Grade Level Assigned</label>
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
                                <option value="Multi-Level">Multi-Level</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a grade level.
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

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Room Management</h1>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link active" id="addRoomTab" data-bs-toggle="tab" data-bs-target="#add-room-tab"
                            type="button" role="tab" aria-controls="add-room-tab" aria-selected="true">Add Room</button>
                    </li>
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link" id="showRoomTab" data-bs-toggle="tab" data-bs-target="#show-room-tab"
                            type="button" role="tab" aria-controls="show-room-tab" aria-selected="false">Show Rooms</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="add-room-tab" role="tabpanel" aria-labelledby="add-room-tab" tabindex="0">
                        <br>
                        <div class="header">
                            <i class='bx bx-building'></i>
                            <h3>Room Management</h3>
                            <div class="student-btns">
                                <div class="student-btns">
                                    <div class="dropdown dropdown-center">
                                        <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                            <i class='bx bx-filter'></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" id="add_room_dropdown" data-bs-toggle="modal" data-bs-target="#addRoomModal">Add Room</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="container add-remove">
                            <ul class="insights">
                                <a class="addlink" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                                    <li class="additem">
                                        <i class='bx bxs-building'></i>
                                        <span class="info">
                                            <h3>Add</h3>
                                            <h3>Room</h3>
                                        </span>
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <hr>
                    </div>

                    <div class="tab-pane" id="show-room-tab" role="tabpanel" aria-labelledby="show-room-tab" tabindex="0">
                        <div class="showAttendence">
                            <div class="container">
                                <br>
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-list-ul'></i>
                                        <h3>Room List</h3>
                                        <div class="_flex-container">
                                            <input class="form-control me-2" type="search" placeholder="Search" style="max-width: 225px;height: 40px;" id="search-room-name"
                                                aria-label="Search">
                                            <button class="btn btn-success" type="button" id="searchRoomByNameBtn" disabled><i class='bx bx-search-alt'></i></button>
                                        </div>
                                    </div>
                                    <hr class="text-danger">
                                    <div class="students-table">
                                        <table class="remove-cursor-pointer">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="thead col-1">#</th>
                                                    <th scope="col" class="thead col-2">Room Name/Number</th>
                                                    <th scope="col" class="thead col-2">Building</th>
                                                    <th scope="col" class="thead col-1">Floor</th>
                                                    <th scope="col" class="thead col-2">Room Type</th>
                                                    <th scope="col" class="thead col-1">Capacity</th>
                                                    <th scope="col" class="thead col-2">Grade Level</th>
                                                    <th scope="col" class="thead col-2">Status</th>
                                                    <th scope="col" class="thead col-2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="room-table-body">
                                                <!-- content come form database -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="roomDataNotAvailable">
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
                                        <button type="button" class="btn btn-secondary" id="prev-room-page-btn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true" id="room-page-number">1</a>
                                        <button type="button" class="btn btn-secondary" id="next-room-page-btn">next</button>
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

<script src="../assets/js/rooms.js"></script>
<?php include('partials/_footer.php'); ?>