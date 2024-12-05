<?php 
session_start();
$student_id = $_SESSION["username"];
date_default_timezone_set('Asia/Manila');
include "../include/connection.php";
include "../include/session.php";

function reverseGeocode($lat, $long, $apiKey) {
    // LocationIQ Reverse Geocoding API endpoint
    $apiEndpoint = 'https://us1.locationiq.com/v1/reverse.php';

    // Prepare parameters
    $params = [
        'key' => $apiKey,
        'lat' => $lat,
        'lon' => $long,
        'format' => 'json',
    ];

    // Build the query string
    $queryString = http_build_query($params);

    // Final URL
    $url = $apiEndpoint . '?' . $queryString;

    // Make a request to the API
    $response = file_get_contents($url);

    // Decode JSON response
    $data = json_decode($response, true);

    // Check if the request was successful
    if (!empty($data['display_name'])) {
        // Extract the formatted address
        $formattedAddress = $data['display_name'];

        return $formattedAddress;
    } else {
        // Handle errors
        return 'Error in reverse geocoding';
    }
}



?>
<html lang="en">
<head>
<meta name="viewport" content="width=1024">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/css/student/studAttendanceStyle.css">
    <link rel="stylesheet" href="../src/fonts/ionicons.min.css">

    <title>OJT MONITORING SYSTEM</title>
</head>
<body>

<!--sidebar-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-auto bg-white sticky-top shadow">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-white align-items-center sticky-top">
                <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                <img src="../src/images/large_logo.PNG" class="img-fluid" alt="..." style="width:300px;height:100px;">
                </a>
                        <h3>Student Portal</h3>
                        <br>
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3" style = "align-items:start; text-align:left;">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard" name="dashboard">
                           <i class="bi bi-house-fill fs-5"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="files.php" class="nav-link " title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Student List" name="files">
                         <i class="bi bi-folder-fill fs-5"></i> Files
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="attendance.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement" name="attendance">
                           <i class="bi bi-clock-fill fs-5"></i> Attendance
                        </a>
                    </li>
                    <li>
                        <a href="activity.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement">
                           <i class="bi bi-list-ul fs-5"></i> Activity
                        </a>
                    </li>

                    <li>
                        <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Announcement">
                           <i class="bi bi-gear-fill fs-5"></i> Settings
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
            <div class="container-xxl">
                <h1>ATTENDANCE</h1>
                    <hr>
                         <a class="btn btn-primary" role="button">My Attendance</a>
                         <a class="btn btn-secondary" role="button" href="timesheet.php">Timesheet</a> 
                    </div>
                   

                
                
                    <!-- attendance -->

                    <div class="col d-flex justify-content-center">
                      <div class="card mt-5 " style="width: rem; ">
                        <div class="card-body">
                           <form action = ""  method="post">
                                <div class="text-center"><i class="bi bi-clock"  style = "font-size:100px;"></i>
                                    <h2 id = "time" ></h2>
                                        </div>
                                    <div class="mb-3">
                                         <input type="hidden" name="lat" id="latitude">
                                         <input type="hidden" name="long" id="longitude">
                                        <button class="btn btn-primary d-block w-100" id="time_in" name = "time_in" type="submit">Time in&nbsp;</button>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-block w-100" id="lunch_in" name = "lunch_in" type="submit">Lunch In&nbsp;</button>
                                    </div>
                                    <div class="mb-3">  
                                        <button class="btn btn-primary d-block w-100" id="lunch_out"  name = "lunch_out" type="submit">Lunch out&nbsp;</button>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-block w-100" id="time_out" name = "time_out" type="submit">Time out</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                </div> 

                  
   
                
        </div>

        
    </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="../src/js/time.js"></script>



