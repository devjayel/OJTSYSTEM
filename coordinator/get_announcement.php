<?php
session_start();
// Connect to database and fetch data
include '../include/connection.php';





$result = mysqli_query($conn, "SELECT `id`,`description`,
 ROW_NUMBER() OVER () AS total
FROM `announcement`");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Output data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));