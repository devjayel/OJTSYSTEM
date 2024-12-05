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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../src/css/student/studIndexStyle.css">
    
    <style>
        body {
            border : 0;
            margin : 0;
        }

  
        .bg-tet {
            height: 40vh;
            background: rgb(5, 27, 17);
            background: linear-gradient(90deg, rgba(5, 27, 17, 1) 33%, rgba(38, 118, 81, 1) 97%);
        }

        .banner {
         
            border-radius: 1rem;
            width: 100%;
            height : 300px;
            position: relative;

        }

        .image-container{
            width: 100%;
            height: 100%;
            top:0;
            border-radius: 1rem;

            z-index: 0;
            position: absolute;
        }
        .image-component{
            object-fit: cover;
            width: 100%;
            height: 100%;
            z-index: -10;
            border-radius: 1rem;

        }

        .banner-content{
            height: 100%;
            position: relative;
            background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,121,33,0.9836309523809523) 51%, rgba(0,212,255,0) 100%);
            z-index: 10;
            border-radius: 1rem;

        }


        .main-container{
            width: 100%;
            display: flex;
        }

        .content-container {
            display: flex;
            flex-direction : column;
            width: 100%;
            padding: 1rem;
        }

        .content-card{
            width: 500px;
        }

        .card-container {
            width: 100%;
            
            align-items: center;
            gap: 1rem;
            display : flex;
        }
     
        .sidebar-container {
            width: 500px;
            height: 200vh;
            -webkit-box-shadow: 3px 3px 5px 1px #F2F2F2;
            box-shadow: 3px 3px 5px 1px #F2F2F2;
         
        }
        .sidebar-content{
            position: relative;
            height: 100%
        }
        .sidebar-footer{
            position: fixed;
            bottom: 1rem;
        }

        /* Bootstrap Override*/
        
        .nav-link {
        padding: 10px;
        text-decoration: none;
        color: #000;
        display: block;
        font-weight: bold;
        }

        .nav-link:hover {
        background-color: #62825D;
        border-radius: 8px;
        color: white;
        }

        .nav-item [name="dashboard"] {
        border-radius: 8px;
        margin-bottom: 4px;
        background-color: rgba(82, 110, 72, 1);
        color: white;

        }

        .nav-item [name="dashboard"]:hover {
        border-radius: 8px;

        background-color: #62825D;
        color: rgb(255, 255, 255);

        }

        .btn {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: rgba(82, 110, 72, 1);
        color: white;
        transition: background-color 0.3s;/
        }

        .btn:hover {
        background-color: #62825D;
        color: white;
        }

        .btn-primary {
        cursor: not-allowed;

        }

        .container {
        height: 150px;
        /* Set a fixed height for the container */
        overflow: auto;
        /* Enable vertical scroll when content exceeds the height */
        }
     
    </style>

    <title>OJT MONITORING SYSTEM</title>
</head>

