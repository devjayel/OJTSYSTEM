<?php

ob_start();
session_start();
date_default_timezone_set('Asia/Manila');
include "../include/connection.php";
include "../include/session.php";

if(isset($_GET['approved'])){
    $id = $_GET['approved'];
    $student_id = $_SESSION['studentid'];
    $status = 3;


 if (empty($_GET['approved'])) {   
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
          $update_status = $conn->prepare("UPDATE `files` SET `status`=? WHERE id = ?");
                $update_status->bind_param("is",$status,$id);
                $update_status->execute();

         echo "<script>alert('The status has been change')</script>";
        echo "
              <script type = 'text/javascript'>
              window.location = 'files.php?view=$student_id';
              </script>";
        exit();
    }

}


 if(isset($_GET['return'])){
    $id = $_GET['return'];
    $student_id = $_SESSION['studentid'];
    $status = 4;


 if (empty($_GET['return'])) {   
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
        $update_status = $conn->prepare("UPDATE `files` SET `status`=? WHERE id = ?");
        $update_status->bind_param("is",$status,$id);
        $update_status->execute();
        echo "<script>alert('The status has been change')</script>";
       echo "
              <script type = 'text/javascript'>
              window.location = 'files.php?view=$student_id';
              </script>";
        exit();
    }

}


if(isset($_GET['assign'])){
    $id = $_GET['assign'];
    $student_id = $_SESSION['studentid'];
    $status = 5;


 if (empty($_GET['assign'])) {   
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
            $update_status = $conn->prepare("UPDATE `files` SET `status`=? WHERE id = ?");
            $update_status->bind_param("is",$status,$id);
            $update_status->execute();
        echo "<script>alert('The status has been change')</script>";
         echo "
              <script type = 'text/javascript'>
              window.location = 'files.php?view=$student_id';
              </script>";
               exit();


    }

}



   


?>