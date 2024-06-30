<!DOCTYPE html>
<html>
    <head>
        <title>Add Student - Student Attendance Data System</title>
    </head>
    <body>
        <?php
            include('db/conection.php');
            $UserId = $_POST["UserId"];
        ?>
        <form name="form" method="post" action="prosessaddstudent.php">
            <table id="indextable">
                <tr>
                    <td colspan="3">
                        <br>
                        <center>
                            <h1>
                                ADD STUDENT
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
                        <input type="text" name="name" required placeholder="Student Name">
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
                        <input type="text" name="id" required placeholder="Student ID" value="<?php echo $UserId;?>" readonly>
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
                        <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506">
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
                        <input type="text" name="phone" pattern="[0-9]{3}-[0-9]{7,8}" required placeholder="012-3456789">
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
                        <input type="email" name="email" required placeholder="user@domain">
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
                            <option value="Malay">Malay</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Indian">Indian</option>
                            <option value="Others">Others</option>
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
                        <textarea name="addrss" placeholder="address" required style="width: 170px; height: 113px;"></textarea>
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
                        <input type="text" name="pname" required placeholder="Student Parent Name">
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
                        <input type="text" name="pphone" pattern="[0-9]{3}-[0-9]{7,8}" required placeholder="012-3456789">
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
                            <option value="0-1000">RM 0 - RM 1000</option>
                            <option value="1000-1500">RM 1001 - RM 1500</option>
                            <option value="1501-2000">RM 1501 - RM 2000</option>
                            <option value="2001-2500">RM 2001 - RM 2500</option>
                            <option value="2501-3000">RM 2501 - RM 3000</option>
                            <option value="3001-3500">RM 3001 - RM 3500</option>
                            <option value="3501-4000">RM 5501 - RM 4000</option>
                            <option value="4001-4500">RM 4001 - RM 4500</option>
                            <option value="4501-5000">RM 4501 - RM5000</option>
                            <option value=">5001"> &gt; RM 5001</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center><button type="submit" class="resultButton">ADD STUDENT</button></center>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>