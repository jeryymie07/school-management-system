<?php
include("config.php");

$response = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset($data["subject"]) && isset($data["class"])) {
        $class = $data["class"];
        $subject = $data["subject"];

        // Generate a unique subject code
        $subjectCode = strtoupper(substr($subject, 0, 3)) . uniqid();

        // Use prepared statement to check if the subject already exists
        $query = "SELECT * FROM subjects WHERE subject_code=? AND subject_name=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $subjectCode, $subject);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $response = "This subject already exists!";
        } else {
            // Use prepared statement to insert the new subject
            $sql = "INSERT INTO `subjects` (`subject_code`, `subject_name`, `grade_level_id`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $subjectCode, $subject, $class);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $response = "success";
            } else {
                $response = "Unable to add a new subject!";
            }
        }
    } else {
        $response = "Invalid request";
    }

    echo $response;
}
?>
