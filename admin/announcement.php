<?php
session_start();
date_default_timezone_set('Asia/Manila');
$student_id = $_SESSION["username"];
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
    <link rel="stylesheet" href="../src/css/admin/announcement.css">
    <title>Admin</title>
    <style>
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
            width: 300px;
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

        .nav-item [name="announcement"] {
        border-radius: 8px;
        margin-bottom: 4px;
        background-color: rgba(82, 110, 72, 1);
        color: white;

        }

        .nav-item [name="announcement"]:hover {
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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
<div class="container-fluid">
    <div class="main-container">
    <div class="sidebar-container">
                <div class="sidebar-content">
                    <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                       <img src="../src/images/large_logo.png" class="img-fluid" alt="...">

                    </a>
                    <h3 style="margin-left: 1rem;">Admin Portal</h3>
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
                            <a href="register.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement" name="register">
                                <i class="bi bi-list-ul fs-5"></i> Register
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
          <div class="container-xxl">
            <h1>Announcement</h1>
            <hr> 
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" role="button"> Create Announcement</a>
           


              <div class="" style="width: 100%; margin-top: 1rem;">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title"> History </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <br>
                                    <thead>
                                         <th>No</th>
                                        <th>Description</th>
                                         <th>Action</th>
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



         <!-- modal -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
    <form action= "" method = "POST">
     <div class="mb-3">
        <label for="message-text" class="col-form-label">Content:</label>
         <textarea class="form-control" placeholder="Enter your contents Here" id="message-text" name="content" required></textarea>
         </div>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 <input type="submit" class="btn btn-primary" name="submit" value="Announce!">
         </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {


      var dataTable = $('table').DataTable({
        "ajax": "get_announce.php", // URL to server-side script that returns JSON data
        
        "columns": [
             {
            "data": "total" 
          },
           {
            "data": "description" 
          },

            {
            "data": "id" ,
            "render": function(data, type, full, meta) {
                return ' <a class="btn btn-danger" href="delete_announce.php?delete='+data+'"  role="button"> <i class="bi bi-trash3-fill"> </i></a> ';
            }
          },
          

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

<?php
if(isset($_POST['submit'])){

    $content = $_POST['content'];
$date_created = date('Y-m-d H:i:s');
$date_updated = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO `announcement`(`description`, `date_time_created`, `date_time_updated`) 
                        VALUES (?,?,?)");

if($stmt){
$stmt->bind_param("sss",$content,$date_created,$date_updated);
$stmt->execute();
 echo "<script>alert('Sucessfully announce');</script>";

}




}



?> 