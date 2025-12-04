<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        session_start();

        if ($user_id = $_SESSION['user_id'] ?? false) {

            $movie_id  = $_REQUEST['movie_id'];
            $score     = $_REQUEST['score'];
            $message   = $_REQUEST['message'];
            $created_at = date("Y-m-d");

            if (!$movie_id) {
                echo "Erro ao criar review: movie_id necessário.";
            }
            else if (!$score) {
                echo "Erro ao criar review: score necessário.";
            }
            else if (!$message) {
                echo "Erro ao criar review: mensagem necessária.";
            } 
            else {

                $sql = "INSERT INTO review (user_id, movie_id, score, message, created_at) 
                    VALUES ('$user_id', '$movie_id', '$score', '$message', '$created_at')";

                $insert = mysqli_query($conn, $sql);

                if ($insert) {
                    echo "Review criada com sucesso!";
                } else {
                    echo "Erro ao criar review.";
                }
            }
        } else {
            echo "Erro ao criar review: usuário não autenticado.";
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>
