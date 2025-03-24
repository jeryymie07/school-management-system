<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1300px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h4 {
            background-color: #0d6efd;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        h6 {
            color: #0d6efd;
            margin-top: 15px;
        }
        .form-control {
            border-radius: 5px;
        }
        .row .col-md-6 {
            padding-right: 5px;
            padding-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h4>Student Enrollment Form</h4>
        <form action="process_enrollment.php" method="POST">
            <h6>Student Information</h6>
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="full_name" placeholder="Full Name" required></div>
                <div class="col-md-6"><input type="date" class="form-control mb-2" name="dob" required></div>
            </div>
            <div class="row">
                <div class="col-md-6"><select class="form-control mb-2" name="gender"><option>Male</option><option>Female</option></select></div>
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="student_id" placeholder="Student ID (if assigned)"></div>
            </div>
            <input type="text" class="form-control mb-2" name="address" placeholder="Address" required>
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="contact_number" placeholder="Contact Number" required></div>
                <div class="col-md-6"><input type="email" class="form-control mb-2" name="email" placeholder="Email Address" required></div>
            </div>
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="nationality" placeholder="Nationality" required></div>
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="religion" placeholder="Religion (if applicable)"></div>
            </div>
            
            <h6>Parent/Guardian Information</h6>
            <input type="text" class="form-control mb-2" name="guardian_name" placeholder="Full Name" required>
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="guardian_relationship" placeholder="Relationship to Student" required></div>
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="guardian_occupation" placeholder="Occupation"></div>
            </div>
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="guardian_contact" placeholder="Contact Number" required></div>
                <div class="col-md-6"><input type="email" class="form-control mb-2" name="guardian_email" placeholder="Email Address" required></div>
            </div>
            <input type="text" class="form-control mb-2" name="guardian_address" placeholder="Address (if different from student)">
            
            <h6>Academic Information</h6>
            <input type="text" class="form-control mb-2" name="prev_school" placeholder="Previous School Attended">
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="grade_level" placeholder="Grade Level to Enroll In" required></div>
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="section" placeholder="Section (if applicable)"></div>
            </div>
            <select class="form-control mb-2" name="student_type">
                <option>New</option>
                <option>Transferee</option>
                <option>Returning</option>
            </select>
            <input type="text" class="form-control mb-2" name="special_needs" placeholder="Special Needs or Requirements (if applicable)">
            
            <h6>Emergency Contact Information</h6>
            <input type="text" class="form-control mb-2" name="emergency_name" placeholder="Full Name" required>
            <div class="row">
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="emergency_relationship" placeholder="Relationship to Student" required></div>
                <div class="col-md-6"><input type="text" class="form-control mb-2" name="emergency_contact" placeholder="Contact Number" required></div>
            </div>
            <input type="text" class="form-control mb-2" name="emergency_address" placeholder="Address">
            
            <h6>Consent</h6>
            <p class="small">I confirm that all information provided is true.</p>
            <input type="text" class="form-control mb-2" name="signature" placeholder="Applicant Signature" required>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
