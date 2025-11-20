<?php
    include_once("../config.inc.php");
    
    $sql = "CREATE TABLE IF NOT EXISTS `Genre` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    );
    
    CREATE TABLE IF NOT EXISTS `MovieGenre` (
        genre_id INT NOT NULL,
        movie_id INT NOT NULL,

        PRIMARY KEY (genre_id, movie_id),

        FOREIGN KEY (genre_id) REFERENCES Genre(id)
            ON DELETE CASCADE,
        FOREIGN KEY (movie_id) REFERENCES Movie(id)
            ON DELETE CASCADE
    );"
    mysqli_query($conn, $sql);

    $mysqli_close($conn);
?>
