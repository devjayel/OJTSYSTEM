<?php
    session_start();
    include('../include/connection.php');
    include('../include/session.php');
date_default_timezone_set('Asia/Manila');


 $query = 'SELECT `description` FROM `announcement`  
ORDER BY id DESC 
LIMIT 1' ;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_of_rows = $result->num_rows;
    $row = $result->fetch_assoc();
    if($num_of_rows > 0){
        echo '<pclass="card-title>' . $row['description'] . ' </p>';
    }
    else{
        echo 'No Announcement';
    }
   
?>