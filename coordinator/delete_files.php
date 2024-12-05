<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Manila');
$username = $_SESSION["username"];
include "../include/connection.php";
include "../include/session.php";

if(isset($_GET['delete'])){
     $id = $_GET['delete'];
    $student_id = $_SESSION['studentid'];



   

     

      if (empty($_GET['delete'])) {   
        echo "
              <script type = 'text/javascript'>
         window.location = 'files.php?view=$student_id';
              </script>";
        exit();
    }

    $verify_name = "SELECT id FROM `files` WHERE id = '$id'";
    $query_name = mysqli_query($conn, $verify_name) or die(mysqli_error($conn));
    if (mysqli_num_rows($query_name) == 0) {
        echo "
              <script type = 'text/javascript'>
              window.location = 'files.php?view=$student_id';
              </script>";
        exit();
    }

    else{
        $delete_query = $conn->prepare('DELETE FROM `files` WHERE id = ?');
        $delete_query->bind_param("i",$id);
        $delete_query->execute();
        echo "<script>alert('Sucessfully Deleted');</script>";
         echo "<script type = 'text/javascript'>
              window.location = 'files.php?view=$student_id';
              </script>";
        exit();
    }

}
?>