<?php
    include_once("../config.inc.php");
    
    $sql = "CREATE TABLE IF NOT EXISTS `Favorites` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,

        FOREIGN KEY (user_id) REFERENCES User(id)
    );

    CREATE TABLE IF NOT EXISTS `FavoritesItem` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        movie_id INT NOT NULL,
        favorites_id INT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP

        FOREIGN KEY (movie_id) REFERENCES Movie(id)
        FOREIGN KEY (favorites_id) REFERENCES Favorites(id)
    );"

    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
