<?php
    include_once("../config.inc.php");

    $sql = "CREATE TABLE IF NOT EXISTS `Review` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        movie_id INT NOT NULL,
        score FLOAT NOT NULL,
        message_ TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

        FOREIGN KEY (user_id) REFERENCES User(id),
        FOREIGN KEY (movie_id) REFERENCES Movie(id)
    );";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
