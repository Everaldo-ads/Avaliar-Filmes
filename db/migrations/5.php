<?php
    include_once("../config.inc.php");

    $sql = "
    CREATE TABLE IF NOT EXISTS `Cast` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        movie_id INT NOT NULL,
        FOREIGN KEY (movie_id) REFERENCES Movie(id)
    );

    CREATE TABLE IF NOT EXISTS `CastActor` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cast_id INT NOT NULL,
        actor_id INT NOT NULL,
        FOREIGN KEY (cast_id) REFERENCES `Cast`(id),
        FOREIGN KEY (actor_id) REFERENCES Actor(id)
    );
    ";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
