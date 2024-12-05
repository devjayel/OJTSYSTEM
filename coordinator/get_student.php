<?php
// Connect to database and fetch data
include '../include/connection.php';


$result = mysqli_query($conn, "SELECT `image`, `studentid`, `lastName`, `firstName`,`college`,`yearProg`,
 ROW_NUMBER() OVER () AS total
FROM `studentinfo`");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Output data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));