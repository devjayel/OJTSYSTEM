<?php
session_start();

if (!isset($_SESSION["username"])) {
    die('Session username is not set.');
}

$student_id = $_SESSION["username"];
include('../include/connection.php');
include('../include/session.php');

date_default_timezone_set('Asia/Manila');

$query = 'SELECT * FROM `studentinfo`
LEFT JOIN status ON studentinfo.status = status.id 
WHERE studentinfo.studentid = ?';

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_id); 
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();

if ($row) {
    if ($row['id'] == 1) {
        echo '<span class="badge rounded-pill text-bg-secondary">'.$row['status'].'</span>';
    } elseif ($row['id'] == 2) {
        echo '<span class="badge rounded-pill text-bg-danger">'.$row['status'].'</span>';
    } elseif ($row['id'] == 3) {
        echo '<span class="badge rounded-pill text-bg-danger">'.$row['status'].'</span>';
    } elseif ($row['id'] == 4) {
        echo '<span class="badge rounded-pill text-bg-success">'.$row['status'].'</span>';
    } elseif ($row['id'] == 5) {
        echo '<span class="badge rounded-pill text-bg-info">'.$row['status'].'</span>';
    } elseif ($row['id'] == 6) {
        echo '<span class="badge rounded-pill text-bg-success">'.$row['status'].'</span>';
    }
} else {
    echo 'No matching record found for the student.';
}
?>
