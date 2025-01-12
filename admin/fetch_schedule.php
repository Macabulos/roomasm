<?php
$sql_fetch = "
SELECT
    floors.floor_number AS floor_number,
    rooms.room_name AS room_name,
    schedules.day_of_week AS day_of_week,
    schedules.start_time AS start_time,
    schedules.end_time AS end_time,
    subjects.subject_name AS subject_name,
    teaching_faculty_information.first_name AS first_name,
    teaching_faculty_information.last_name AS last_name,
    schedules.schedule_id AS schedule_id
FROM schedules
INNER JOIN floors ON schedules.floor_id = floors.floor_id
INNER JOIN rooms ON schedules.room_id = rooms.room_id
INNER JOIN subjects ON schedules.subject_id = subjects.subject_id
INNER JOIN teaching_faculty_information ON schedules.id = teaching_faculty_information.id
ORDER BY schedules.day_of_week, schedules.start_time";

$result = $conn->query($sql_fetch);

if (!$result) {
    die("Error: " . $conn->error);
}
?>
