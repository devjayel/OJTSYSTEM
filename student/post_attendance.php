<?php
session_start();
include "../include/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];
    $image = $_POST['image'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $date = date("Y-m-d");
    $time = date("H:i:s");

    // Create directory if it doesn't exist
    $upload_dir = "../src/images/attendance/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Save image to folder
    $img = str_replace('data:image/jpeg;base64,', '', $image);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = "../src/images/attendance/" . $student_id . "_" . $status . "_" . date("Ymd_His") . ".jpg";
    file_put_contents($file, $data);

    // Get student's biometric picture
    $stmt = $conn->prepare("SELECT biometric_picture FROM studentinfo WHERE studentid = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $biometric_picture = "../src/images/profiles/".$row['biometric_picture'];
    
    // Face verification
    $apiKey = "0ELJFQhdQkYSEl1zkgQmGmATWAKQhJDc";
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
    if (!isset($result['confidence'])) {
        echo "<script>alert('Face verification failed: No face detected'); window.location.href='attendance.php';</script>";
        exit();
    }

    if (!isset($result['faces1']) || empty($result['faces1']) || !isset($result['faces2']) || empty($result['faces2'])) {
        echo "<script>alert('Face verification failed: Face not found in one or both images'); window.location.href='attendance.php';</script>";
        exit();
    }

    // Using the 1e-5 threshold (highest security) from the API response
    $threshold = isset($result['thresholds']['1e-5']) ? $result['thresholds']['1e-5'] : 73.975;
    
    if ($result['confidence'] < $threshold) {
        echo "<script>alert('Face verification failed: Confidence too low'); window.location.href='attendance.php';</script>";
        exit();
    }
    // Get day name
    $day = date('l', strtotime($date));
    // Update attendance based on status
    switch($status) {
      case 'time_in':
            $stmt = $conn->prepare("INSERT INTO attendance (studentid, date, day, clockIn, latitude, longitude, location, dateTimeCreated) 
                                  VALUES (?, ?, ?, ?, ?, ?, 'Location placeholder', NOW())");
            $stmt->bind_param("ssssdd", $student_id, $date, $day, $time, $lat, $long);
            break;
            
        case 'lunch_in':
            $stmt = $conn->prepare("UPDATE attendance 
                                  SET breakIn = ?, 
                                      latitude = ?, 
                                      longitude = ?, 
                                      location = 'Location placeholder',
                                      dateTimeUpdated = NOW() 
                                  WHERE studentid = ? AND date = ?");
            $stmt->bind_param("sddss", $time, $lat, $long, $student_id, $date);
            break;
            
        case 'lunch_out':
            $stmt = $conn->prepare("UPDATE attendance 
                                  SET breakOut = ?, 
                                      latitude = ?, 
                                      longitude = ?, 
                                      location = 'Location placeholder',
                                      dateTimeUpdated = NOW() 
                                  WHERE studentid = ? AND date = ?");
            $stmt->bind_param("sddss", $time, $lat, $long, $student_id, $date);
            break;
            
        case 'time_out':
            // Calculate total hours
            $stmt_hours = $conn->prepare("SELECT clockIn, breakIn, breakOut FROM attendance WHERE studentid = ? AND date = ?");
            $stmt_hours->bind_param("ss", $student_id, $date);
            $stmt_hours->execute();
            $result_hours = $stmt_hours->get_result();
            $row_hours = $result_hours->fetch_assoc();
            
            $total_hrs = 0;
            if ($row_hours) {
                $clock_in = strtotime($row_hours['clockIn']);
                $break_in = strtotime($row_hours['breakIn']);
                $break_out = strtotime($row_hours['breakOut']);
                $clock_out = strtotime($time);
                
                // Calculate work hours excluding break time
                if ($break_in && $break_out) {
                    $break_duration = $break_out - $break_in;
                    $total_duration = $clock_out - $clock_in;
                    $total_hrs = ($total_duration - $break_duration) / 3600; // Convert to hours
                } else {
                    $total_hrs = ($clock_out - $clock_in) / 3600;
                }
            }
            
            $stmt = $conn->prepare("UPDATE attendance 
                                  SET clockOut = ?, 
                                      latitude = ?, 
                                      longitude = ?, 
                                      location = 'Location placeholder',
                                      totalHrs = ?,
                                      dateTimeUpdated = NOW() 
                                  WHERE studentid = ? AND date = ?");
            $stmt->bind_param("sdddss", $time, $lat, $long, $total_hrs, $student_id, $date);
            $stmt_hours->close();
            break;
    }
    
    if ($stmt->execute()) {
        echo "<script>alert('Attendance recorded successfully'); window.location.href='attendance.php';</script>";
    } else {
        echo "<script>alert('Failed to record attendance'); window.location.href='attendance.php';</script>";
    }
    
    $stmt->close();
}
?>