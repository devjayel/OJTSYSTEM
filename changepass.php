<?php
session_start();
 include "./include/connection.php";

$email = $_SESSION['email_otp'];


if (empty($_SESSION['email_otp'])) {
    echo "<script>window.location.href='login.php' </script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/loginStyle.css">

    <link href="../src/css/bootstrap.css" rel="stylesheet">
    <link href="../src/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../src/sweetalert2/dist/sweetalert2.min.js">

    <title>Change Password</title>
</head>

<body>



    <form method="post" action="">

<div class="d-flex align-items-center mb-3 pb-1">
 <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>

 </div>

 <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Change Your Password</h5>

<div class="form-outline mb-4">
  <input type="password" id="form2Example17" class="form-control form-control-lg" name="password" maxlength="30" required />
 <label class="form-label" for="form2Example17">Enter your password</label>
    </div>
<div class="form-outline mb-4">
<input type="password" id="form2Example17" class="form-control form-control-lg" name="password2" maxlength="30" required />
<label class="form-label" for="form2Example17">Confirm your password</label>
</div>
<div class="pt-1 mb-4">
<input type="submit" class="btn btn-secondary" name="reset" value="Reset">
</div>

</form>
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/jquery-3.6.1.min.js"></script>
</body>

</html>
<?php
if (isset($_POST['reset'])) {

    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $otp = "";
    if ($password == $password2) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

         $stmt = $conn->prepare("SELECT `studentid` FROM `studentinfo` WHERE email = ? ");
         if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $username = $row['studentid'];


        $update= $conn->prepare("UPDATE `users` SET `password` = ? WHERE `username` = ? ");
        $update->bind_param("ss",$hashed_password,$username);
        $update->execute();

         echo "
                        <script>
                        alert('Sucessfully Change');
                        </script>
                        ";

        session_destroy();
        unset($_SESSION['email_otp']);
        echo "<script>window.location.href='index.php'</script>";
        exit();
   
    }
       
       
    } else {
        echo "
                        <script>
                        alert('The password does not match');
                        </script>
                        ";
    }
}

?>