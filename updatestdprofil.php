<!DOCTYPE html>
<html>
    <head>
        <title>Update Profile Student - Student Attendance Data System</title>
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
            $query = "SELECT * FROM student WHERE UserId='$UserId'";
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
                $parentName = $row['ParentName'];
                $parentPhone = $row['ParentPhone'];
                $parentIncome = $row['ParentIncome'];
            } else {
                $name = "";
                $ic = "";
                $phone = "";
                $email = "";
                $race = "";
                $address = "";
                $parentName = "";
                $parentPhone = "";
                $parentIncome = "";
            }
        ?>
        <form name="form" method="post" action="prosessupdatestudent.php">
            <table id="indextable">
                <tr>
                    <td colspan="3">
                        <br>
                        <center>
                            <h1>
                                UPDATE PROFILE STUDENT
                            </h1>
                        </center>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Name 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="name" required placeholder="Student Name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student ID 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="id" required placeholder="Student ID" value="<?php echo htmlspecialchars($UserId); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student IC 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506" value="<?php echo htmlspecialchars($ic); ?>"readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Date Of Birth 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Age 
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
                        Student Gender 
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
                        Student State Of Birth 
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
                        Student Phone Number 
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
                        Student Email 
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
                        Student Race 
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
                        Student Address 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <textarea name="addrss" placeholder="address" required style="width: 170px; height: 113px;"><?php echo htmlspecialchars($address); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Parent Name 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="pname" required placeholder="Student Parent Name" value="<?php echo htmlspecialchars($parentName); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Parent Phone Number 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="pphone" pattern="[0-9]{3}-[0-9]{7,8}" required placeholder="012-3456789" value="<?php echo htmlspecialchars($parentPhone); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Parent Income
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <select name="pincome" required>
                            <option value="">Select Parent Income</option>
                            <option value="RM 0 - RM 1000" <?php if($parentIncome == 'RM 0 - RM 1000') echo 'selected'; ?>>RM 0 - RM 1000</option>
                            <option value="RM 1000 - RM 1500" <?php if($parentIncome == 'RM 1000 - RM 1500') echo 'selected'; ?>>RM 1001 - RM 1500</option>
                            <option value="RM 1501 - RM 2000" <?php if($parentIncome == 'RM 1501 - RM 2000') echo 'selected'; ?>>RM 1501 - RM 2000</option>
                            <option value="RM 2001 - RM 2500" <?php if($parentIncome == 'RM 2001 - RM 2500') echo 'selected'; ?>>RM 2001 - RM 2500</option>
                            <option value="RM 2501 - RM 3000" <?php if($parentIncome == 'RM 2501 - RM 3000') echo 'selected'; ?>>RM 2501 - RM 3000</option>
                            <option value="RM 3001 - RM 3500" <?php if($parentIncome == 'RM 3001 - RM 3500') echo 'selected'; ?>>RM 3001 - RM 3500</option>
                            <option value="RM 3501 - RM 4000" <?php if($parentIncome == 'RM 3501 - RM 4000') echo 'selected'; ?>>RM 3501 - RM 4000</option>
                            <option value="RM 4001 - RM 4500" <?php if($parentIncome == 'RM 4001 - RM 4500') echo 'selected'; ?>>RM 4001 - RM 4500</option>
                            <option value="RM 4501 - RM 5000" <?php if($parentIncome == 'RM 4501 - RM 5000') echo 'selected'; ?>>RM 4501 - RM 5000</option>
                            <option value="> RM 5001" <?php if($parentIncome == '> RM 5001') echo 'selected'; ?>>&gt; RM 5001</option>
                        </select>
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