<!DOCTYPE html>
<html>
<head>
    <title>Attendance Updated</title>
    <script>
        window.onload = function() {
            // Show the popup message
            alert("Attendance updated successfully. Login for your next class.");

            // Redirect to index.php after 3 seconds
            setTimeout(function() {
                window.location.href = "index.php";
            }, 2000); // 2 seconds
        };
    </script>
</head>
<body>
    <p>Redirecting you to the login page...</p>
</body>
</html>
