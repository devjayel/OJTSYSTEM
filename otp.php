<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "./include/connection.php";

$email = $_SESSION['email_otp'];

if (empty($_SESSION['email_otp'])) {
    echo "<script>window.location.href='index.php' </script>";
}

$timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 
if (($timestamp - $_SESSION['time']) > 120)  // 5 minutes refers to 300 seconds
{
    $otp = " ";
    $stmt = $conn->prepare("UPDATE `studentinfo` SET `otp`= ? WHERE email = ? ");
    $stmt->bind_param('ss', $otp, $email);
    $stmt->execute();

    session_destroy();
    unset($_SESSION['email_otp']);
    unset($_SESSION['time']);
    echo "<script>window.location.href='forgot-password.php'</script>";
    exit();


    // delete the otp in the database and alert the person that the otp is expired
}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/loginStyle.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">

        <p>Countdown: <span id="timer">1:00</span></p>
        <label class="form-label" for="form2Example17">Enter Your otp</label>
        <input type="number" id="form2Example17" class="form-control form-control-lg" name="otp" min="0" max="999999" oninput="validity.valid||(value='');" size="6" required />
        <input type="submit" class="btn btn-secondary" name="submit" value="Reset">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


    
        if (localStorage.getItem('countdown')) {
            // Get the timer value from local storage
            var countdown = localStorage.getItem('countdown');
        } else {
            // Set the timer value to 5 minutes (300 seconds)
            var countdown = 120;
        }



        // Display the initial timer value
        document.getElementById('timer').innerHTML = formatTime(countdown);

        // Start the countdown timer
        var timer = setInterval(function() {
            countdown--;
            document.getElementById('timer').innerHTML = formatTime(countdown);

            // Store the timer value in local storage
            localStorage.setItem('countdown', countdown);

            // When the countdown reaches 0, refresh the page
            if (countdown <= 0) {
                localStorage.clear();
                clearInterval(timer);
                location.reload();
                alert("Your otp is expired");
                window.location.href = forgot-password.php
            }
        }, 1000);

        // Helper function to format the time as mm:ss
        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var seconds = seconds % 60;
            return (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        }
    </script>


</body>
</html>

<?php
if (isset($_POST['submit'])) {

     $otp = $_POST['otp'];

    $stmt = $conn->prepare("SELECT `otp` FROM `studentinfo` WHERE email = ? ");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $hashed_otp = $row['otp'];
    }
    if (password_verify($otp, $hashed_otp)) {

        echo "<script>window.location.href='changepass.php' </script>";
    } else {
        echo "
                        <script>
                        alert('Invalid OTP');
                        </script>
                        ";
    }


}
?>