<?php
session_start();
include "../include/connection.php";
include "../include/session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $image_data = $_POST['image_data'];

    // First check if username exists
    $result = $conn->prepare("SELECT count(*) FROM users WHERE username=?");
    if($result) {
        $result->bind_param("s", $username);
        $result->execute();
        $result->bind_result($count);
        $result->fetch();
        $result->close();

        if($count > 0) {
            $_SESSION['error'] = "Username already exists";
            header("Location: student_list.php");
            exit();
        }
    }

    // Remove the data URL prefix to get just the base64 data
    $image_parts = explode(";base64,", $image_data);
    $image_base64 = base64_decode($image_parts[1]);

    // Generate unique filename
    $filename = uniqid() . '.jpg';
    $upload_path = "../src/images/profiles/" . $filename;

    // Save the image file
    file_put_contents($upload_path, $image_base64);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();

    // Insert into studentinfo
    $insert_student = $conn->prepare("INSERT INTO `studentinfo`(`studentid`,`biometric_picture`) VALUES (?,?)");
    $insert_student->bind_param("ss",$username,$filename);

    if ($insert_student->execute()) {
        $_SESSION['success'] = "Student account created successfully";
    } else {
        $_SESSION['error'] = "Error creating student account";
    }

    header("Location: student_list.php");
    exit();
}
?>