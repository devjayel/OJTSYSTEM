<?php
session_start();
$student_id = $_SESSION["username"];
include "../include/session.php";
// Connect to database and fetch data
include '../include/connection.php';


$result = mysqli_query($conn, "SELECT `studentid`, `date`, `file`, `details`, `dateTimeCreated`,
 ROW_NUMBER() OVER () AS total
FROM `activity` 
WHERE `studentid` = '$student_id'");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Output data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));