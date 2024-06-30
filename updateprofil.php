<!DOCTYPE html>
<html>
    <head>
        <title>Update Profile Staff - Student Attendance Data System</title>
        <style>
            input[readonly] {
                cursor: not-allowed;
            }
        </style>
    </head>
    <body>
        <?php
            include('db/conection.php');
            $UserId = $_POST["id"];

            // Query to fetch existing student data
            $query = "SELECT * FROM staff WHERE UserId='$UserId'";
            $result = mysqli_query($conn, $query);

            // Fetch the student data if exists
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['UserName'];
                $ic = $row['UserIc'];
                $dob = $row['UserDOB'];
                $age = $row['UserAge'];
                $gender = $row['UserGender'];
                $sob = $row['UserSOB'];
                $phone = $row['UserPhone'];
                $email = $row['UserEmail'];
                $race = $row['UserRace'];
                $address = $row['UserAdd'];
            } else {
                $name = "";
                $ic = "";
                $phone = "";
                $email = "";
                $race = "";
                $address = "";
            }
        ?>
        <form name="form" method="post" action="prosessupdatestaff.php">
            <table id="indextable">
                <tr>
                    <td colspan="3">
                        <br>
                        <center>
                            <h1>
                                UPDATE PROFILE STAFF
                            </h1>
                        </center>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Name 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                    <input type="text" name="name" required placeholder="Staff Name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff ID 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="id" required placeholder="Staff ID" value="<?php echo $UserId;?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff IC 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506" value="<?php echo htmlspecialchars($ic); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Date Of Birth 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="dob" value="<?php echo htmlspecialchars($dob); ?>"required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Age 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Gender 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="gender" value="<?php echo htmlspecialchars($gender); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff State Of Birth 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="sob" value="<?php echo htmlspecialchars($sob); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Phone Number 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="phone" pattern="[0-9]{3}-[0-9]{7,8}" required placeholder="012-3456789" value="<?php echo htmlspecialchars($phone); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Email 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="email" name="email" required placeholder="user@domain" value="<?php echo htmlspecialchars($email); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Race 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <select name="race" required>
                            <option value="">Select Race</option>
                            <option value="Malay" <?php if($race == 'Malay') echo 'selected'; ?>>Malay</option>
                            <option value="Chinese" <?php if($race == 'Chinese') echo 'selected'; ?>>Chinese</option>
                            <option value="Indian" <?php if($race == 'Indian') echo 'selected'; ?>>Indian</option>
                            <option value="Others" <?php if($race == 'Others') echo 'selected'; ?>>Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Address 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <textarea name="addrss" placeholder="address" required style="width: 170px; height: 113px;"><?php echo htmlspecialchars($address); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center><button type="submit" class="resultButton">UPDATE PROFILE</button></center>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>