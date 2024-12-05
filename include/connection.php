<?php 
    $conn = new mysqli  ("localhost","root","","monitoringdb");
    if ($conn==false) {
        echo"error".$conn->error;
    }
?>