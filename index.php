<!DOCTYPE html>
<html>
    <head>
        <title>Student Attendance Data System</title>
    </head>
    <body>
        <?php
            include('db/conection.php');
            include('db/addacc.php');
        ?>
        <center>
            <form name="form" method="post" action="login.php">
                <table id="indextable">
                    <tr>
                        <td>
                            <br>
                            <center>
                                <h1>
                                    LOGIN
                                </h1>
                            </center>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><input type="text" name="id" required placeholder="User ID"></center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><input type="password" name="password" required placeholder="Password"></center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><button type="submit" class="resultButton">LOGIN</button></center>
                        </td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>