<!-- get location -->

 <script type="text/javascript">

    //, 
      // School location coordinates
      //const schoolLat = 14.5995; // Replace with your school's latitude
       // const schoolLong = 120.9842; // Replace with your school's longitude

        const schoolLat = 14.626671306656268; // Replace with your echo's latitude
        const schoolLong = 120.97950278312021; // Replace with your echo's longitude
        const allowedRadius = 10000; // Radius in meters

        // Function to calculate the distance between two coordinates
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3; // Earth's radius in meters
            const φ1 = (lat1 * Math.PI) / 180;
            const φ2 = (lat2 * Math.PI) / 180;
            const Δφ = ((lat2 - lat1) * Math.PI) / 180;
            const Δλ = ((lon2 - lon1) * Math.PI) / 180;

            const a =
                Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // Distance in meters
        }

        // Function to get the user's location
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setLocation, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Set location in the form
        function setLocation(position) {
            const userLat = position.coords.latitude;
            const userLong = position.coords.longitude;

            document.querySelector("#latitude").value = userLat;
            document.querySelector("#longitude").value = userLong;

            // Validate the location
            const distance = calculateDistance(userLat, userLong, schoolLat, schoolLong);
            if (distance > allowedRadius) {
                alert("You are outside the allowed area. Attendance cannot be recorded.");
                document.querySelector("time_in").disabled = true;
            } else {
                document.querySelector("time_in").disabled = false;
            }
        }

        // Handle geolocation errors
        function showError(error) {
            let message = "";
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    message = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    message = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    message = "The request to get user location timed out.";
                    break;
                case error.UNKNOWN_ERROR:
                    message = "An unknown error occurred.";
                    break;
            }
            alert(message);
        }

        // Call getLocation on page load
        window.onload = getLocation;
    </script>



</body>
</html>

<?php

$day = date('l');
$date = date("M-d-Y");


$date_created = date('Y-m-d H:i:s');






// $time_out = date("H:i",strtotime("now"));

function haversine($lat1, $lon1, $lat2, $lon2) {
    $earth_radius = 6371000; // Earth's radius in meters
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earth_radius * $c;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userLat = isset($_POST['lat']) ? floatval($_POST['lat']) : null;
    $userLong = isset($_POST['long']) ? floatval($_POST['long']) : null;

    // School location
    //$schoolLat = 14.5995; // Replace with your school's latitude
    //$schoolLong = 120.9842; // Replace with your school's longitude

    $schoolLat = 14.626666116089805; // Replace with your school's latitude
    $schoolLong = 120.97951351195627; // Replace with your school's longitude
    $allowedRadius = 10000; // Radius in meters

    if ($userLat === null || $userLong === null) {
        echo "<script>alert('Failed to retrieve location data.');</script>";
        exit();
    }

    // Calculate the distance
    $distance = haversine($userLat, $userLong, $schoolLat, $schoolLong);

    if ($distance > $allowedRadius) {
        echo "<script>alert('You are outside the allowed area. Attendance cannot be recorded.'); window.history.back();</script>";
        exit();
    } else if($validation_timein > 0){
        echo "<script>alert('Already have a attendance'); window.history.back();</script>";
        exit();
    }else{

    // Proceed with time-in logic (e.g., save to database)
    // Example of logging time in:
    date_default_timezone_set("Asia/Manila");
    $timeIn = date("Y-m-d H:i:s");

    // Database logic can go here
    echo "<script>alert('Time-in successful at $timeIn'); window.location.href = 'attendance.php';</script>";
}
}

if(isset($_POST['lunch_in'])){
    $lunch_in = date("H:i",strtotime("now"));

    $time_in = date("H:i",strtotime("now"));
    $lat = $_POST['lat'];
    $long = $_POST['long'];

$apiKey = 'pk.d8d3ca397b99f97ab437ee33354cda16'; // Replace with your LocationIQ API key

$location = reverseGeocode($lat, $long, $apiKey);

    //validation
  $valid_lucnhin = $conn->prepare("SELECT count(*) FROM attendance WHERE`studentid` = ? AND `breakIn`= ?");
    $valid_lucnhin->bind_param("ss",$student_id,$lunch_in);
    $valid_lucnhin->execute();
    $valid_lucnhin->bind_result($validation_lunchin);
    $valid_lucnhin->fetch();
    $valid_lucnhin->close();
        

    if($validation_lunchin > 0){
          echo "<script>alert('Already have a attendance');</script>";
          return false;

    }

    else{

        // lunch in

    $insert_lunchin = $conn->prepare("UPDATE `attendance` SET `breakIn`=?,`latitude`=?,`longitude`=?,`location`=? WHERE `studentid` =?");
    $insert_lunchin->bind_param("sssss",$lunch_in,$lat,$long,$location,$student_id);
    $insert_lunchin->execute();
     echo "<script>alert('Sucessfully Lunch in');</script>";
        
    }






}

