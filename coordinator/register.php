<?php 
session_start();
date_default_timezone_set('Asia/Manila');
$student_id = $_SESSION["username"];
include "../include/connection.php";



//studentinfo

function insert_studentinfo($conn,$username){

$last_name =null;
$first_name =null;
$middle_name =null;
$contact_number =null;
$email =null;
$college =null;
$year_course =null;
$birth_date =null;
$gender =null; 
$date_created = date('Y-m-d H:i:s');

      $insert_student = $conn->prepare("INSERT INTO `studentinfo`( `studentid`,`lastName`, `firstName`, `middleName`, `contactNum`, `email`, `college`, `yearProg`, `birthDate`, `gender`, `dateTimeCreated`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                    if($insert_student){
                        $insert_student->bind_param("isssissssss",$username,$last_name,$first_name,$middle_name,$contact_number,$email,$college,$year_course,$birth_date,$gender,$date_created);
                        $insert_student->execute();
           }



}

function insert_practicuminfo($conn,$username){
$company = null;
$company_address = null;
$department = null;
$supervisor_name = null;
$position = null;
$email = null;
$contact_number = null;
$ojt_coordinator = null;
$hours = null;
$hired_date = null;
$start_date = null;
$date_created = date('Y-m-d H:i:s');

$insert_practicum = $conn->prepare("INSERT INTO `practicuminfo`(`studentid`, `company`, `compAddress`, `department`, `supervisorName`, `position`, `email`, `contactNum`, `ojtCoordinator`, `practicumHrsreq`, `hiredDate`, `startDate`, `dateTimeCreated`) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
if($insert_practicum){
    $insert_practicum->bind_param("sssssssisisss",$username,$company,$company_address,$department,$supervisor_name,$position,$email,$contact_number,$ojt_coordinator,$hours,$hired_date,$start_date,$date_created);
    $insert_practicum->execute();
}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/css/admin/registerStyle.css">
    <title>OJT MONITORING SYSTEM</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-auto bg-white sticky-top shadow">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-white align-items-center sticky-top">
                <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                   <img src="../src/images/ntclogo.PNG" class="img-fluid" alt="...">
                </a>
                        <h3>Coordinator Portal</h3>
                        <br>
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3" style = "align-items:start; text-align:left;">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard" name="dashboard">
                           <i class="bi bi-house-fill fs-3"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="student_list.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Student List" name="dashboard">
                         <i class="bi bi-person-lines-fill fs-3"></i> Student List
                        </a>
                    </li>
                    <li>
                        <a href="announcement.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="studentList">
                           <i class="bi bi-megaphone-fill fs-3"></i> Announcement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="register">
                           <i class="bi bi-person-fill-add fs-3"></i> Register
                        </a>
                    </li>

                    <li>
                        <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="settings">
                           <i class="bi bi-gear-fill fs-3"></i> Settings
                        </a>
                    </li>
                        <br>
                    <li>
                        <hr>
                        <a href="../include/logout.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="logout">
                           <i class="bi bi-box-arrow-left fs-55" style = "padding-right:10px; "></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
            <div class="col-sm p-3 min-vh-100">
                <div>
                    <h1>Register</h1>
                    <hr>
                    <div>
                    <form method="post" action="">

                        <label name="welcome" > WELCOME! </label>
                        <label name="regAs" for="type">Register as:</label>
                        <select name="user_types" id="usertype">
                        <optgroup label="Login type">
                        <option value="1">Student</option>
                        <option value="2">Admin</option>
                        <option value="3">Faculty</option>
                        <option value="4">Coordinator</option>
                        </select>
                        <br>
                        <label name="username"> Username </label>
                        <input type="text" name="username" required>
                        <br>
                        <label name="password"> Password </label>
                        <input type="password" name="password" required>
                        <br>
                        <input type="submit" value="SUBMIT" name="submit">
                    </form>
                    </div>
                </div>
            </div>
    </div>
</div>

   

    <!--script-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>




<?php
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $usertype = $_POST["user_types"];
        



        $result = $conn ->prepare("SELECT count(*) FROM users WHERE username=?");
        if($result){
            $result->bind_param("s", $username);
            $result->execute(); 
            $result->bind_result($validation);
            $result->fetch();
            $result->close();
            if ($validation > 0){
                echo "<script>alert('Username is already exist');</script>";
            }
            else{
                $insert = $conn ->prepare("INSERT INTO `users`(`username`, `password`, `usertype`) VALUES (?,?,?)");
                if ($insert){
                    $insert->bind_param("ssi", $username, $hashedpassword,$usertype);
                    if($insert->execute()){
                         if($usertype == 1){
                           insert_studentinfo($conn,$username);
                           insert_practicuminfo($conn,$username);
                            }

                    }


                   
                  //  echo "<script>window.location.href='login.php'</script>";
                    echo "<script>alert('Registered');</script>";
                    $insert->close();
                }
            }
        }

       
    }
    
    
?>