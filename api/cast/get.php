<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    header("Content-Type: application/json");

    $movie_id = $_GET["movie_id"];

    if (!$movie_id) {
        echo json_encode(["error" => "movie_id é obrigatório."]);
        exit;
    }

    $sql = "
        SELECT 
            Actor.id,
            Actor.name,
            Actor.birthdate,
            Actor.country,
            Actor.biography
        FROM Cast
        INNER JOIN CastActor ON CastActor.cast_id = Cast.id
        INNER JOIN Actor ON Actor.id = CastActor.actor_id
        WHERE Cast.movie_id = $movie_id;
    ";

    $result = mysqli_query($conn, $sql);

    $actors = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $actors[] = $row;
    }

    echo json_encode($actors);

} else {
    echo json_encode(["error" => "Método inválido."]);
}

mysqli_close($conn);
?>
