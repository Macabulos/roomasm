<?php
// Connect to the database  
include('./connection/dbcon.php');

// Fetch subjects for the selected teacher
$sql = "SELECT subject_code FROM subjects";
$result = $conn->query($sql);  // Fixed the query execution

// Initialize the option string
$option = "";

// Check if subjects are available
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  // Corrected fetch_assoc() usage
        $option .= "<option value='" . $row["subject_code"] . "'>" . $row["subject_code"] . "</option>";  // Concatenate option tags correctly
    }
} else {
    $option = "<option>No subjects available</option>";  // If no subjects, display a message
}

$conn->close();

// Output the options (you can echo this variable to use it in the HTML)
echo $option;
?>
