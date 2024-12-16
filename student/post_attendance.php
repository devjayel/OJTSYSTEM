<?php
session_start();
include "../include/connection.php";
date_default_timezone_set('Asia/Manila');

function reverseGeocode($lat, $long)
{
    // LocationIQ Reverse Geocoding API endpoint
    $apiEndpoint = 'https://us1.locationiq.com/v1/reverse.php';

    // Prepare parameters
    $params = [
        'key' => "pk.d8d3ca397b99f97ab437ee33354cda16",
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
    if(!empty($data['display_name'])) {
        // Extract the formatted address
        $formattedAddress = $data['display_name'];

        return $formattedAddress;
    } else {
        // Handle errors
        return 'Error in reverse geocoding';
    }
}


if($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $status     = $_POST['status'];
    $image      = $_POST['image'];
    $lat        = $_POST['lat'];
    $long       = $_POST['long'];
    $date       = date("Y-m-d");
    $time       = date("H:i:s");

    // Create directory if it doesn't exist
    $upload_dir = "../src/images/attendance/";
    if(!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Get reverse location via lat and long
    $location = "659-A Cecilia Muñoz St, Ermita, Manila, 1000 Metro Manila";


    // Save image to folder
    $img  = str_replace('data:image/jpeg;base64,', '', $image);
    $img  = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = "../src/images/attendance/" . $student_id . "_" . $status . "_" . date("Ymd_His") . ".jpg";
    file_put_contents($file, $data);

    // Get student's biometric picture
    $stmt = $conn->prepare("SELECT biometric_picture FROM studentinfo WHERE studentid = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result            = $stmt->get_result();
    $row               = $result->fetch_assoc();
    $biometric_picture = "../src/images/profiles/" . $row['biometric_picture'];

    // Face verification
    $apiKey    = "0ELJFQhdQkYSEl1zkgQmGmATWAKQhJDc";
    $apiSecret = "b1yiPajkwTEXoXKmYVSFPL1gbmuYRwiN";

    $curl_data = [
        'api_key' => $apiKey,
        'api_secret' => $apiSecret,
        'image_file1' => new CURLFile($biometric_picture),
        'image_file2' => new CURLFile($file)
    ];

    $ch = curl_init('https://api-us.faceplusplus.com/facepp/v3/compare');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    // Comprehensive face verification check
    if(!isset($result['confidence'])) {
        echo "<script>alert('Face verification failed: No face detected'); window.location.href='attendance.php';</script>";
        exit();
    }

    if(!isset($result['faces1']) || empty($result['faces1']) || !isset($result['faces2']) || empty($result['faces2'])) {
        echo "<script>alert('Face verification failed: Face not found in one or both images'); window.location.href='attendance.php';</script>";
        exit();
    }

    // Using the 1e-5 threshold (highest security) from the API response
    $threshold = isset($result['thresholds']['1e-5']) ? $result['thresholds']['1e-5'] : 73.975;

    if($result['confidence'] < $threshold) {
        echo "<script>alert('Face verification failed: Confidence too low'); window.location.href='attendance.php';</script>";
        exit();
    }
    // Get day name
    $day = date('l', strtotime($date));
    // Update attendance based on status
    switch($status) {
        case 'time_in':
            $sql = "INSERT INTO attendance (studentid, date, day, clockIn, latitude, longitude, location, dateTimeCreated) 
                VALUES ('$student_id', '$date', '$day', '$time', $lat, $long, '$location', NOW())";
            mysqli_query($conn, $sql);
            break;

        case 'lunch_in':
            $sql = "UPDATE attendance 
                SET breakIn = '$time', 
                    latitude = $lat, 
                    longitude = $long, 
                    location = '$location',
                    dateTimeUpdated = NOW() 
                WHERE studentid = '$student_id' AND date = '$date'";
            mysqli_query($conn, $sql);
            break;

        case 'lunch_out':
            $sql = "UPDATE attendance 
                SET breakOut = '$time', 
                    latitude = $lat, 
                    longitude = $long, 
                    location = '$location',
                    dateTimeUpdated = NOW() 
                WHERE studentid = '$student_id' AND date = '$date'";
            mysqli_query($conn, $sql);
            break;

        case 'time_out':
            // Fetch existing times
            $sql_hours = "SELECT clockIn, breakIn, breakOut FROM attendance WHERE studentid = '$student_id' AND date = '$date'";
            $result_hours = mysqli_query($conn, $sql_hours);
            $row_hours = mysqli_fetch_assoc($result_hours);

            $total_hrs = 0;
            if($row_hours) {
                $clock_in  = strtotime($row_hours['clockIn']);
                $break_in  = strtotime($row_hours['breakIn']);
                $break_out = strtotime($row_hours['breakOut']);
                $clock_out = strtotime($time);

                // Calculate work hours excluding break time
                if($break_in && $break_out) {
                    $break_duration = $break_out - $break_in;
                    $total_duration = $clock_out - $clock_in;
                    $total_hrs      = ($total_duration - $break_duration) / 3600; // Convert to hours
                } else {
                    $total_hrs = ($clock_out - $clock_in) / 3600;
                }
            }

            // Update attendance with clockOut and totalHrs
            $sql = "UPDATE attendance 
                SET clockOut = '$time', 
                    latitude = $lat, 
                    longitude = $long, 
                    location = '$location',
                    totalHrs = $total_hrs,
                    dateTimeUpdated = NOW() 
                WHERE studentid = '$student_id' AND date = '$date'";
            mysqli_query($conn, $sql);
            break;
    }

    // Close the connection if done
    mysqli_close($conn);


    // Close the statement to free up resources
    if(isset($stmt)) {
        mysqli_stmt_close($stmt);
    }



    if($stmt->execute()) {
        echo "<script>alert('Attendance recorded successfully'); window.location.href='attendance.php';</script>";
    } else {
        echo "<script>alert('Failed to record attendance'); window.location.href='attendance.php';</script>";
    }

    $stmt->close();
}
?>