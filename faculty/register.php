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
    <title>OJT MONITORING SYSTEM</title><style>
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

        .form-container{
            background-color: black;
            height: 100%;
            display : flex;
            flex-direction: column;
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
        }     body{
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

        .form-container{
            background-color: black;
            height: 100%;
            display : flex;
            flex-direction: column;
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
</head>
<body>

<div class="">
    <div class="main-container">
  
    
            <div class="sidebar-container">
                <div class="sidebar-content">
                    <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <img src="../src/images/ntclogo.PNG" class="img-fluid" alt="...">

                    </a>
                    <h3 style="margin-left: 1rem;">Faculty Portal</h3>
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
                            <a href="student_list.php" class="nav-link " title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Student List">
                                <i class="bi bi-folder-fill fs-5"></i> Student List
                            </a>
                        </li>
                        <li>
                            <a href="announcement.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Announcement">
                                <i class="bi bi-clock-fill fs-5"></i> Announcement
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
            <div class="col-sm p-3 min-vh-100">
                <div class="">
                   
                    <div style="max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #526E48; border-radius: 10px; background-color: #F9F9F9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
    <h1 style="color: #526E48; text-align: center;">Register</h1>
    <hr style="border: 1px solid #526E48; margin-bottom: 20px;">
    <div>
        <form method="post" action="" style="display: flex; flex-direction: column; gap: 15px;">
            <!-- Welcome Label -->
            <label name="welcome" style="font-size: 16px; color: #526E48;">Welcome</label>

            <!-- Register as Dropdown -->
            <label name="regAs" for="type" style="font-size: 14px; color: #526E48;">Register as:</label>
            <select name="user_types" id="usertype" style="padding: 8px; border: 1px solid #526E48; border-radius: 5px; background-color: #FFF; color: #526E48; font-size: 14px;">
                <optgroup label="Login type">
                    <option value="1">Student</option>
                    <option value="2">Admin</option>
                    <option value="3">Faculty</option>
                    <option value="4">Coordinator</option>
                </optgroup>
            </select>

            <!-- Username Field -->
            <label name="username" style="font-size: 14px; color: #526E48;">Username</label>
            <input type="text" name="username" required style="padding: 8px; border: 1px solid #526E48; border-radius: 5px; font-size: 14px; color: #526E48; background-color: #FFF;">

            <!-- Password Field -->
            <label name="password" style="font-size: 14px; color: #526E48;">Password</label>
            <input type="password" name="password" required style="padding: 8px; border: 1px solid #526E48; border-radius: 5px; font-size: 14px; color: #526E48; background-color: #FFF;">

            <!-- Submit Button -->
            <input type="submit" value="SUBMIT" name="submit" style="padding: 10px; font-size: 16px; color: white; background-color: #526E48; border: none; border-radius: 5px; cursor: pointer; text-transform: uppercase;">
        </form>
    </div>
</div>

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