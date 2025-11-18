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
    );"
    msqli_query($conn, $sql);
    $mysqli_close($conn);
?>