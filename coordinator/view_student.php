<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Manila');
$username= $_SESSION["username"];
include "../include/connection.php";
include "../include/session.php";

if(isset($_GET['view'])){
     $student_id = $_GET['view'];

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






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="../src/css/admin/viewStudentStyle.css">
     <title>COORDINATOR</title>
</head>
<body>
    

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
          <div class="container-xxl">
            <h1>View Student</h1>
            <hr> 
            <a class="btn btn-secondary" href="view_student.php?view=<?php echo $student_id?>"  role="button">Student Information</a>
            <a class="btn btn-secondary" href="files.php?view=<?php echo $student_id ?>" role="button">Files</a>
             <form id="myForm" action="process.php" method="post"><br>
                <input type="hidden" name = "studentid" value = "<?php echo $student_id ?>" >
                <label for="selectOption">Select Status:</label>
                <select id="selectOption" name="selectOption" onchange="submitForm()">
                    <option value="0">Select the status below</option>
                    <option value="1">l0:I have not started anything regarding OJT</option>
                    <option value="2">l1:I have applied to HTEs but have not yet been accepted to one</option>
                    <option value="3">l2:I have been accepted in an HTE but I am still fixing my requirements</option>
                    <option value="4">l3:I have been accepted in an HTE and have started my training</option>
                    <option value="5">l4:I am working student and waiting for approval</option>
                    <option value="6">l5:I am working student and have recieved my credeting approval</option>
                </select>
            </form>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="profile-container ">
                  <?php

                                        $query = "SELECT * FROM `studentinfo` WHERE studentid = '$student_id'";
                                        $run = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($run) > 0) {
                                            foreach ($run as $row) {
                                        ?>


<div class="container text-center">
                            <div class="row justify content-start">
                                <div class="col-3"> 
                                <img src="../student/image/<?php echo$row['image'] ?> " class="img-fluid rounded-circle rounded" style="width: 10rem; height:10rem;" alt="...">           
                                </div>
                                <div class="col-5">   
                                    <div class="labels"> 
                                                <label type="text" name="name" id="inputtext6" ><?php echo $row['lastName']?>, <?php echo $row['firstName']?> <?php echo $row['middleName']?></label><br>
                                                <label type="text" name="studentId" id="inputtext6" ><?php echo $row['studentid']?></label> <br>
                                                <label type="text" name="yearProg" id="inputtext6" ><?php echo $row['yearProg']?></label>       
                                    </div>                 
                                </div>
                                <div class="col-4">   
                                    <div class="labels2">
                                        <br>
                                        <i class="bi bi-envelope-at-fill"> </i> <label type="text" name="email" id="inputtext6" ><?php echo $row['email']?></label> <br>
                                        <i class="bi bi-telephone-fill"> </i>   <label type="text" name="contact_no" id="inputtext6" ><?php echo $row['contactNum']?></label>       

                                    </div>  
                                                
                                </div>
                                                        
                            </div>
                        </div>
            </div>




                        
                           <!-- <span class = "fw-bolder fs-5 "> <?php echo $row['email'] ?> </span>  
                          
                             <p class = "fw-bolder fs-5 lh-1" >  <?php echo $row['firstName']. " " . $row['middleName'] ." ". $row['lastName']  ?> </p>
                           <span class = "fw-bolder fs-5 "> <?php echo $row['email'] ?> </span>  
                         -->
                        
                    
            


             
      
                    <div class="pt-5">
                <div class="analytics-container  mb-5 " >
                        <h2>Personal Info</h2>
                        <div class="form-check form-switch">
                        </div>
                        <hr>
                    
                    <div class="row g-3 align-items-center">
                    <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Last Name:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="last_name" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $row['lastName'] ?>" disabled>
                            </div>

                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Email:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="email" name="email" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $row['email'] ?>" disabled >
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">First Name:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="first_name" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $row['firstName'] ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">College:</label>
                            </div>
                            <div class="col-md-4">
                            <select class="form-select" aria-label="Default select example" id="select" name="college" disabled>
                                                    <?php if ($row['college'] == 'SOAST') : ?>
                                                        <option value="SOAST">SOAST</option>
                                                        <option value="SOB">SOB</option>
                                                        <option value="SOTE">SOTE</option>
                                                    <?php elseif($row['college'] == 'SOB') : ?>
                                                        <option value="SOB">SOB</option>
                                                        <option value="SOAST">SOAST</option>
                                                        <option value="SOTE">SOTE</option>
                                                    <?php else : ?>
                                                        <option value="SOTE">SOTE</option>
                                                        <option value="SOAST">SOAST</option>
                                                        <option value="SOB">SOB</option>
                                                    <?php endif; ?>
                                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Middle Name:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="middle_name" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $row['middleName'] ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Year-Course:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="year_course" id="inputtext6" placeholder="4th Year-BSIT" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $row['yearProg'] ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Student No:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value="<?php echo $student_id ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">BirthDate:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="birth_date" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $row['birthDate'] ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Contact No:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="contact_no" id="inputtext6" class="form-control" aria-describedby="textHelpInline"value = "<?php echo $row['contactNum'] ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="inputtext6" class="col-form-label">Gender:</label>
                            </div>
                            <div class="col-md-4">
                            <select class="form-select" aria-label="Default select example" id="select" name="gender" disabled>
                                                    <?php if ($row['gender'] == 'Male') : ?>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    <?php else : ?>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                    <?php endif; ?>
                                                </select>
                            </div>
                        </div>
                    </div>
                    </form>

                    <?php
                                            }
                                        }
        ?>
              
        </div>








                  <div class="analytics-container  mb-5 " >
                        <h2> Practicum info</h2>
                        <div class="form-check form-switch">
                        </div>
                        <hr>
                 <?php
                                $query = 'SELECT `company`, `compAddress`, `department`, `supervisorName`, `position`, `email`, `contactNum`, `ojtCoordinator`, `practicumHrsreq`, `hiredDate`, `startDate` FROM `practicuminfo` 
                                        WHERE studentid = ?';
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param('s', $student_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $data = $result->fetch_all(MYSQLI_ASSOC);
                                foreach ($data as $rows) {
                              

                                ?>
                <form action = "" method="post">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Company</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="company" value="<?php echo $rows['company']?>" >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Company address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="company_address" value="<?php echo $rows['compAddress'] ?>" >
                        </div>
                    </div>

                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="department" value="<?php echo $rows['department'] ?>">
                        </div>
                    </div>

                     <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Supervisor Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="supervisor_name" value="<?php echo $rows['supervisorName'] ?>" >
                        </div>
                    </div>

                    
                     <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="position" value="<?php echo $rows['position'] ?>" >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="email" value="<?php echo $rows['email'] ?>">
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Number</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputEmail3" name="contact_number" value="<?php echo $rows['contactNum'] ?>">
                        </div>
                    </div>

                     <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">OJT Coordinator</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="ojt_coordinator" value="<?php echo $rows['ojtCoordinator'] ?>">
                        </div>
                    </div>

                     <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Hours Required</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputEmail3" name="hours" value="<?php echo $rows['practicumHrsreq'] ?>" >
                        </div>
                    </div>

                     <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Hired Date</label>
                        <div class="col-sm-10">
                        <input type="date" name="hired_date" id="inputtext6" class="form-control" aria-describedby="textHelpInline" value = "<?php echo $rows['hiredDate']; ?>">
                        </div>
                    </div>

                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="inputEmail3" name="start_date" value="<?php echo $rows['startDate'] ?>">
                        </div>
                    </div>

                   <div class="text-center "> <input type="submit" class="btn btn-primary" name="submit" value="Submit" id="update"  >
                </form>

   <?php
                                }
   ?>



    </div>
    </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    function submitForm() {
        // Get the form element
        var form = document.getElementById('myForm');
        
        // Submit the form
        form.submit();
    }
</script>
</body>
</html>

<?php
if(isset($_POST['submit'])) {

$company = $_POST['company'];
$company_address = $_POST['company_address'];
$department = $_POST['department'];
$supervisor_name = $_POST['supervisor_name'];
$position = $_POST['position'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$ojt_coordinator = $_POST['ojt_coordinator'];
$hours = $_POST['hours'];
$hired_date = DateTime::createFromFormat('Y-m-d', $_POST['hired_date'])->format('Y-m-d');
$start_date = DateTime::createFromFormat('Y-m-d', $_POST['start_date'])->format('Y-m-d');
$date_updated = date('Y-m-d H:i:s');

$result = $conn ->prepare("SELECT count(*) FROM practicuminfo WHERE studentid =?");
        if($result){
            $result->bind_param("s", $student_id);
            $result->execute(); 
            $result->bind_result($validation);
            $result->fetch();
            $result->close();
            if ($validation > 0){
                $update_practicum = $conn->prepare("UPDATE `practicuminfo` SET `company`=?,`compAddress`=?,`department`=?,`supervisorName`=?,`position`=?,`email`=?,`contactNum`=?,`ojtCoordinator`=?,`practicumHrsreq`=?,`hiredDate`=?,`startDate`=?,`dateTimeUpdated`=? WHERE studentid = ?");
                $update_practicum->bind_param("ssssssisissss",$company,$company_address,$department,$supervisor_name,$position,$email,$contact_number,$ojt_coordinator,$hours,$hired_date,$start_date,$date_updated,$student_id);
                $update_practicum->execute();
                 echo "<script>alert('Sucessfully Insert');</script>";
                 header('Location: view_student.php?view='.$student_id);
                 $update_practicum->close();
                  exit;
            }
        }


}

ob_end_flush();
?>