// lunch out

if(isset($_POST['lunch_out'])){

    $lunch_out = date("H:i",strtotime("now"));
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $apiKey = 'pk.d8d3ca397b99f97ab437ee33354cda16'; // Replace with your LocationIQ API key
    $location = reverseGeocode($lat, $long, $apiKey);

    //validation

    $valid_lunchout = $conn->prepare("SELECT count(*) FROM attendance WHERE`studentid` = ? AND `breakOut`= ?");
    $valid_lunchout->bind_param("ss",$student_id,$lunch_out);
    $valid_lunchout->execute();
    $valid_lunchout->bind_result($validation_lunchout);
    $valid_lunchout->fetch();
    $valid_lunchout->close();

    if($validation_lunchout > 0 ){
          echo "<script>alert('Already have a attendance');</script>";
          return false;

    }
    else{
        $insert_lunchout = $conn->prepare("UPDATE `attendance` SET `breakOut`=?,`latitude`=?,`longitude`=?,`location`=? WHERE `studentid` =?");
        $insert_lunchout->bind_param("sssss",$lunch_out,$lat,$long,$location,$student_id);
        $insert_lunchout->execute();
         echo "<script>alert('Sucessfully Lunch out');</script>";
        }
}


// time out
if(isset($_POST["time_out"])){
$time_out = date("H:i",strtotime("now"));
 $lat = $_POST['lat'];
    $long = $_POST['long'];
    $apiKey = 'pk.d8d3ca397b99f97ab437ee33354cda16'; // Replace with your LocationIQ API key
    $location = reverseGeocode($lat, $long, $apiKey);

    
 //validation

    $valid_timeout = $conn->prepare("SELECT count(*) FROM attendance WHERE`studentid` = ? AND `clockOut`= ?");
    $valid_timeout->bind_param("ss",$student_id,$time_out);
    $valid_timeout->execute();
    $valid_timeout->bind_result($validation_timeout);
    $valid_timeout->fetch();
    $valid_timeout->close();

    if($validation_timeout > 0 ){
          echo "<script>alert('Already have a attendance');</script>";
          return false;

    }
    else{
        
 $insert_timeout = $conn->prepare("UPDATE `attendance` SET `clockOut`=?,`latitude`=?,`longitude`=?,`location`=? WHERE `studentid` =?");
        $insert_timeout->bind_param("sssss",$time_out,$lat,$long,$location,$student_id);
        if($insert_timeout->execute()){

            // computing of hour
             $query_hour = "SELECT `clockIn`, `clockOut`, `breakIn`, `breakOut` FROM `attendance` WHERE `studentid` = '$student_id' AND `date` = '$date' ";
          $run_query_hour = mysqli_query($conn, $query_hour);

            if(mysqli_num_rows($run_query_hour) > 0){
              foreach($run_query_hour as $row){
                $diff_time = round(abs(strtotime($row['clockIn']) - strtotime($row['clockOut'])) / 3600,2);
                $diff_lunch = round(abs(strtotime($row['breakIn']) - strtotime($row['breakOut'])) / 3600,2);
            

                  $total_hour = $diff_time - $diff_lunch;

                
                  
                
               $insert_hour = "UPDATE `attendance` SET `totalHrs` = '$total_hour' WHERE `studentid` ='$student_id' AND date = '$date'";
               $run_hour = mysqli_query($conn, $insert_hour);

               if($run_hour){
                echo "<script> alert('Succesfully time out')</script>";

               }



              }

            }
        }
    }
    
}

?>