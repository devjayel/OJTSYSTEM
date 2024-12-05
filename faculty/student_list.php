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

    <title>FACULTY</title><style>
         body{
            margin : 0;
            border: 0
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
            width: 400px;
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

        .nav-item [name="student-list"] {
        border-radius: 8px;
        margin-bottom: 4px;
        background-color: rgba(82, 110, 72, 1);
        color: white;

        }

        .nav-item [name="student-list"]:hover {
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
</head>
<body>
      <script src="https://code.jquery.com/jquery-3.7.0.js" ></script>
    <div class="container-fluid">
    <div class="row">
    <div class="sidebar-container">
                <div class="sidebar-content">
                    <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <img src="../src/images/large_logo.png" class="img-fluid" alt="..." style="width:300px;height:100px;">


                    </a>
                    <h3 style="margin-left: 1rem;">Faculty Portal</h3>
                    <br>
                    <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3"
                        style="align-items:start; text-align:left;">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Dashboard" >
                                <i class="bi bi-house-fill fs-5"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_list.php" class="nav-link " title="" data-bs-toggle="tooltip" name="student-list"
                                data-bs-placement="right" data-bs-original-title="Student List">
                                <i class="bi bi-folder-fill fs-5"></i> Student List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="announcement.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement" name="announcement">
                                <i class="bi bi-clock-fill fs-5"></i> Announcement
                            </a>
                        </li>
                       

                        <li class="nav-item">
                            <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement" name="settings">
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