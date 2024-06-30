<!DOCTYPE html>
<html>
    <head>
        <title>Add Staff - Student Attendance Data System</title>
    </head>
    <body>
        <?php
            include('db/conection.php');
            $UserId = $_POST["UserId"];
        ?>
        <form name="form" method="post" action="prosessaddstaff.php">
            <table id="indextable">
                <tr>
                    <td colspan="3">
                        <br>
                        <center>
                            <h1>
                                ADD STAFF
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
                        <input type="text" name="name" required placeholder="Staff Name">
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
                        <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506">
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
                        <input type="text" name="phone" pattern="[0-9]{3}-[0-9]{7,8}" required placeholder="012-3456789">
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
                        <input type="email" name="email" required placeholder="user@domain">
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
                            <option value="Malay">Malay</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Indian">Indian</option>
                            <option value="Others">Others</option>
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
                        <textarea name="addrss" placeholder="address" required style="width: 170px; height: 113px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center><button type="submit" class="resultButton">ADD STAFF</button></center>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>