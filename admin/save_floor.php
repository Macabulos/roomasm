<?php
include('./connection/dbcon.php');
include('./connection/session.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the floor number
    $floor_number = $conn->real_escape_string($_POST['floor_number']);

    // Validate inputs
    if (empty($floor_number)) {
        echo "<script>
            alert('Floor number is required.');
            window.history.back();
        </script>";
        exit;
    }

    // Check if the floor already exists in the database
    $sql_check = "SELECT COUNT(*) FROM floors WHERE floor_number = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $floor_number);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        // Floor already exists
        echo "<script>
            alert('Floor already exists.');
            window.history.back();
        </script>"; 
    } else {
        // Insert new floor into the database
        $sql_insert = "INSERT INTO floors (floor_number) VALUES (?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("s", $floor_number);

        if ($stmt_insert->execute()) {
            echo "<script>
                alert('Floor added successfully.');
                window.location.href = 'add_room.php'; // Optional: Redirect after success
            </script>";
        } else {
            echo "<script>
                alert('Failed to add floor. Please try again.');
                window.history.back();
            </script>";
        }

        $stmt_insert->close();
    }
}
?>