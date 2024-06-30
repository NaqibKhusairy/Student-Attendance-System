<?php
    include('db/conection.php');

    $name = $_POST["name"];
    $id = $_POST["id"];
    $ic = $_POST["ic"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $sob = $_POST["sob"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $race = $_POST["race"];
    $addrss = $_POST["addrss"];

    $sql = "INSERT INTO staff (UserName, UserId, UserIc, UserDOB, UserAge, UserGender, UserSOB, UserPhone, UserEmail, UserRace, UserAdd)
            VALUES ('$name', '$id', '$ic', '$dob', '$age', '$gender', '$sob', '$phone', '$email', '$race', '$addrss')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
