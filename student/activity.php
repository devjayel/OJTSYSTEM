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
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/css/student/studActivityStyle.css">
    <style>
         body {
            border: 0;
            margin :0;
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

        
        .sidebar-container {
            width: 300px;
            height: 100vh;
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

        .nav-item [name="activity"] {
        border-radius: 8px;
        margin-bottom: 4px;
        background-color: rgba(82, 110, 72, 1);
        color: white;

        }

        .nav-item [name="activity"]:hover {
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!--sidebar-->
    <div class="container-fluid">
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
                            <a href="index.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Dashboard" name="dashboard">
                                <i class="bi bi-house-fill fs-5"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="files.php" class="nav-link " title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Student List">
                                <i class="bi bi-folder-fill fs-5"></i> Files
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="attendance.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement" name="attendance">
                                <i class="bi bi-clock-fill fs-5"></i> Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="activity.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement" name="activity">
                                <i class="bi bi-list-ul fs-5"></i> Activity
                            </a>
                        </li>

                        <li class="nav-item">
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
            <div class="col-sm p-3 min-vh-100">
                <div class="">
                    <h1>ACTIVITY</h1>
                    <hr>
                    <a class="btn btn-primary" role="button">My Activities</a>
                    <div class=""  style=" margin-top: 1rem">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="card-title"> Activities </h4>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Submit an activity
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <br>
                                        <thead>
                                            <th>NO</th>
                                            <th>Date</th>
                                            <th>Images</th>
                                            <th>Details</th>
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

            <!--MODAL-->
            <!-- modal -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Insert a activity</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Select Date </label>
                                    <input class="form-control" type="date" name="date" id="formFileMultiple" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Please Input Files </label>
                                    <input class="form-control" type="file" name="file" id="formFileMultiple"
                                        accept=".doc,.docx,.pdf,.jpeg,.jpg,.jpg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1"
                                        class="form-label">Details/Description</label>
                                    <textarea class="form-control" name="details" id="exampleFormControlTextarea1"
                                        rows="3" required></textarea>
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
            <!--end of modal-->

            <!-- data tables -->

            <script type="text/javascript">
                $(document).ready(function () {


                    var dataTable = $('table').DataTable({
                        "ajax": "get_activity.php", // URL to server-side script that returns JSON data

                        "columns": [
                            {
                                "data": "total"
                            },
                            {
                                "data": "date"
                            },
                            {
                                "data": "file",
                                "render": function (data, type, full, meta) {
                                    return '<img src="activity/' + data + '" width="150" height="150">';
                                }

                            },


                            {
                                "data": "details"
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
                        setInterval(function () {
                            dataTable.ajax.reload(null, false); // Reload table data every 5 seconds
                        }, 5000);
                });


            </script>

            <!--script-->
            <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>



</body>

</html>


<?php
if (isset($_POST['save'])) {

    $date = DateTime::createFromFormat('Y-m-d', $_POST['date'])->format('Y-m-d');
    $details = $_POST['details'];

    $date_created = date('Y-m-d H:i:s');
    $date_updated = date('Y-m-d H:i:s');

    $new_image = $_FILES['file']['name'];
    $new_image_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];

    if ($file_size == 5242880) {
        echo "<script>alert('The file must be 5mb below');</script>";
        return false;
    } else {
        $stmt = $conn->prepare("INSERT INTO `activity`(`studentid`, `date`, `file`, `details`, `dateTimeCreated`) VALUES (?,?,?,?,?)");

        if ($stmt) {
            $stmt->bind_param("sssss", $student_id, $date, $new_image, $details, $date_created);
            $stmt->execute();

            if (move_uploaded_file($new_image_tmp, "activity/" . $new_image)) {
                echo "<script>alert('Sucessfully Submited');</script>";
                header('Location: activity.php');
            } else {
                echo "<script>alert('There is problem saving file');</script>";
            }



        }

    }








}



?>