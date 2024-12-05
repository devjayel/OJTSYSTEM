<?php 
session_start();
$student_id = $_SESSION["username"];
date_default_timezone_set('Asia/Manila');
include "../include/connection.php";
include "../include/session.php";

?>
<html lang="en">
<head>
<meta name="viewport" content="width=1024">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/css/student/studTimesheetStyle.css">

    <title>OJT MONITORING SYSTEM</title>
</head>
<body>
 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!--sidebar-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-auto bg-white sticky-top shadow">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-white align-items-center sticky-top">
                <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                <img src="../src/images/large_logo.PNG" class="img-fluid" alt="..." style="width:300px;height:100px;">
                </a>
                        <h3>Student Portal</h3>
                        <br>
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3" style = "align-items:start; text-align:left;">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard" name="dashboard">
                           <i class="bi bi-house-fill fs-5"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="files.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Student List" name="files">
                         <i class="bi bi-folder-fill fs-5"></i> Files
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="attendance.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="attendance">
                           <i class="bi bi-clock-fill fs-5"></i> Attendance
                        </a>
                    </li>
                    <li>
                        <a href="activity.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement">
                           <i class="bi bi-list-ul fs-5"></i> Activity
                        </a>
                    </li>

                    <li>
                        <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement">
                           <i class="bi bi-gear-fill fs-5"></i> Settings
                        </a>
                    </li>
                        <br>
                    <li>
                        <hr>
                        <a href="../include/logout.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement">
                           <i class="bi bi-box-arrow-left fs-55" style = "padding-right:10px; "></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class=" row col-sm p-3 min-vh-100">
            <div class="container-xxl">
                <h1>TIMESHEET</h1>
                <hr>
                <a class="btn btn-primary" role="button" href="attendance.php">My Attendance</a>
                <a class="btn btn-secondary" role="button">Timesheet</a> 
            </div>
               <div class="row pt-1 px-3">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title"> Timesheet </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>No</th>
                                        <th style="width:150px">DATE</th>
                                        <th>DAY</th>
                                        <th style="width:150px">IN</th>
                                        <th>OUT</th>
                                        <th>HOURS</th>
                                        <th>LOCATION</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>

</div>



        
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- datatable -->
<script type="text/javascript">
    $(document).ready(function() {


      var dataTable = $('table').DataTable({
        "ajax": "get_attendance.php", // URL to server-side script that returns JSON data
        
        "columns": [
            {
                "data": "total"
            },

         {
            "data": "date"
                
        },

         {
                "data": "day"
            },

             {
                data: function ( row, type, set ) {
              const timeString = row.clockIn;
                    // Prepend any date. Use your birthday.
                    const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
                    .toLocaleTimeString('en-US',
                        {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                    );
                    
                    return timeString12hr;
          }
            },
          { data: function ( row, type, set ) {

            if(row.clockOut == '00:00:00.000000'){
                return '00:00:00.000000';
            }

            else{
                 const timeString = row.clockOut;
                    // Prepend any date. Use your birthday.
                    const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
                    .toLocaleTimeString('en-US',
                        {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                    );
                    
                    return timeString12hr;
            }

             
          }
            },
            {
                "data":"totalHrs"
            },
            {
                "data":"location"
            }
          

        ],

        


        // "rowCallback": function(row, data, index) {
        //   $(row).on('click', function() {
        //     window.location.href = 'view_student.php?view=' + data.studentid;
        //   });
        // },




        lengthMenu: [
          [10, 20, 50, -1],
          [10, 20, 50, 'All'],
        ],
      });

       




      $('.dataTables_filter input').attr('maxLength', 16),
        setInterval(function() {
          dataTable.ajax.reload(null, false); // Reload table data every 5 seconds
        }, 5000);
    });


  </script>






</body>
</html> 