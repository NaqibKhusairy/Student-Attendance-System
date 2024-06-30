<?php
    // Create the "projectimg" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS acc (
        id INT AUTO_INCREMENT PRIMARY KEY,
        UserId VARCHAR(255) NOT NULL,
        UserPass VARCHAR(255) NOT NULL,
        UserCat VARCHAR(255) NOT NULL
    )";

    if ($conn->query($createTableSQL) === false) {
    }

    // Create the "student" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        UserName VARCHAR(255) NOT NULL,
        UserId VARCHAR(255) NOT NULL,
        UserIc VARCHAR(12) NOT NULL,
        UserDOB VARCHAR(255) NOT NULL,
        UserAge VARCHAR(255) NOT NULL,
        UserGender VARCHAR(6) NOT NULL,
        UserSOB VARCHAR(255) NOT NULL,
        UserPhone VARCHAR(255) NOT NULL,
        UserEmail VARCHAR(255) NOT NULL,
        UserRace VARCHAR(255) NOT NULL,
        UserAdd VARCHAR(255) NOT NULL,
        ParentName VARCHAR(255) NOT NULL,
        ParentPhone VARCHAR(255) NOT NULL,
        ParentIncome VARCHAR(255) NOT NULL
    )";

    if ($conn->query($createTableSQL) === false) {
    }

    // Create the "staff" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS staff (
        id INT AUTO_INCREMENT PRIMARY KEY,
        UserName VARCHAR(255) NOT NULL,
        UserId VARCHAR(255) NOT NULL,
        UserIc VARCHAR(12) NOT NULL,
        UserDOB VARCHAR(255) NOT NULL,
        UserAge VARCHAR(255) NOT NULL,
        UserGender VARCHAR(6) NOT NULL,
        UserSOB VARCHAR(255) NOT NULL,
        UserPhone VARCHAR(255) NOT NULL,
        UserEmail VARCHAR(255) NOT NULL,
        UserRace VARCHAR(255) NOT NULL,
        UserAdd VARCHAR(255) NOT NULL
    )";

    if ($conn->query($createTableSQL) === false) {
    }

    // Create the "att" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS att (
        id INT AUTO_INCREMENT PRIMARY KEY,
        aDate VARCHAR(255) NOT NULL,
        UserName VARCHAR(255) NOT NULL,
        UserId VARCHAR(255) NOT NULL,
        UserCat VARCHAR(255) NOT NULL,
        UserAtt VARCHAR(255) NOT NULL
    )";

    if ($conn->query($createTableSQL) === false) {
    }

    //insert administrator account if not exists
    $UserId = "admin";
    $UserPass = "admin";
    $UserCat = "admin";
    
    // Check if the admin account already exists
    $checkAdminSQL = "SELECT * FROM acc WHERE UserId=?";
    $stmt = $conn->prepare($checkAdminSQL);
    $stmt->bind_param("s", $UserId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert admin account
        $insertAdminSQL = "INSERT INTO acc (UserId, UserPass, UserCat) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertAdminSQL);
        $stmt->bind_param("sss", $UserId, $UserPass, $UserCat);
        if ($stmt->execute() === false) {
            echo "Error inserting data: " . $stmt->error;
        }
    }
?>