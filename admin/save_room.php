a<?php
include('./connection/dbcon.php');
include('./connection/session.php');


// Fetch floors from the database
$sql = "SELECT * FROM floors";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize room details
    $floor_id = intval($_POST['floor_id']);
    $room_name = $conn->real_escape_string($_POST['room_name']);

    // Validate inputs
    if (empty($floor_id) || empty($room_name)) {
        echo json_encode(["status" => "error", "message" => "Floor ID and room name are required."]);
        exit;
    }

    // Check if the floor exists
    $sql_check_floor = "SELECT * FROM floors WHERE floor_id = ?";
    $stmt_check = $conn->prepare($sql_check_floor);
    $stmt_check->bind_param("i", $floor_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "The specified floor does not exist."]);
        exit;
    }

    // Check if the room already exists for the specified floor
    $sql_check_room = "SELECT * FROM rooms WHERE room_name = ? AND floor_id = ?";
    $stmt_check_room = $conn->prepare($sql_check_room);
    $stmt_check_room->bind_param("si", $room_name, $floor_id);
    $stmt_check_room->execute();
    $result_check_room = $stmt_check_room->get_result();

    if ($result_check_room->num_rows > 0) {
        // Room already exists for this floor
        echo "<script>
        alert('The room already exists on this floor.');
        window.location.href = 'add_room.php'; // Optional: Redirect after success
    </script>";
        exit;
    }

    // Insert new room into the database
    $sql_insert = "INSERT INTO rooms (room_name, floor_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("si", $room_name, $floor_id);

    if ($stmt->execute()) {
        echo "<script>
        alert('Room added successfully.');
        window.location.href = 'add_room.php'; // Optional: Redirect after success
    </script>";
    } else {
        echo "<script>
        alert('Failed to add room. Please try again.');
        window.history.back(); // Optional: Redirect back to the previous page
    </script>";
    }

    $stmt->close();
}
?>