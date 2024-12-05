<?php
session_start();
date_default_timezone_set('Asia/Manila');
$username= $_SESSION["username"];
include "../include/connection.php";
include "../include/session.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/css/admin/studentListStyle.css">

    <title>COORDINATOR</title>
</head>
<body>
      <script src="https://code.jquery.com/jquery-3.7.0.js" ></script>
      <div class="container-fluid">
    <div class="row">
        <div class="col-sm-auto bg-white sticky-top shadow">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-white align-items-center sticky-top">
                <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                   <img src="../src/images/ntclogo.PNG" class="img-fluid" alt="...">
                </a>
                <h3> Coordinator Portal</h3>
                            <br>
                    <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3" style = "align-items:start; text-align:left;">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard" name="dashboard">
                            <i class="bi bi-house-fill fs-3"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_list.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Student List" name="studentlist">
                            <i class="bi bi-person-lines-fill fs-3"></i> Student List
                            </a>
                        </li>
                        <li>
                            <a href="announcement.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="announcement">
                            <i class="bi bi-megaphone-fill fs-3"></i> Announcement
                            </a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="register.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="register">
                            <i class="bi bi-person-fill-add fs-3"></i> Register
                            </a>
                        </li>-->

                        <li>
                            <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="settings">
                            <i class="bi bi-gear-fill fs-3"></i> Settings
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
        <div class="col-sm p-3 min-vh-100">
            <!-- content -->
          <div class="row container-xxl">
             <h1>Student List</h1>
            <hr> 
            
            <table id="table" class="col-md-6 table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                  <th scope="col">College</th>
                  <th scope="col">Year & Program</th>
                  
               

                </tr>
            </thead>
            <tbody>
              

            </tbody>

            </table>
            </div>        
        </div>
    </div>
</div>


 


<!-- table -->
<script type="text/javascript">
    $(document).ready(function() {


      var dataTable = $('table').DataTable({
        "ajax": "get_student.php", // URL to server-side script that returns JSON data
        
        "columns": [
             {
            "data": "total" 
          },
            {
            "data": "image",
            "render": function(data, type, full, meta) {
              return '<img src="../student/image/' + data + '" width="150" height="150">';
            }

          },
          {
            "data": "studentid" 
          },
          {
            data: function ( row, type, set ) {
                return row.firstName + " " + row.lastName;
            
          }
          
        },

        {
            "data": "college"
          },

           {
            "data": "yearProg"
          }


        ],

        


        "rowCallback": function(row, data, index) {
          $(row).on('click', function() {
            window.location.href = 'view_student.php?view=' + data.studentid;
          });
        },




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

 <!-- javascript -->





    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       

</body>


</html>