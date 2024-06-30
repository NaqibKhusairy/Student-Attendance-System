<?php
    $UserName = $_POST["UserName"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Out</title>
    <script>
        window.onload = function() {
            // Show the popup message
            alert("<?php echo $UserName?> , Loggin Out");

            // Redirect to index.php after 3 seconds
            setTimeout(function() {
                window.location.href = "index.php";
            }, 3000); // 2 seconds
        };
    </script>
</head>
<body>
    <p>Redirecting you to the login page...</p>
</body>
</html>
