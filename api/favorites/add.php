<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $movie_id = $_REQUEST["movie_id"];
        $user_id = null;

        $sql = "SELECT 
            id
        FROM Movie
        WHERE id = $movie_id;"

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $sql = "SELECT 
                id
            FROM Favorites
            WHERE user_id = $user_id;"

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                $sql_fav = "START TRANSACTION;

                    INSER INTO Favorites (user_id) 
                    VALUES ('$user_id');

                    SET @id := LAST_INSERT_ID();

                    INSERT INTO FavoritesItem (movie_id, favorites_id)
                    VALUES ('$movie_id', @id);

                    COMMIT;
                ";
                $insert = mysqli_query($conn, $sql);
            } else {
                $dados = mysqli_fetch_array($result);
                $favorites_id = $dados["id"]
                $sql_fav = "INSERT INTO FavoritesItem (movie_id, favorites_id)
                    VALUES ('$movie_id', '$favorites_id');";
            }
            $insert = mysqli_query($conn, $sql_fav);
            if ($insert) {
                echo "Filme adicionado a lista de favoritos com sucesso.";
            } else {
                echo "Erro ao adicionar filme a lista de favoritos.";
            }
        } else {
            echo "Filme não encontrado";
        }

    } else {
        echo "Método de requisição inválido."
    }
?>