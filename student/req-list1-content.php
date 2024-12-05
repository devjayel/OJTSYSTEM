<?php 
session_start();
$student_id = $_SESSION["username"];
date_default_timezone_set('Asia/Manila');
include "../include/connection.php";
include "../include/session.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="stylesheet" href="../src/css/student/reqFilesStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>OJT MONITORING SYSTEM</title>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
       <img class="ntclogo" src="../src/images/ntclogo.png"></img>
       <h3>Student Portal</h3>
        <a name="dashboard" href="index.php">Dashboard</a>
        <a name="files" href="files.php">Files</a>
        <a name="attendance" href="attendance.php">Attendance</a>
        <a href="#Attendance">Progress</a>
        <a name="activity" href="activity.php">Activity</a>

        <hr></hr>
        <a class="logout" href="../include/logout.php">Logout</a>
        <!-- Add more links as needed -->
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>FILES</h2>
        <hr></hr>
        <a href="files.php" name="back"><i class="fa-solid fa-less-than"></i></i> BACK TO REQUIREMENTS</a>
        <div class="reqfiles-container">
                <h2 name="title">Memorandum of Agreement</h2>
                <div class="filecontent-container">
                <p>example of requirements container</p>
                <p>example of requirements container</p>
                <p>example of requirements container</p>
                <p>example of requirements container</p>
                <p>example of requirements container</p>
                <p>example of requirements container</p>
                <p>example of requirements container</p>
             
            </div>
        </div>
        <div class="comment-container">
             <p>example of comment container</p>
             
        </div>
    
    </div>
</body>
</html>