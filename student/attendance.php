<?php
session_start();
$student_id = $_SESSION["username"];
date_default_timezone_set('Asia/Manila');
include "../include/session.php";
include "../include/connection.php";

// Check attendance status for today
$date = date("M-d-Y");
$check_attendance = $conn->prepare("SELECT clockIn, breakIn, breakOut, clockOut FROM attendance WHERE studentid = ? AND date = ?");
$check_attendance->bind_param("ss", $student_id, $date);
$check_attendance->execute();
$result = $check_attendance->get_result();
$attendance = $result->fetch_assoc();


$has_timein = true;
$has_breakin = true; 
$has_breakout = true;
$has_timeout = true;


function reverseGeocode($lat, $long, $apiKey)
{
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/css/student/studAttendanceStyle.css">
    <style>
        body {
            border: 0;
            margin: 0;
        }

        .main-container {
            width: 100%;
            display: flex;

        }

        .content-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            padding: 1rem;
        }


        .sidebar-container {
            width: 400px;
            height: 100vh;
            -webkit-box-shadow: 3px 3px 5px 1px #F2F2F2;
            box-shadow: 3px 3px 5px 1px #F2F2F2;

        }

        .sidebar-content {
            position: relative;
            height: 100%
        }

        .sidebar-footer {
            position: fixed;
            bottom: 1rem;
        }

        .button-container {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
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

        .nav-item [name="attendance"] {
            border-radius: 8px;
            margin-bottom: 4px;
            background-color: rgba(82, 110, 72, 1);
            color: white;

        }

        .nav-item [name="attendance"]:hover {
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

    <!--sidebar-->
    <div class="">
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
                                data-bs-placement="right" data-bs-original-title="Announcement">
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
            <div class="content-container">
                <div class="">
                    <h1>ATTENDANCE</h1>
                    <hr>
                    <a class="btn btn-primary" role="button">My Attendance</a>
                    <a class="btn btn-secondary" role="button" href="timesheet.php">Timesheet</a>
                </div>




                <!-- attendance -->

                <div class="">
                    <div style="width: rem; ">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="button-container">
                                    <h2 class="visually-hidden">Login Form</h2>
                                    <div class="card p-4">
                                        <h4 style="margin-bottom: 1rem;">Date and Time</h4>
                                        <div class="text-center"><i class="bi bi-clock" style="font-size:100px;"></i>
                                            <h2 id="time"></h2>
                                        </div>
                                    </div>
                                    <div class="card p-4" style="display:flex; gap: 1rem; width: 80%">
                                        <h4>Actions</h4>
                                        <div style="display:flex; gap: 1rem; width: 80%">
                                            <div class="mb-3">
                                                <input type="hidden" name="lat" id="latitude">
                                                <input type="hidden" name="long" id="longitude">
                                                <button class="btn btn-primary d-block" id="time_in" name="time_in"
                                                    type="submit" <?php echo $has_timein ? 'disabled' : ''; ?>>Time in&nbsp;</button>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" id="lunch_in" name="lunch_in"
                                                    type="submit" <?php echo (!$has_timein || $has_breakin) ? 'disabled' : ''; ?>>Lunch In&nbsp;</button>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" id="lunch_out" name="lunch_out"
                                                    type="submit" <?php echo (!$has_breakin || $has_breakout) ? 'disabled' : ''; ?>>Lunch out&nbsp;</button>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" id="time_out" name="time_out"
                                                    type="submit" <?php echo (!$has_timein || $has_timeout) ? 'disabled' : ''; ?>>Time out</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>

                        <!-- Attendance Modal -->
                        <div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="attendanceModalLabel">Take Attendance Photo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="camera-container">
                                <video id="webcam" autoplay playsinline width="100%"></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                                <img id="preview" style="display: none; width: 100%;" />
                                </div>
                                <form id="attendanceForm" method="POST" action="post_attendance.php">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                    <input type="hidden" name="status" id="attendanceStatus">
                                    <input type="hidden" name="image" id="capturedImage">
                                    <input type="hidden" name="lat" id="modalLatitude">
                                    <input type="hidden" name="long" id="modalLongitude">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="captureBtn">Capture</button>
                                <button type="button" class="btn btn-warning" id="retryBtn" style="display: none;">Retry</button>
                                <button type="button" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>


    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../src/js/time.js"></script>



    <!-- get location -->

    <script type="text/javascript">
        const schoolLat = 14.62439570217269; // Replace with your echo's latitude
        const schoolLong = 120.96852776168855; // Replace with your echo's longitude
        const allowedRadius = 30000; // Radius in meters

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

            console.log(userLat)
            console.log(userLong)

            document.querySelector("#latitude").value = userLat;
            document.querySelector("#longitude").value = userLong;

            // Validate the location
            const distance = calculateDistance(userLat, userLong, schoolLat, schoolLong);
            if (distance > allowedRadius) {
                document.querySelector("#time_in").disabled = false;
            } else {
                alert("You are outside the allowed area. Attendance cannot be recorded.");
                document.querySelector("#time_in").disabled = true;
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
    <script>
        let stream = null;
        let capturedImage = null;

        function initializeCamera() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const preview = document.getElementById('preview');
            const captureBtn = document.getElementById('captureBtn');
            const submitBtn = document.getElementById('submitBtn');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(videoStream => {
                    stream = videoStream;
                    video.srcObject = stream;
                })
                .catch(error => {
                    console.error('Error accessing webcam:', error);
                    alert('Unable to access webcam');
                });

            const retryBtn = document.getElementById('retryBtn');

            captureBtn.addEventListener('click', () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                capturedImage = canvas.toDataURL('image/jpeg');
                preview.src = capturedImage;
                video.style.display = 'none';
                preview.style.display = 'block';
                document.getElementById('capturedImage').value = capturedImage;
                submitBtn.disabled = false;
                captureBtn.style.display = 'none';
                retryBtn.style.display = 'inline-block';
            });

            retryBtn.addEventListener('click', () => {
                video.style.display = 'block';
                preview.style.display = 'none';
                capturedImage = null;
                document.getElementById('capturedImage').value = '';
                submitBtn.disabled = true;
                captureBtn.style.display = 'inline-block';
                retryBtn.style.display = 'none';
            });
        }

        function showAttendanceModal(status) {
            const modal = new bootstrap.Modal(document.getElementById('attendanceModal'));
            document.getElementById('attendanceStatus').value = status;
            document.getElementById('modalLatitude').value = document.getElementById('latitude').value;
            document.getElementById('modalLongitude').value = document.getElementById('longitude').value;
            
            modal.show();
            initializeCamera();
        }

        // Update the button click handlers
        document.getElementById('time_in').onclick = function(e) {
            e.preventDefault();
            showAttendanceModal('time_in');
        };

        document.getElementById('lunch_in').onclick = function(e) {
            e.preventDefault();
            showAttendanceModal('lunch_in');
        };

        document.getElementById('lunch_out').onclick = function(e) {
            e.preventDefault();
            showAttendanceModal('lunch_out');
        };

        document.getElementById('time_out').onclick = function(e) {
            e.preventDefault();
            showAttendanceModal('time_out');
        };

        document.getElementById('submitBtn').onclick = function() {
            document.getElementById('attendanceForm').submit();
        };

        // Cleanup when modal is hidden
        document.getElementById('attendanceModal').addEventListener('hidden.bs.modal', function () {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            document.getElementById('webcam').style.display = 'block';
            document.getElementById('preview').style.display = 'none';
            document.getElementById('submitBtn').disabled = true;
        });
</script>
</body>

</html>

<?php

include "../include/connection.php";

// Get current date, time, and day
$day = date('l');
$date = date("M-d-Y"); 
$date_created = date('Y-m-d H:i:s');
date_default_timezone_set("Asia/Manila");

// Haversine formula for calculating distance
function haversine($lat1, $lon1, $lat2, $lon2)
{
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
    $student_id = $_SESSION['username']; // Assuming the student's ID is stored in the session
    $userLat = isset($_POST['lat']) ? floatval($_POST['lat']) : null;
    $userLong = isset($_POST['long']) ? floatval($_POST['long']) : null;

    echo "<script>console.log($userLat $userLong);</script>";
    // School location
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
    } else {
        // Check if attendance is already recorded for today
        $stmt = $conn->prepare("SELECT COUNT(*) FROM attendance WHERE studentid = ? AND date = ?");
        $stmt->bind_param("is", $student_id, $date);
        $stmt->execute();
        $stmt->bind_result($validation_timein);
        $stmt->fetch();
        $stmt->close();

        if ($validation_timein > 0) {
            echo "<script>alert('You have already recorded attendance for today.'); window.history.back();</script>";
            exit();
        } else {
            // Record attendance in the database
            $timeIn = date("Y-m-d H:i:s");
            $stmt = $conn->prepare("INSERT INTO attendance (studentid, date, day, time_in, latitude, longitude, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssdds", $student_id, $date, $day, $timeIn, $userLat, $userLong, $date_created);

            if ($stmt->execute()) {
                echo "<script>alert('Time-in successful at $timeIn'); window.location.href = 'attendance.php';</script>";
            } else {
                echo "<script>alert('Failed to record attendance. Please try again.'); window.history.back();</script>";
            }

            $stmt->close();
        }
    }
}

