<?php include('partials/_header.php') ?>

<!-- Add Payment Modal -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPaymentLabel">Student Payment Transaction</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="payment-form" novalidate>
                <div class="modal-body">
                    <div class="container">
                        <!-- Student Information Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Impormasyon ng Estudyante</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="student_id" class="form-label">Student ID</label>
                                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                                            <div class="invalid-feedback">
                                                Please enter student ID.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                                            <div class="invalid-feedback">
                                                Please enter full name.
                                            </div>
                                        </div>
                                    </div>
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
                                                Please select grade level.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="section" class="form-label">Section</label>
                                            <input type="text" class="form-control" id="section" name="section" required>
                                            <div class="invalid-feedback">
                                                Please enter section.
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
                                                Please select school year.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="payment_mode" class="form-label">Mode of Payment</label>
                                            <select class="form-select" id="payment_mode" name="payment_mode" required>
                                                <option value="" disabled selected>--Select Payment Mode--</option>
                                                <option value="Full Payment">Full Payment</option>
                                                <option value="Installment">Installment</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select payment mode.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fees & Charges Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">Bayarin (Fees & Charges)</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="tuition_fee" class="form-label">Tuition Fee</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="tuition_fee" name="tuition_fee" min="0" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter tuition fee.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="miscellaneous" class="form-label">Miscellaneous Fees</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="miscellaneous" name="miscellaneous" min="0" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter miscellaneous fees.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="other_fees" class="form-label">Other Fees</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="other_fees" name="other_fees" min="0" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter other fees.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount" class="form-label">Discounts / Scholarships</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="discount" name="discount" min="0">
                                            </div>
                                            <div class="form-text">
                                                Optional field - Enter if applicable
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="total_amount" class="form-label">Total Payable Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="total_amount" name="total_amount" min="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Transaction Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0">Impormasyon ng Payment Transaction</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="payment_id" class="form-label">Payment ID</label>
                                            <input type="text" class="form-control" id="payment_id" name="payment_id" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="payment_date" class="form-label">Payment Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required>
                                            <div class="invalid-feedback">
                                                Please select payment date and time.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="amount_paid" class="form-label">Amount Paid</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="amount_paid" name="amount_paid" min="0" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter amount paid.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="balance" class="form-label">Balance</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" id="balance" name="balance" min="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="payment_method" class="form-label">Payment Method</label>
                                            <select class="form-select" id="payment_method" name="payment_method" required>
                                                <option value="" disabled selected>--Select Payment Method--</option>
                                                <option value="Cash">Cash</option>
                                                <option value="GCash">GCash</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select payment method.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="reference_number" class="form-label">Reference Number</label>
                                            <input type="text" class="form-control" id="reference_number" name="reference_number">
                                            <div class="form-text">
                                                Optional field - For online payments
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="received_by" class="form-label">Received By</label>
                                            <select class="form-select" id="received_by" name="received_by" required>
                                                <option value="" disabled selected>--Select Cashier--</option>
                                                <?php
                                                // This would typically come from your database
                                                $cashiers = [
                                                    "Cashier 1", "Cashier 2", "Cashier 3"
                                                ];
                                                foreach ($cashiers as $cashier) {
                                                    echo "<option value='$cashier'>$cashier</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select cashier.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Receipt & Payment History Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-white">
                                <h4 class="mb-0">Resibo at History ng Bayarin</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="receipt_number" class="form-label">Receipt Number</label>
                                            <input type="text" class="form-control" id="receipt_number" name="receipt_number" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="receipt_date" class="form-label">Date of Receipt Issued</label>
                                            <input type="datetime-local" class="form-control" id="receipt_date" name="receipt_date" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="fees_breakdown" class="form-label">Breakdown of Fees</label>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Fee Type</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fees_breakdown_table">
                                                    <!-- Fees breakdown will be populated by JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="payment_history" class="form-label">Previous Payment Records</label>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Payment Method</th>
                                                        <th>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="payment_history_table">
                                                    <!-- Payment history will be populated by JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Process Payment</button>
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
                <h1>Payment Management System</h1>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link active" id="addPaymentTab" data-bs-toggle="tab" data-bs-target="#add-payment-tab"
                            type="button" role="tab" aria-controls="add-payment-tab" aria-selected="true">Process Payment</button>
                    </li>
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link" id="viewPaymentsTab" data-bs-toggle="tab" data-bs-target="#view-payments-tab"
                            type="button" role="tab" aria-controls="view-payments-tab" aria-selected="false">View Payments</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="add-payment-tab" role="tabpanel" aria-labelledby="add-payment-tab" tabindex="0">
                        <br>
                        <div class="header">
                            <i class='bx bx-money'></i>
                            <h3>Process Student Payment</h3>
                            <div class="student-btns">
                                <div class="student-btns">
                                    <div class="dropdown dropdown-center">
                                        <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                            <i class='bx bx-filter'></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" id="add_payment_dropdown" data-bs-toggle="modal" data-bs-target="#addPaymentModal">Process Payment</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="container add-remove">
                            <ul class="insights">
                                <a class="addlink" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                                    <li class="additem">
                                        <i class='bx bxs-money'></i>
                                        <span class="info">
                                            <h3>Process</h3>
                                            <h3>Payment</h3>
                                        </span>
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <hr>
                    </div>

                    <div class="tab-pane" id="view-payments-tab" role="tabpanel" aria-labelledby="view-payments-tab" tabindex="0">
                        <div class="showAttendence">
                            <div class="container">
                                <br>
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-list-ul'></i>
                                        <h3>Payment Transactions List</h3>
                                        <div class="_flex-container">
                                            <input class="form-control me-2" type="search" placeholder="Search" style="max-width: 225px;height: 40px;" id="search-payment-name"
                                                aria-label="Search">
                                            <button class="btn btn-success" type="button" id="searchPaymentByNameBtn" disabled><i class='bx bx-search-alt'></i></button>
                                        </div>
                                    </div>
                                    <hr class="text-danger">
                                    <div class="students-table">
                                        <table class="remove-cursor-pointer">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="thead col-1">#</th>
                                                    <th scope="col" class="thead col-2">Student ID</th>
                                                    <th scope="col" class="thead col-2">Full Name</th>
                                                    <th scope="col" class="thead col-2">Grade Level</th>
                                                    <th scope="col" class="thead col-2">Payment ID</th>
                                                    <th scope="col" class="thead col-2">Payment Date</th>
                                                    <th scope="col" class="thead col-2">Amount Paid</th>
                                                    <th scope="col" class="thead col-2">Balance</th>
                                                    <th scope="col" class="thead col-2">Payment Method</th>
                                                    <th scope="col" class="thead col-2">Status</th>
                                                    <th scope="col" class="thead col-2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="payment-table-body">
                                                <!-- content come form database -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="paymentDataNotAvailable">
                                        <div class="_flex-container box-hide">
                                            <div class="no-data-box">
                                                <div class="no-dataicon">
                                                    <i class='bx bx-data'></i>
                                                </div>
                                                <p>No Payment Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="text-danger">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary" id="prev-payment-page-btn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true" id="payment-page-number">1</a>
                                        <button type="button" class="btn btn-secondary" id="next-payment-page-btn">next</button>
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

<script src="../assets/js/payment.js"></script>
<?php include('partials/_footer.php'); ?>