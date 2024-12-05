<?php

ob_start();
session_start();
date_default_timezone_set('Asia/Manila');
include "../include/connection.php";
include "../include/session.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
 


 if (empty($_GET['id'])) {   
        echo "
              <script type = 'text/javascript'>
         window.location = 'announcement.php';
              </script>";
        exit();
    }

    
    $verify_name = "SELECT id FROM `announcement` WHERE id = '$id'";
    $query_name = mysqli_query($conn, $verify_name) or die(mysqli_error($conn));
    if (mysqli_num_rows($query_name) == 0) {
        echo "
              <script type = 'text/javascript'>
              window.location = 'announcement.php';
              </script>";
        exit();
    }

    else{
          $update_status = $conn->prepare("DELETE FROM `announcement` WHERE id = ?");
                $update_status->bind_param("i",$id);
                $update_status->execute();

         echo "<script>alert('Sucessfully Deleted')</script>";
        echo "
              <script type = 'text/javascript'>
       window.location = 'announcement.php';
              </script>";
        exit();
    }

}

?>