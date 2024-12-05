<?php session_start();
date_default_timezone_set('Asia/Manila');
$student_id = $_SESSION["username"];
include "../include/connection.php";
include "../include/session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Admin</title>
    <style>
        body {
            margin: 0;
            border: 0;
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

        .content-card {
            width: 500px;
        }

        .card-container {
            width: 100%;

            align-items: center;
            gap: 1rem;
            display: flex;
        }

        .sidebar-container {
            width: 300px;
            height: 200vh;
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

        .nav-item [name="student-list"] {
            border-radius: 8px;
            margin-bottom: 4px;
            background-color: rgba(82, 110, 72, 1);
            color: white;

        }

        .nav-item [name="student-list"]:hover {
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

        .container {
            height: 150px;
            /* Set a fixed height for the container */
            overflow: auto;
            /* Enable vertical scroll when content exceeds the height */
        }

        .webcam-container {
            margin-bottom: 10px;
        }

        #webcam, #profile, #canvas {
            width: 320px;
            height: 240px;
            border-radius: 8px;
            border: 2px solid #ddd;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <div class="container-fluid">
        <div class="main-container">
            <div class="sidebar-container">
                <div class="sidebar-content">
                    <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title=""
                       data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <img src="../src/images/large_logo.png" class="img-fluid" alt="...">

                    </a>
                    <h3 style="margin-left: 1rem;">Admin Portal</h3>
                    <br>
                    <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto justify-content-between w-100 px-3"
                        style="align-items:start; text-align:left;">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link" title="" data-bs-toggle="tooltip"
                               data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="bi bi-house-fill fs-5"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_list.php" class="nav-link " title="" data-bs-toggle="tooltip"
                               name="student-list" data-bs-placement="right" data-bs-original-title="Student List">
                                <i class="bi bi-folder-fill fs-5"></i> Student List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="announcement.php" class="nav-link" title="" data-bs-toggle="tooltip"
                               data-bs-placement="right" data-bs-original-title="Announcement" name="announcement">
                                <i class="bi bi-clock-fill fs-5"></i> Announcement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="register.php" class="nav-link" title="" data-bs-toggle="tooltip"
                               data-bs-placement="right" data-bs-original-title="Announcement" name="register">
                                <i class="bi bi-list-ul fs-5"></i> Register
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="settings.php" class="nav-link" title="" data-bs-toggle="tooltip"
                               data-bs-placement="right" data-bs-original-title="Announcement" name="settings">
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
                <!-- content -->
                <div class="container-xxl">
                    <h1>Create New Student Account</h1>
                    <hr>

                    <div class="" style="width: 100%; margin-top: 1rem;">
                        <div class="card-body">
                            <form class="form" action="post_add_student.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                           <div class="form-group mb-2">
    <label for="username">Username</label>
    <div class="input-group">
        <input type="text" name="username" id="username" class="form-control" required placeholder="Username" pattern="\d{2}-\d{2}-\d{3}" title="Format: YY-YY-XXX (e.g. 21-22-227)"/>
        <button type="button" class="btn btn-secondary" id="refreshUsername">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>
</div>
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required placeholder="Password" />
                                </div>
                                <div class="form-group mb-2">
                                    <label for="picture">Picture</label>
                                    <div class="webcam-container">
                                        <video id="webcam" autoplay playsinline></video>
                                        <canvas id="canvas" style="display: none;"></canvas>
                                        <img src="../src/images/default.png" alt="profile" id="profile"/>
                                    </div>
                                    <input type="hidden" name="image_data" id="image_data">
                                    <button type="button" class="btn btn-primary mt-2" id="capture">Capture Photo</button>
                                    <button type="button" class="btn btn-secondary mt-2" id="retake" style="display:none;">Retake</button>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>



            <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                    crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function() {
    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const profile = document.getElementById('profile');
    const captureBtn = document.getElementById('capture');
    const retakeBtn = document.getElementById('retake');
    let stream = null;

    // Set canvas size
    canvas.width = 320;
    canvas.height = 240;

    // Start webcam
    async function startWebcam() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ 
                video: true, 
                audio: false 
            });
            video.srcObject = stream;
            video.style.display = 'block';
            profile.style.display = 'none';
        } catch (err) {
            console.error("Error accessing webcam:", err);
        }
    }

    startWebcam();

    // Capture photo
    captureBtn.addEventListener('click', function() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/jpeg');
        profile.src = imageData;
        document.getElementById('image_data').value = imageData;
        
        video.style.display = 'none';
        profile.style.display = 'block';
        captureBtn.style.display = 'none';
        retakeBtn.style.display = 'inline-block';
        
        // Stop webcam
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
    });

    // Retake photo
    retakeBtn.addEventListener('click', function() {
        startWebcam();
        profile.style.display = 'none';
        captureBtn.style.display = 'inline-block';
        retakeBtn.style.display = 'none';
    });

        function generateUsername() {
        // Get current year's last 2 digits
        const currentYear = new Date().getFullYear() % 100;
        const prevYear = currentYear - 1;
        
        // Generate random 3 digit number
        const randomNum = Math.floor(Math.random() * 900) + 100; // generates number between 100-999
        
        // Format: YY-YY-XXX
        return `${prevYear}-${currentYear}-${randomNum}`;
    }

    // Set initial username
    $('#username').val(generateUsername());

    // Refresh button click handler
    $('#refreshUsername').click(function() {
        $('#username').val(generateUsername());
    });
});
</script>
</body>

</html>