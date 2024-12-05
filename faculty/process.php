<?php
session_start();
date_default_timezone_set('Asia/Manila');
$username= $_SESSION["username"];
include "../include/connection.php";
include "../include/session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected option from the form
    $selectedOption = $_POST['selectOption'];
    $student_id = $_POST['studentid'];

   

    // Insert the selected option into the database
    $sql = "UPDATE `studentinfo` SET `status` = '$selectedOption' WHERE studentid = '$student_id' ";
    
    if (mysqli_query($conn, $sql)) {
         echo "
              <script type = 'text/javascript'>
              window.location = 'view_student.php?view=$student_id';
              </script>";
        exit();
      
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



?>