//lunch in
if (isset($_POST['lunch_in'])) {
    $lunch_in = date("H:i", strtotime("now"));

    $time_in = date("H:i", strtotime("now"));
    $lat = $_POST['lat'];
    $long = $_POST['long'];

    $apiKey = 'pk.d8d3ca397b99f97ab437ee33354cda16'; // Replace with your LocationIQ API key

    $location = reverseGeocode($lat, $long, $apiKey);

    //validation
    $valid_lucnhin = $conn->prepare("SELECT count(*) FROM attendance WHERE`studentid` = ? AND `breakIn`= ?");
    $valid_lucnhin->bind_param("ss", $student_id, $lunch_in);
    $valid_lucnhin->execute();
    $valid_lucnhin->bind_result($validation_lunchin);
    $valid_lucnhin->fetch();
    $valid_lucnhin->close();


    if ($validation_lunchin > 0) {
        echo "<script>alert('Already have a attendance');</script>";
        return false;

    } else {

        // lunch in

        $insert_lunchin = $conn->prepare("UPDATE `attendance` SET `breakIn`=?,`latitude`=?,`longitude`=?,`location`=? WHERE `studentid` =?");
        $insert_lunchin->bind_param("sssss", $lunch_in, $lat, $long, $location, $student_id);
        $insert_lunchin->execute();
        echo "<script>alert('Sucessfully Lunch in');</script>";

    }






}

