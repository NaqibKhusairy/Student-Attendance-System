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
    $pname = $_POST["pname"];
    $pphone = $_POST["pphone"];
    $pincome = $_POST["pincome"];
    if($pincome=="0-1000")
    {
        $pincome="RM 0 - RM 1000";
    }
    else if($pincome=="1000-1500")
    {
        $pincome="RM 1001 - RM 1500";
    }
    else if($pincome=="1501-2000")
    {
        $pincome="RM 1501 - RM 2000";
    }
    else if($pincome=="2001-2500")
    {
        $pincome="RM 2001 - RM 2500";
    }
    else if($pincome=="2501-3000")
    {
        $pincome="RM 2501 - RM 3000";
    }
    else if($pincome=="3001-3500")
    {
        $pincome="RM 3001 - RM 3500";
    }
    else if($pincome=="3501-4000")
    {
        $pincome="RM 5501 - RM 4000";
    }
    else if($pincome=="4001-4500")
    {
        $pincome="RM 4001 - RM 4500";
    }
    else if($pincome=="4501-5000")
    {
        $pincome="RM 4501 - RM5000";
    }
    else if($pincome==">5001")
    {
        $pincome="> RM 5001";
    }

    $sql = "INSERT INTO student (UserName, UserId, UserIc, UserDOB, UserAge, UserGender, UserSOB, UserPhone, UserEmail, UserRace, UserAdd, ParentName, ParentPhone, ParentIncome)
            VALUES ('$name', '$id', '$ic', '$dob', '$age', '$gender', '$sob', '$phone', '$email', '$race', '$addrss', '$pname', '$pphone', '$pincome')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>