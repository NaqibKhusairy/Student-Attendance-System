<!DOCTYPE html>
<html>
    <head>
        <title>Login - Student Attendance Data System</title>
    </head>
    <body>
        <?php
            include('db/conection.php');
            $id = $_POST["id"];
            $password = $_POST["password"];
            // Prepare and execute the SQL query
            $stmt = $conn->prepare("SELECT UserCat FROM acc WHERE UserId=? AND UserPass=?");
            $stmt->bind_param("ss", $id, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a record was found
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $userCat = $row["UserCat"];

                // Redirect based on UserCat
                if ($userCat == "admin") {
                    echo "<form id='redirectForm' action='admin.php' method='post'>
                            <input type='hidden' name='id' value='$id'>
                          </form>";
                } elseif ($userCat == "staff") {
                    echo "<form id='redirectForm' action='staff.php' method='post'>
                            <input type='hidden' name='id' value='$id'>
                          </form>";
                } elseif ($userCat == "student") {
                    echo "<form id='redirectForm' action='student.php' method='post'>
                            <input type='hidden' name='id' value='$id'>
                          </form>";
                } else {
                    echo "Invalid user category.";
                }
                // Include this for default redirection to staff.php if $userCat doesn't match
                if (!isset($userCat) || !in_array($userCat, ["admin", "staff", "student"])) {
                    echo "<form id='redirectForm' action='staff.php' method='post'>
                            <input type='hidden' name='id' value='$id'>
                        </form>";
                }
                // Automatically submit the form
                echo "<script type='text/javascript'>
                document.getElementById('redirectForm').submit();
                </script>";
            } else {
                echo "Invalid login credentials.";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        ?>
    </body>
</html>