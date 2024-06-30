<!DOCTYPE html>
<html>
<head>
    <title>Staff - Student Attendance Data System</title>
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
            document.getElementById('dateTimeInput').value = dateTimeString;
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
        $query = "SELECT UserName FROM staff WHERE UserId='$id'";
        $result = mysqli_query($conn, $query);

        // Fetch the user's name from the database
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['UserName'];
        } else {
            $name = "Unknown User";
        }
    ?>
    <form method="post" action="updateprofil.php">
        <h3>Welcome <?php echo htmlspecialchars($name); ?> <br>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <button type="submit">Update Your Profile</button>
    </form>
    <br><br>
    Student Class Attendance
    <form method="post" action="updateAttendance.php">
        <input type="hidden" id="dateTimeInput" name="currentDateTime" readonly>
        <table>
            <tr>
                <th style="padding-right: 10px; padding-top: 2px; padding-bottom: 3px; border: 1px solid black;">Student Name</th>
                <th style="padding-right: 10px; padding-top: 2px; padding-bottom: 3px; border: 1px solid black;">Student ID</th>
                <th style="padding-left: 10px; padding-right: 10px; padding-top: 2px; padding-bottom: 3px; border: 1px solid black;">Attendance</th>
            </tr>
            <?php
                // Query to fetch all students
                $studentQuery = "SELECT * FROM student";
                $studentResult = mysqli_query($conn, $studentQuery);

                // Check if there are any students
                if ($studentResult && mysqli_num_rows($studentResult) > 0) {
                    while ($studentRow = mysqli_fetch_assoc($studentResult)) {
                        echo "<tr>";
                        echo "<td style='padding-right: 10px; padding-top: 2px; padding-bottom: 3px; border: 1px solid black;'>" . htmlspecialchars($studentRow['UserName']) . "</td>";
                        echo "<td style='padding-right: 10px; padding-top: 2px; padding-bottom: 3px; border: 1px solid black;'>" . htmlspecialchars($studentRow['UserId']) . "</td>";
                        echo "<td style='padding-left: 10px; padding-right: 10px; padding-top: 2px; padding-bottom: 3px; border: 1px solid black;'>
                                <center><select name='attendance[" . htmlspecialchars($studentRow['UserId']) . "]' required>
                                    <option value=''>Please Choose</option>
                                    <option value='Hadir'>Hadir</option>
                                    <option value='Tidak Hadir'>Tidak Hadir</option>
                                </select></center>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No students found</td></tr>";
                }
            ?>
            <tr>
                <td colspan= "3">
                    <center><button type="submit">Update Attendance</button></center>
                </td>
            </tr>
        </table>
    </form>
    <center>
        <br><br>
        <form method="post" action="logout.php">
            <input type="hidden" name="UserName" value="<?php echo $name;?>">
            <button type="submit">LOGOUT</button>
        <form>
    </center>
</body>
</html>