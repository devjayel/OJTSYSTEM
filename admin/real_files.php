 <?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    include '../include/connection.php';
    include('../include/session.php');
   $student_id = $_SESSION['studentid'];
   



    $query = 'SELECT COUNT(studentid) as total FROM files WHERE studentid = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_of_rows = $result->num_rows;
    $row = $result->fetch_assoc();
    echo '<p class="card-title">' . $row['total'] . ' </p>';
    ?>