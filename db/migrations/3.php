<?php
    include_once("../config.inc.php");
    
    $sql = "CREATE TABLE IF NOT EXISTS `MovieImage` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        movie_id INT NOT NULL,
        content LONGBLOB

        FOREIGN KEY (movie_id) REFERENCES Movie(id)
    );"

    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