<body>


    <div style="width: 100%">
        <div class="main-container">
            <div class="sidebar-container">
                <div class="sidebar-content">
                    <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <img src="../src/images/large_logo.PNG" class="img-fluid" alt="..."
                            style="width:300px;height:100px;">
                    </a>
                    <h3 style="margin-left: 1rem;">Student Portal</h3>
                    <br>
                    <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3"
                        style="align-items:start; text-align:left;">
                        <li class="nav-item">
                            <a href="index.php" class="btn" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Dashboard" name="dashboard">
                                <i class="bi bi-house-fill fs-5"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="files.php" class="nav-link " title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Student List">
                                <i class="bi bi-folder-fill fs-5"></i> Files
                            </a>
                        </li>
                        <li>
                            <a href="attendance.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement">
                                <i class="bi bi-clock-fill fs-5"></i> Attendance
                            </a>
                        </li>
                        <li>
                            <a href="activity.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement">
                                <i class="bi bi-list-ul fs-5"></i> Activity
                            </a>
                        </li>

                        <li>
                            <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement">
                                <i class="bi bi-gear-fill fs-5"></i> Settings
                            </a>
                        </li>
                        <br>
                        <div class="sidebar-footer">
                        <li>
                      
                            <a href="../include/logout.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement">
                                <i class="bi bi-box-arrow-left fs-5" style="padding-right:10px; "></i>Logout
                            </a>
                        </li>
                        </div>
                    </ul>
                </div>
            </div>

            <div class="content-container">
                <div class="banner">
                    <div class="text-light  rounded-5 " style="z-index:1">
                        <div class="banner-content" >
                            <div class="col d-flex align-items-start flex-column mb-3 " >
                                <span class="text-secondary fs-5 mt-5 ms-5 mb-auto" id="current-date"></span>
                                <p id="welcome-message" class="welcome-cont fs-1 fw-bold mb-0 ms-5"></p>
                                <p class="mt-0 fs-5 text-secondary ms-5 mb-5 ">Always stay updated in your student
                                    portal</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="image-container" >
                                    <img class="image-component" src="./image/udmm.jpg" alt="">
                                </div>
                </div>

                <hr>
                <div style="margin-bottom: 1rem;">
                <a class="btn btn-primary" style="cursor: pointer" href="studProfile.php" role="button">Profile</a>
                </div>

                <div class="card-container" >
                    <div class="content-card" >
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-lightbulb fs-4"></i> <span style="font-size:1.5rem;">Announcement</span>
                                <hr>
                                <div class="container" id="announcement"></div>
                            </div>
                        </div>
                    </div>
                    <div class="content-card" >
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-lightbulb fs-4"></i> <span style="font-size:1.5rem;">Student
                                    Status</span>
                                <hr>
                                <h4>HTE STATUS:</h4>
                                <div class="container" id="status" style="height: 112px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" " style="margin-top: 1rem">
                    <div class="card">
                        <div class="col-sm-auto bg-white sticky-top shadow" style="padding: 1rem">
                            <h5 class="card-title pt-3 px-4">Attendance Report</h5>
                            <br>
                            <div class="col-md-5 offset-md-4">
                                <canvas id="myDoughnutChart"></canvas>
                            </div>
                            <!--   <div class="col-md-5">
                                    <div class="card-body" >
                                        <i class="bi bi-dot align-middle" style = "color:black; font-size:2rem;"></i> <span>Total Hours:</span>  <span>9</span>
                                        <br>
                                        <i class="bi bi-dot align-middle" style = "color:black; font-size:2rem;"></i> <span>Total Hours to Complete:</span> <span>480 HRS</span>
                                    </div>
                                </div>   -->
                        </div>
                    </div>





                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


            <!-- Script for getting current date -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const dateElement = document.getElementById("current-date");
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    const currentDate = new Date().toLocaleDateString(undefined, options);
                    dateElement.textContent = `${currentDate}`;
                });
            </script>


            <!-- Script for getting the username -->
            <script>
                // Retrieve the firstName from localStorage
                const firstName = localStorage.getItem('firstName');

                // Check if firstName exists in localStorage
                if (firstName) {
                    // Find the element where you want to insert the firstName
                    const welcomeMessage = document.querySelector('#welcome-message');

                    // Insert the firstName into the element
                    if (welcomeMessage) {
                        welcomeMessage.textContent = `Welcome back, ${firstName}!`;
                    }
                }
            </script>


            <script>
                // Get the canvas context
                var ctx = document.getElementById('myDoughnutChart').getContext('2d');

                // Initial data for the chart
                var initialData = {
                    labels: ['# Total of hours', ' # Total of hours to complete'],
                    datasets: [{
                        data: [],
                        backgroundColor: ["#FF6384", "#36A2EB",],
                    }]
                };

                // Create the initial doughnut chart
                var myDoughnutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: initialData,
                });

                // Function to update the chart data
                function updateChartData() {
                    // Fetch data from the PHP script using AJAX
                    $.ajax({
                        url: 'real_attendance.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Update the chart data
                            myDoughnutChart.data.datasets[0].data = [data.total, data.diff];
                            // Update the chart
                            myDoughnutChart.update();
                        },
                        error: function (error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }

                // Update the chart data every 5 seconds (adjust as needed)
                setInterval(updateChartData, 1000);
            </script>

            <script>
                $(document).ready(function () {
                    function getData() {
                        $.ajax({
                            type: 'POST',
                            url: 'real_announcement.php',
                            success: function (data) {
                                $('#announcement').html(data);
                            }
                        });
                    }
                    getData();
                    setInterval(function () {
                        getData();
                    }, 1000); // it will refresh your data every 1 sec

                });
            </script>


            <script>
                $(document).ready(function () {
                    function getData() {
                        $.ajax({
                            type: 'POST',
                            url: 'real_status.php',
                            success: function (data) {
                                $('#status').html(data);
                            }
                        });
                    }
                    getData();
                    setInterval(function () {
                        getData();
                    }, 1000); // it will refresh your data every 1 sec

                });
            </script>

</body>

</html>