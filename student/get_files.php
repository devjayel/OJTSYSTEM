<?php
session_start();
// Connect to database and fetch data
include '../include/connection.php';

 $student_id = $_SESSION['username'];



$result = mysqli_query($conn, "SELECT `id` ,`studentid`, `reqList`, `submissionDeadline`, `status`,
 ROW_NUMBER() OVER () AS total
FROM `files` WHERE studentid = '$student_id' AND status IN ('1','3','4','5','6') ");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Output data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));