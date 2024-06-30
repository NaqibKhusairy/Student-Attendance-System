<?php
    // Include the database connection file
    include('db/conection.php');

    // Initialize variables for error and success messages
    $errorMsg = '';
    $successMsg = '';

    // Handle form submission for adding a new user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
        $UserId = $_POST["UserId"];
        $UserPass = $_POST["UserPass"];
        $UserCat = $_POST["UserCat"];

        // Check if the UserId already exists
        $checkUserIdSQL = "SELECT * FROM acc WHERE UserId=?";
        $stmt = $conn->prepare($checkUserIdSQL);
        $stmt->bind_param("s", $UserId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMsg = "User ID already exists. Please choose a different User ID.";
        } else {
            $stmt->close();

            // Insert new user
            $insertUserSQL = "INSERT INTO acc (UserId, UserPass, UserCat) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertUserSQL);
            $stmt->bind_param("sss", $UserId, $UserPass, $UserCat);
            if ($stmt->execute()) {
                // Redirect to appropriate page based on UserCat using a hidden form and JavaScript
                $redirectURL = ($UserCat == 'staff') ? 'addstaff.php' : (($UserCat == 'student') ? 'addstudent.php' : '');
                if (!empty($redirectURL)) {
                    echo "<form id='redirectForm' method='POST' action='$redirectURL'>
                            <input type='hidden' name='UserId' value='$UserId'>
                        </form>
                        <script type='text/javascript'>
                            document.getElementById('redirectForm').submit();
                        </script>";
                    exit();
                }
                $successMsg = "User added successfully.";
            } else {
                $errorMsg = "Error adding user: " . $stmt->error;
            }
        }
        $stmt->close();
    }

    // Handle form submission for editing a user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
        $id = $_POST["id"];
        $UserId = $_POST["UserId"];
        $UserPass = $_POST["UserPass"];
        $UserCat = $_POST["UserCat"];

        // Check if the new UserId already exists for another user
        $checkUserIdSQL = "SELECT * FROM acc WHERE UserId=? AND id<>?";
        $stmt = $conn->prepare($checkUserIdSQL);
        $stmt->bind_param("si", $UserId, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMsg = "User ID already exists. Please choose a different User ID.";
        } else {
            $stmt->close();

            // Update user
            $updateUserSQL = "UPDATE acc SET UserId=?, UserPass=?, UserCat=? WHERE id=?";
            $stmt = $conn->prepare($updateUserSQL);
            $stmt->bind_param("sssi", $UserId, $UserPass, $UserCat, $id);
            if ($stmt->execute()) {
                $successMsg = "User updated successfully.";
            } else {
                $errorMsg = "Error updating user: " . $stmt->error;
            }
        }
        $stmt->close();
    }

    // Handle form submission for deleting a user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_user"])) {
        $id = $_POST["id"];

        // Fetch UserCat and UserId before deletion
        $getUserInfoSQL = "SELECT UserCat, UserId FROM acc WHERE id=?";
        $stmt = $conn->prepare($getUserInfoSQL);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($UserCat, $UserId);
        $stmt->fetch();
        $stmt->close();

        // Delete user from acc table
        $deleteUserSQL = "DELETE FROM acc WHERE id=?";
        $stmt = $conn->prepare($deleteUserSQL);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $successMsg = "User deleted successfully.";
        } else {
            $errorMsg = "Error deleting user: " . $stmt->error;
        }
        $stmt->close();

        // Delete user from student table if UserCat=student
        if ($UserCat == 'student') {
            $deleteStudentSQL = "DELETE FROM student WHERE UserId=?";
            $stmt = $conn->prepare($deleteStudentSQL);
            $stmt->bind_param("s", $UserId);
            $stmt->execute();
            $stmt->close();
        }

        // Delete user from staff table if UserCat=staff
        if ($UserCat == 'staff') {
            $deleteStaffSQL = "DELETE FROM staff WHERE UserId=?";
            $stmt = $conn->prepare($deleteStaffSQL);
            $stmt->bind_param("s", $UserId);
            $stmt->execute();
            $stmt->close();
        }

        // Delete user's attendance records from att table
        $deleteAttSQL = "DELETE FROM att WHERE UserId=?";
        $stmt = $conn->prepare($deleteAttSQL);
        $stmt->bind_param("s", $UserId);
        $stmt->execute();
        $stmt->close();
    }

    // Fetch all users from the database
    $result = $conn->query("SELECT * FROM acc");

    // Fetch acc , students, staff, and attendance data
    $acc = $conn->query("SELECT * FROM acc");
    $students = $conn->query("SELECT * FROM student");
    $staff = $conn->query("SELECT * FROM staff");
    $attendance = $conn->query("SELECT * FROM att");

    // Search functionality
    $searchUserId = '';
    $searchStudent = '';
    $searchStaff = '';
    $searchAttendanceDate = '';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['search_UserId'])) {
            $searchUserId = $_GET['search_UserId'];
            $acc = $conn->query("SELECT * FROM acc WHERE UserId LIKE '%$searchUserId%'");
        }
        if (isset($_GET['search_student'])) {
            $searchStudent = $_GET['search_student'];
            $students = $conn->query("SELECT * FROM student WHERE UserName LIKE '%$searchStudent%'");
        }
        if (isset($_GET['search_staff'])) {
            $searchStaff = $_GET['search_staff'];
            $staff = $conn->query("SELECT * FROM staff WHERE UserName LIKE '%$searchStaff%'");
        }
        if (isset($_GET['search_attendance_date'])) {
            $searchAttendanceDate = $_GET['search_attendance_date'];
            $attendance = $conn->query("SELECT * FROM att WHERE aDate LIKE '%$searchAttendanceDate%'");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Manage Users</title>
    </head>
    <body>

        <h2>Add New User</h2>
        <form method="post" action="admin.php">
            <input type="hidden" name="add_user" value="1">
            <table>
                <tr>
                    <td>
                        User ID
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <input type="text" id="UserId" name="UserId" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                    <input type="password" id="UserPass" name="UserPass" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Category
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <select id="UserCat" name="UserCat" required>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="student">Student</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center><button type="submit">Add User</button></center>
                    </td>
                </tr>
            </table>
        </form>

        <h2>Existing Users</h2>
        <form method="get" action="admin.php">
            <label for="search_UserId">Search User ID:</label>
            <input type="text" id="search_UserId" name="search_UserId" value="<?php echo htmlspecialchars($searchUserId); ?>">
            <button type="submit">Search</button>
        </form>
        <br>
        <table border="1">
            <tr>
                <th>Bil</th>
                <th>User ID</th>
                <th>Password</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
                <?php 
                    $rowNumber = 1;
                    while ($row = $acc->fetch_assoc()): 
                        if ($row['UserCat'] != 'admin'): ?>
                            <tr>
                                <form method="post" action="admin.php">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <td><?php echo $rowNumber; ?></td>
                                    <td><input type="text" name="UserId" value="<?php echo $row['UserId']; ?>" required readonly></td>
                                    <td><input type="text" name="UserPass" value="<?php echo $row['UserPass']; ?>" required></td>
                                    <td><input type="text" name="UserCat" value="<?php echo $row['UserCat']; ?>" required readonly></td>
                                    <td>
                                        <button type="submit" name="edit_user">Edit</button>
                                        <button type="submit" name="delete_user" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                    </td>
                                </form>
                            </tr>
                        <?php 
                            $rowNumber++;
                        endif; 
                    endwhile; 
                ?>
        </table>

        <h2>View Students</h2>
        <form method="get" action="admin.php">
            <label for="search_student">Search Student Name:</label>
            <input type="text" id="search_student" name="search_student" value="<?php echo htmlspecialchars($searchStudent); ?>">
            <button type="submit">Search</button>
        </form>
        <br>
        <table border="1">
            <tr>
                <th>Bil</th>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Student IC</th>
                <th>Date Of Birth</th>
                <th>Age</th>
                <th>Gender</th>
                <th>State Of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Race</th>
                <th>Address</th>
                <th>Parent Name</th>
                <th>Parent Phone</th>
                <th>Parent Income</th>
            </tr>
            <?php
            $counter = 1;
            while ($row = $students->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['UserName']; ?></td>
                    <td><?php echo $row['UserId']; ?></td>
                    <td><?php echo $row['UserIc']; ?></td>
                    <td><?php echo $row['UserDOB']; ?></td>
                    <td><?php echo $row['UserAge']; ?></td>
                    <td><?php echo $row['UserGender']; ?></td>
                    <td><?php echo $row['UserSOB']; ?></td>
                    <td><?php echo $row['UserPhone']; ?></td>
                    <td><?php echo $row['UserEmail']; ?></td>
                    <td><?php echo $row['UserRace']; ?></td>
                    <td><?php echo $row['UserAdd']; ?></td>
                    <td><?php echo $row['ParentName']; ?></td>
                    <td><?php echo $row['ParentPhone']; ?></td>
                    <td><?php echo $row['ParentIncome']; ?></td>
                </tr>
            <?php
            $counter++;
            endwhile;
            ?>
        </table>

        <h2>View Staff</h2>
        <form method="get" action="admin.php">
            <label for="search_staff">Search Staff Name:</label>
            <input type="text" id="search_staff" name="search_staff" value="<?php echo htmlspecialchars($searchStaff); ?>">
            <button type="submit">Search</button>
        </form>
        <br>
        <table border="1">
            <tr>
                <th>Bil</th>
                <th>Staff Name</th>
                <th>Staff ID</th>
                <th>Staff IC</th>
                <th>Date Of Birth</th>
                <th>Age</th>
                <th>Gender</th>
                <th>State Of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Race</th>
                <th>Address</th>
            </tr>
            <?php
            $counter = 1;
            while ($row = $staff->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['UserName']; ?></td>
                    <td><?php echo $row['UserId']; ?></td>
                    <td><?php echo $row['UserIc']; ?></td>
                    <td><?php echo $row['UserDOB']; ?></td>
                    <td><?php echo $row['UserAge']; ?></td>
                    <td><?php echo $row['UserGender']; ?></td>
                    <td><?php echo $row['UserSOB']; ?></td>
                    <td><?php echo $row['UserPhone']; ?></td>
                    <td><?php echo $row['UserEmail']; ?></td>
                    <td><?php echo $row['UserRace']; ?></td>
                    <td><?php echo $row['UserAdd']; ?></td>
                </tr>
            <?php
            $counter++;
            endwhile;
            ?>
        </table>

        <h2>View Attendance</h2>
        <form method="get" action="admin.php">
            <label for="search_attendance_date">Search Attendance Date:</label>
            <input type="text" id="search_attendance_date" name="search_attendance_date" value="<?php echo htmlspecialchars($searchAttendanceDate); ?>">
            <button type="submit">Search</button>
        </form>
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
            $counter = 1; // Initialize counter
            while ($row = $attendance->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['aDate']; ?></td>
                    <td><?php echo $row['UserName']; ?></td>
                    <td><?php echo $row['UserId']; ?></td>
                    <td><?php echo $row['UserCat']; ?></td>
                    <td><?php echo $row['UserAtt']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <?php
        // Close the database connection
        $conn->close();
        ?>
        <br><br>
        <center>
            <form method="post" action="logout.php">
                <input type="hidden" name="UserName" value="admin">
                <button type="submit">LOGOUT</button>
            <form>
        </center>
    </body>
</html>
