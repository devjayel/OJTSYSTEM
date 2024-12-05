<?php
// Connect to database and fetch data
session_start();
$student_id = $_SESSION["username"];

include '../include/connection.php';

$sql = $conn->query("SELECT * ,sum(totalHrs) AS total,
practicuminfo.practicumHrsreq - sum(totalHrs) AS diff
FROM practicuminfo 
LEFT JOIN attendance
ON practicuminfo.studentid = attendance.studentid 
WHERE practicuminfo.studentid = '$student_id'");

foreach($sql as $data){
     $total[] = $data['total'];
     $diff[] = $data['diff'];


}

header('Content-Type: application/json');
echo json_encode(['total' => $total,'diff'=> $diff]);

?>