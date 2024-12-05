<?php
session_start();
// Connect to database and fetch data
include '../include/connection.php';

 $student_id = $_SESSION['studentid'];



$result = mysqli_query($conn, "SELECT `id` ,`studentid`, `reqList`, `submissionDeadline`, `status`,`subform`,
 ROW_NUMBER() OVER () AS total
FROM `files` WHERE studentid = '$student_id' ");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Output data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));