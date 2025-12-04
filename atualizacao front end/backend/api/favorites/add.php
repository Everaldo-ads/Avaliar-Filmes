<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $movie_id = $_REQUEST["movie_id"];
        $user_id  = $_REQUEST["user_id"];

        $sql = "SELECT id FROM movie WHERE id = $movie_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            
            $sql = "SELECT id FROM favorites WHERE user_id = $user_id";
            $result = mysqli_query($conn, $sql);
            $favorites_id = null;

            
            if (mysqli_num_rows($result) == 0) {
                $sql_create = "INSERT INTO favorites (user_id) VALUES ('$user_id')";
                if (mysqli_query($conn, $sql_create)) {
                    $favorites_id = mysqli_insert_id($conn);
                }
            } else {
                
                $dados = mysqli_fetch_array($result);
                $favorites_id = $dados["id"];
            }

            
            $sql_fav = "INSERT INTO favoritesitem (movie_id, favorites_id) 
                        VALUES ('$movie_id', '$favorites_id')";
            
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
        echo "Método de requisição inválido.";
    }
?>