<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Manila');
$username = $_SESSION["username"];
include "../include/connection.php";
include "../include/session.php";

if(isset($_GET['view'])){
     $student_id = $_GET['view'];
     $_SESSION['studentid'] = $student_id;

     

      if (empty($_GET['view'])) {   
        echo "
              <script type = 'text/javascript'>
              window.location = 'student_list.php';
              </script>";
        exit();
    }

    $verify_name = "SELECT studentid FROM `studentinfo` WHERE studentid = '$student_id'";
    $query_name = mysqli_query($conn, $verify_name) or die(mysqli_error($conn));
    if (mysqli_num_rows($query_name) == 0) {
        echo "
              <script type = 'text/javascript'>
              window.location = 'student_list.php';
              </script>";
        exit();
    }
}

// calculating bytes 
function formatBytes($file_bytes, $precision = 2){
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;

    return round($file_bytes / $megabyte, $precision);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <link rel="stylesheet" href="../src/css/admin/filesStyle.css">
    <title>FACULTY</title>
</head>
<body>
   <script src="https://code.jquery.com/jquery-3.7.0.js"></script>


<div class="container-fluid">
    <div class="row">
            <div class="col-sm-auto bg-white sticky-top shadow">
                <div class="d-flex flex-sm-column flex-row flex-nowrap bg-white align-items-center sticky-top">
                    <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <img src="../src/images/ntclogo.PNG" class="img-fluid" alt="...">
                    </a>
                    <h3> Faculty Portal</h3>
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
                            <li class="nav-item">
                                <a href="announcement.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="announcement">
                                <i class="bi bi-megaphone-fill fs-3"></i> Announcement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="register.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="register">
                                <i class="bi bi-person-fill-add fs-3"></i> Register
                                </a>
                            </li>

                            <li class="nav-item">
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
                <h1>View Student/Files</h1>
            <hr> 
            <a class="btn btn-primary" href="view_student.php?view=<?php echo $student_id?>"  role="button">Student Information</a>
            <a class="btn btn-secondary" href="files.php?view=<?php echo $student_id ?>" role="button">Files</a>
            <div class="row pt-2 ">
                   
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                                    <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                                    <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                                </svg></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">

                                            <p class="card-category">Total Files</p>

                                            <div class="container" id="files"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-o"></i>
                                    Today
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                                    <path d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                                </svg></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Storage</p>

                                            <div class="container" id="storage"></div>

                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i>
                                    In the last hour
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- table -->


                 <div class="row pt-5">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title"> Files </h4>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Send Files
                            </button>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                         <th>No</th>
                                        <th>File Name</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
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

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Insert a file</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Select the Deadline </label>
                                    <input class="form-control" type="date" name="deadline" id="formFileMultiple" multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Please Input Files </label>
                                    <input class="form-control" type="file" name="files[]" id="formFileMultiple" accept=".doc,.docx,.pdf" multiple required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-secondary" name="save" value="Send">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- end of content -->
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
        "ajax": "get_files.php", // URL to server-side script that returns JSON data
        
        "columns": [
             {
            "data": "total" 
          },
           {
            "data": "reqList" 
          },

         {
            "data": "submissionDeadline",
                "render": function (data, type, row) {
                    // Assuming 'joining_date' is in 'YYYY-MM-DD' format
                    var date = new Date(data);
                    return date.toLocaleDateString("en-US", { month: 'long', day: 'numeric', year: 'numeric' });
                }
        },

         {
            "data": "status",
            render: function(data, type, row) {
              if (row.status == 1) {
                return '<span class="badge rounded-pill text-bg-primary">Pending</span>';
              }
              if (row.status == 2) {
                return ' <span class="status-btn warning-btn">Borrowed</span>';
              }
              if (row.status == 3) {
                return ' <span class="status-btn close-btn">Missing</span>';
              }
            }
          },
            {
            "data": "id" ,
            "render": function(data, type, full, meta) {
                return ' <a class="btn btn-danger" href="delete_files.php?delete='+data+'"  role="button"> <i class="bi bi-trash3-fill"> </i></a> ';
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

  <!-- realtime files -->

    <script>
            $(document).ready(function() {
                function getData() {
                    $.ajax({
                        type: 'POST',
                        url: 'real_files.php',
                        success: function(data) {
                            $('#files').html(data);
                        }
                    });
                }
                getData();
                setInterval(function() {
                    getData();
                }, 1000); // it will refresh your data every 1 sec

            });
        </script>


<!-- realtime storage -->

  <script>
            $(document).ready(function() {
                function getData() {
                    $.ajax({
                        type: 'POST',
                        url: 'real_storage.php',
                        success: function(data) {
                            $('#storage').html(data);
                        }
                    });
                }
                getData();
                setInterval(function() {
                    getData();
                }, 1000); // it will refresh your data every 1 sec

            });
        </script>

</body>
</html>

<?php



if(isset($_POST['save'])){

$status = 1;
$date_created = date('Y-m-d H:i:s');
$deadline = DateTime::createFromFormat('Y-m-d', $_POST['deadline'])->format('Y-m-d');
$file_bytes = 0;

$insert_files = $conn->prepare("INSERT INTO `files`(`studentid`, `reqList`, `submissionDeadline`, `dateTimeCreated`, `status`) VALUES (?,?,?,?,?)");
                        $insert_files->bind_param("issss",$student_id,$filename,$deadline,$date_created,$status);

   $file_bytes = array_sum($_FILES['files']['size']);
    $maxFileSize = 50 * 1024 * 1024;

    if(formatBytes($file_bytes) > formatBytes($maxFileSize) ){
         echo "<script>alert('The file atleast 50MB');</script>";
         return false;

    }

    else{


        // Loop through each uploaded file
    foreach ($_FILES['files']['name'] as $index => $file) {
        // Get file details
        $filename = $_FILES['files']['name'][$index];
        $tmp_name = $_FILES['files']['tmp_name'][$index];

         // Move the uploaded file to a destination directory
        $upload_directory = "files/";
        $destination = $upload_directory . $filename;

        

         if (move_uploaded_file($tmp_name, $destination)) {
            $insert_files->execute();
             echo "<script>alert('Sent');</script>";
        } else {
            echo "Error uploading file: " . $filename . "<br>";
        }
    }
        
    }

 



}

?>
                <!-- <div class="action justify-content-end">
                        <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                          <li class="dropdown-item">
                            <a href="" class="text-gray">Remove</a>
                          </li>
                          <li class="dropdown-item">
                            <a href="" class="text-gray edit" id="" data-id="" data-bs-toggle="modal" data-bs-target="#editNote">Update status</a>
                          </li>
                        </ul>
                      </div> -->