// lunch out
if (isset($_POST['lunch_out'])) {

    $lunch_out = date("H:i", strtotime("now"));
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $apiKey = 'pk.d8d3ca397b99f97ab437ee33354cda16'; // Replace with your LocationIQ API key
    $location = reverseGeocode($lat, $long, $apiKey);

    //validation

    $valid_lunchout = $conn->prepare("SELECT count(*) FROM attendance WHERE`studentid` = ? AND `breakOut`= ?");
    $valid_lunchout->bind_param("ss", $student_id, $lunch_out);
    $valid_lunchout->execute();
    $valid_lunchout->bind_result($validation_lunchout);
    $valid_lunchout->fetch();
    $valid_lunchout->close();

    if ($validation_lunchout > 0) {
        echo "<script>alert('Already have a attendance');</script>";
        return false;

    } else {
        $insert_lunchout = $conn->prepare("UPDATE `attendance` SET `breakOut`=?,`latitude`=?,`longitude`=?,`location`=? WHERE `studentid` =?");
        $insert_lunchout->bind_param("sssss", $lunch_out, $lat, $long, $location, $student_id);
        $insert_lunchout->execute();
        echo "<script>alert('Sucessfully Lunch out');</script>";
    }
}

// time out
if (isset($_POST["time_out"])) {
    $time_out = date("H:i", strtotime("now"));
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $apiKey = 'pk.d8d3ca397b99f97ab437ee33354cda16'; // Replace with your LocationIQ API key
    $location = reverseGeocode($lat, $long, $apiKey);


    //validation

    $valid_timeout = $conn->prepare("SELECT count(*) FROM attendance WHERE`studentid` = ? AND `clockOut`= ?");
    $valid_timeout->bind_param("ss", $student_id, $time_out);
    $valid_timeout->execute();
    $valid_timeout->bind_result($validation_timeout);
    $valid_timeout->fetch();
    $valid_timeout->close();

    if ($validation_timeout > 0) {
        echo "<script>alert('Already have a attendance');</script>";
        return false;

    } else {

        $insert_timeout = $conn->prepare("UPDATE `attendance` SET `clockOut`=?,`latitude`=?,`longitude`=?,`location`=? WHERE `studentid` =?");
        $insert_timeout->bind_param("sssss", $time_out, $lat, $long, $location, $student_id);
        if ($insert_timeout->execute()) {

            // computing of hour
            $query_hour = "SELECT `clockIn`, `clockOut`, `breakIn`, `breakOut` FROM `attendance` WHERE `studentid` = '$student_id' AND `date` = '$date' ";
            $run_query_hour = mysqli_query($conn, $query_hour);

            if (mysqli_num_rows($run_query_hour) > 0) {
                foreach ($run_query_hour as $row) {
                    $diff_time = round(abs(strtotime($row['clockIn']) - strtotime($row['clockOut'])) / 3600, 2);
                    $diff_lunch = round(abs(strtotime($row['breakIn']) - strtotime($row['breakOut'])) / 3600, 2);


                    $total_hour = $diff_time - $diff_lunch;




                    $insert_hour = "UPDATE `attendance` SET `totalHrs` = '$total_hour' WHERE `studentid` ='$student_id' AND date = '$date'";
                    $run_hour = mysqli_query($conn, $insert_hour);

                    if ($run_hour) {
                        echo "<script> alert('Succesfully time out')</script>";

                    }



                }

            }
        }
    }

}

?>