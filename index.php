<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "./include/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/css/loginStyle.css">
  <title>OJT MONITORING SYSTEM</title>
</head>

<body>
  <form method="post" action="">

    <label name="welcome"> WELCOME! </label>
    <label name="logAs" for="type">Login as:</label>
    <select name="user_types" id="usertype">
      <optgroup label="Login type">
        <option value="1">Student</option>
        <option value="2">Admin</option>
        <option value="3">Faculty</option>
        <option value="4">Coordinator</option>
    </select>
    <br>
    <label name="username"> Username </label>
    <input type="text" name="username">
    <br>
    <label name="password"> Password </label>
    <input type="password" name="password">
    <br>
    <input type="submit" value="SUBMIT" name="submit">
    <a name="frgtpass" href="forgot-password.php">Forgot Password?</a>
  </form>

</body>

</html>

<?php
if(isset($_POST["submit"])) {
  $username    = $_POST["username"];
  $password    = $_POST["password"];
  $usertype    = $_POST["user_types"];
  $student     = 1;
  $admin       = 2;
  $faculty     = 3;
  $coordinator = 4;

  if($usertype == 1) {
    $sel_student = $conn->prepare("
                     SELECT u.username, u.password, u.usertype, s.firstName 
                     FROM users u
                     INNER JOIN studentinfo s ON u.username = s.studentID
                     WHERE u.username = ? AND u.usertype = ?
                 ");

    if($sel_student) {
      $sel_student->bind_param("si", $username, $student);
      $sel_student->execute();
      $sel_student->bind_result($username, $hashedpassword, $db_usertype, $firstName);
      $sel_student->store_result();
      $sel_student->fetch();

      if($usertype == $db_usertype) {
        if(password_verify($password, $hashedpassword)) {
          $_SESSION["username"] = $username;


          //student page
          echo "<script>
                                 localStorage.setItem('firstName', '{$firstName}');
                                 window.location.href = 'student/index.php';
                             </script>";


        } else {

          echo "<script>alert('Invalid Credential');</script>";

        }


      } else {
        echo "<script>alert('Invalid Users');</script>";
      }


    }
  }


  if($usertype == 2) {
    $sel_admin = $conn->prepare("SELECT `username`, `password`, `usertype` FROM `users` WHERE username = ? AND usertype = ? ");

    if($sel_admin) {
      $sel_admin->bind_param("si", $username, $admin);
      $sel_admin->execute();
      $sel_admin->bind_result($username, $hashedpassword, $db_usertype);
      $sel_admin->store_result();
      $sel_admin->fetch();

      if($usertype == $db_usertype) {

        if(password_verify($password, $hashedpassword)) {
          $_SESSION["username"] = $username;


          //admin page
          echo "<script>window.location.href='admin/index.php'</script>";


        } else {

          echo "<script>alert('Invalid Credential');</script>";

        }

      } else {
        echo "<script>alert('Invalid Users');</script>";
      }

    }

  }

  if($usertype == 3) {
    $sel_faculty = $conn->prepare("SELECT `username`, `password`, `usertype` FROM `users` WHERE username = ? AND usertype = ? ");

    if($sel_faculty) {
      $sel_faculty->bind_param("si", $username, $faculty);
      $sel_faculty->execute();
      $sel_faculty->bind_result($username, $hashedpassword, $db_usertype);
      $sel_faculty->store_result();
      $sel_faculty->fetch();

      if($usertype == $db_usertype) {

        if(password_verify($password, $hashedpassword)) {
          $_SESSION["username"] = $username;


          //faculty page
          echo "<script>window.location.href='faculty/index.php'</script>";


        } else {

          echo "<script>alert('Invalid Credential');</script>";

        }

      } else {
        echo "<script>alert('Invalid Users');</script>";
      }

    }

  }


  if($usertype == 4) {
    $sel_coordinator = $conn->prepare("SELECT `username`, `password`, `usertype` FROM `users` WHERE username = ? AND usertype = ? ");

    if($sel_coordinator) {
      $sel_coordinator->bind_param("si", $username, $coordinator);
      $sel_coordinator->execute();
      $sel_coordinator->bind_result($username, $hashedpassword, $db_usertype);
      $sel_coordinator->store_result();
      $sel_coordinator->fetch();

      if($usertype == $db_usertype) {


        if(password_verify($password, $hashedpassword)) {
          $_SESSION["username"] = $username;


          //coordinator page
          echo "<script>window.location.href='coordinator/index.php'</script>";


        } else {

          echo "<script>alert('Invalid Credential');</script>";

        }

      } else {
        echo "<script>alert('Invalid Users');</script>";
      }

    }

  }

}

?>