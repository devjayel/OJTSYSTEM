<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    include "./include/connection.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("PHPMailer.php");
require("SMTP.php");
require("Exception.php");



function sendMail($email, $otp)
{

    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'cj.business04@gmail.com';    //don't forget the email                 //SMTP username // email username
        $mail->Password   = 'fwqqflylkdkpzfvk';     // passowrd                          //SMTP // email password password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->SetFrom('cj.business04@gmail.com');
        $mail->addAddress($email);
        //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "OTP";
        $mail->Body    = "This is your otp " . $otp . " Please don't reply";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


    
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

    <label name="username"> Email:</label>
    <input type="text" name="email">

    

    <input type="submit" value="SUBMIT" name="submit">
     <a name="frgtpass" href="index.php">You remember your passowrd? Click here</a>
    </form>

    
</body>
</html>

<?php
    if (isset($_POST["submit"])) {

        $email = $_POST['email'];


  $stmt = $conn->prepare("SELECT count(*) FROM studentinfo WHERE email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if($count > 0){
     $otp = rand(999999, 111111);
    $hashed_otp = password_hash($otp, PASSWORD_DEFAULT);

    $query_otp  = $conn->prepare("UPDATE `studentinfo` SET `otp` = ? WHERE email= ? ");
        if ($query_otp) {
        
            sendMail($email, $otp);

            $query_otp->bind_param('ss', $hashed_otp, $email);
            $query_otp->execute();
            
            
        $timestamp =  $_SERVER["REQUEST_TIME"];  // generate the timestamp when otp is forwarded to user email/mobile.
        $_SESSION['time'] = $timestamp;
        $_SESSION['email_otp'] = $email;


         echo "<script>window.location.href='otp.php' </script>";

          


        }

    }
    else{
                 echo '<script>alert("Invalid Email")</script>'; 
    }
     

        }


?>