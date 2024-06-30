<?php
include('db/conection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance = $_POST['attendance'];
    $currentDateTime = $_POST['currentDateTime'];

    // Fetch all student names
    $studentNames = [];
    $studentQuery = "SELECT UserId, UserName FROM student";
    $studentResult = mysqli_query($conn, $studentQuery);
    if ($studentResult && mysqli_num_rows($studentResult) > 0) {
        while ($row = mysqli_fetch_assoc($studentResult)) {
            $studentNames[$row['UserId']] = $row['UserName'];
        }
    }

    // Loop through the attendance array and update each student's attendance
    foreach ($attendance as $studentId => $status) {
        $studentName = isset($studentNames[$studentId]) ? $studentNames[$studentId] : 'Unknown';

        // Now, update the attendance table with StudentName, Status, DateTime, and StudentId
        $query = "INSERT INTO att (UserId, UserName, UserAtt, aDate, UserCat) VALUES (?, ?, ?, ?, 'Student') ON DUPLICATE KEY UPDATE UserAtt=?, aDate=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssssss', $studentId, $studentName, $status, $currentDateTime, $status, $currentDateTime);
        
        // Execute the query
        mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Attendance updated successfully for student ID: $studentId<br>";
        } else {
            echo "Failed to update attendance for student ID: $studentId<br>";
        }

        mysqli_stmt_close($stmt);
    }

    // Close the connection
    mysqli_close($conn);

    // Redirect back to the attendance page
    header("Location: popupatt.php"); // Replace 'studentattendent.php' with your actual page
    exit;
} else {
    echo "Invalid request.";
}
?>
