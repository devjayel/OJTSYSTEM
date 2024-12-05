<?php
// Connect to database and fetch data
session_start();
$student_id = $_SESSION["username"];

include '../include/connection.php';


$result = mysqli_query($conn, "SELECT `date`, `day`, `clockIn`, `clockOut`,`totalHrs`, `location`,
 ROW_NUMBER() OVER () AS total
FROM `attendance` WHERE `studentid`= '$student_id' ");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Output data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));