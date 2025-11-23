<?php
    include_once("../config.inc.php");
    
    $sql = "CREATE TABLE IF NOT EXISTS `User` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        nickname VARCHAR(100) NOT NULL,
        role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
        profile_image LONGBLOB,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS `Movie` (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        age_classification ENUM('L', '10', '12', '14', '16', '18') NOT NULL,
        name VARCHAR(255) NOT NULL,
        status VARCHAR(100) NOT NULL,
        release_date DATE NOT NULL,
        country VARCHAR(100) NOT NULL,
        duration INT UNSIGNED NOT NULL,
        budget FLOAT UNSIGNED NOT NULL,
    );
    
    CREATE TABLE IF NOT EXISTS `Review` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        movie_id INT NOT NULL,
        score FLOAT NOT NULL,
        message_ TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

        FOREIGN KEY (user_id) REFERENCES User(id),
        FOREIGN KEY (movie_id) REFERENCES Movie(id)
    );

    CREATE TABLE IF NOT EXISTS `Actor` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        birthdate DATE,
        biography TEXT,
        country VARCHAR(150) NOT NULL,
        profile_image LONGBLOB
    );"

    
    mysqli_query($conn, $sql);

    $mysqli_close($conn);
?>
