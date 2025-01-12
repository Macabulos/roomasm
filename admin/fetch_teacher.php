<?php
include('./connection/dbcon.php');
include('./connection/session.php');

// Handle form submission for adding subject
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $subject_name = $conn->real_escape_string($_POST['subject_name']);
    $subjectDescription = $conn->real_escape_string($_POST['subjectDescription']);
    $teacher_id = $_POST['teacher_id'];

    // Check for duplicate subject
    $check_subject_sql = "SELECT * FROM subjects WHERE subject_name = '$subject_name'";
    $subject_result = $conn->query($check_subject_sql);
    if ($subject_result->num_rows > 0) {
        echo "<script>alert('Subject already exists.'); window.location.href='add_subject.php';</script>";
        exit();
    }

    // Insert subject into database
    $sql = "INSERT INTO subjects (subject_name, SubjectDescription, teacher_id) 
            VALUES ('$subject_name', '$subjectDescription', '$teacher_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Subject added successfully!'); window.location.href='add_subject.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch teachers for the dropdown
$teachers_query = "SELECT id, CONCAT(first_name, ' ', last_name) AS TeacherName FROM teaching_faculty_information";
$teachers_result = $conn->query($teachers_query);
?>