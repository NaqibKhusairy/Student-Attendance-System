<!DOCTYPE html>
<html>
<head>
    <title>Student - Student Attendance Data System</title>
    <script>
        function updateDateTime() {
            const now = new Date();
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            const dateTimeString = `${day}/${month}/${year} ${hours}:${minutes}`;
            document.getElementById('currentDateTime').textContent = dateTimeString;
        }

        setInterval(updateDateTime, 1000); // Update every second
    </script>
</head>
<body onload="updateDateTime()">
    <h1 id="currentDateTime">Current Date and Time (d/m/y H:m)</h1>
    <?php
        include('db/conection.php');
        $id = $_POST["id"];

        // Fix the query to fetch user name
        $query = "SELECT UserName FROM student WHERE UserId='$id'";
        $result = mysqli_query($conn, $query);

        // Fetch the user's name from the database
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['UserName'];
        } else {
            $name = "Unknown User";
        }
    ?>
    <form method="post" action="updatestdprofil.php">
        <h3>Welcome <?php echo htmlspecialchars($name); ?> <br>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <button type="submit">Update Your Profile</button>
    </form>
    <br><br>
    Your Class Attendance
    <br>
    <table border="1">
        <tr>
            <th>Bil</th>
            <th>Date & Time</th>
            <th>Name</th>
            <th>ID</th>
            <th>Category</th>
            <th>Attendance</th>
        </tr>
        <?php
        $attendanceQuery = "SELECT * FROM att WHERE UserId='$id'";
        $attendanceResult = mysqli_query($conn, $attendanceQuery);

        $counter = 1; // Initialize counter
        if ($attendanceResult && mysqli_num_rows($attendanceResult) > 0) {
            while ($row = mysqli_fetch_assoc($attendanceResult)): ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($row['aDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['UserName']); ?></td>
                    <td><?php echo htmlspecialchars($row['UserId']); ?></td>
                    <td><?php echo htmlspecialchars($row['UserCat']); ?></td>
                    <td><?php echo htmlspecialchars($row['UserAtt']); ?></td>
                </tr>
            <?php endwhile;
        } else {
            echo "<tr><td colspan='6'>No attendance records found</td></tr>";
        }
        ?>
    </table>
    <br><br>
    <center>
        <form method="post" action="logout.php">
            <input type="hidden" name="UserName" value="<?php echo htmlspecialchars($name); ?>">
            <button type="submit">LOGOUT</button>
        </form>
    </center>
</body>
</html>
