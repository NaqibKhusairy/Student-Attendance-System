<?php
include('db/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserId = $_POST["id"];
    $name = $_POST["name"];
    $ic = $_POST["ic"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $race = $_POST["race"];
    $address = $_POST["addrss"];
    $parentName = $_POST["pname"];
    $parentPhone = $_POST["pphone"];
    $parentIncome = $_POST["pincome"];
    $id = $UserId;

    // Update query
    $query = "UPDATE student 
              SET UserName='$name', UserIc='$ic', UserPhone='$phone', UserEmail='$email', UserRace='$race', UserAdd='$address', ParentName='$parentName', ParentPhone='$parentPhone', ParentIncome='$parentIncome' 
              WHERE UserId='$UserId'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<!DOCTYPE html>
              <html>
              <head>
                  <title>Student Profile Updated</title>
                  <script>
                      window.onload = function() {
                          // Show the popup message
                          alert('Student profile updated successfully. Login for your next class.');

                          // Redirect to student.php after 2 seconds
                          setTimeout(function() {
                              // Create a form and submit it to student.php
                              var form = document.createElement('form');
                              form.method = 'POST';
                              form.action = 'student.php';

                              // Create a hidden input field
                              var input = document.createElement('input');
                              input.type = 'hidden';
                              input.name = 'id';
                              input.value = '$id';

                              // Append the input field to the form
                              form.appendChild(input);

                              // Append the form to the body and submit the form
                              document.body.appendChild(form);
                              form.submit();
                          }, 2000); // 2 seconds
                      };
                  </script>
              </head>
              <body>
                  <p>Redirecting you to the Student page...</p>
              </body>
              </html>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
