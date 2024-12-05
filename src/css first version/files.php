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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/studFilesStyle.css">
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
        <button class="Req-button">Requirements</button>
        <div class="reqlist-container">
                <h2>Requirements List</h2>
                <form action="/search" method="get">
                 <input type="text" name="query" placeholder="Search...">
                </form>
                <hr></hr>
                <div class="req-list1">
                    <a href="req-list1-content.php">Memorandum Of Agreement</a>
                    <h5>Example Date</h5>
                    <label name="status">Status</label>
                </div>
                <div class="req-list2">
                    <a href="#MOA">Memorandum Of Agreement</a>
                    <h5>Example Date</h5>
                    <label name="status">Status</label>
                </div>
                <div class="req-list3">
                    <a href="#MOA">Memorandum Of Agreement</a>
                    <label name="status">Status</label>
                    <h5>Example Date</h5>
                </div>
                <div class="req-list4">
                    <a href="#MOA">Memorandum Of Agreement</a>
                    <h5>Example Date</h5>
                    <label name="status">Status</label>
                </div>
                <div class="req-list5">
                    <a href="#MOA">Memorandum Of Agreement</a>
                    <h5>Example Date</h5>
                    <label name="status">Status</label>
                </div>
            </div>
    
    </div>
</body>
</html>