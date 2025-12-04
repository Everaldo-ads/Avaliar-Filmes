<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        session_start();
        if ($user_id = $_SESSION['user_id'] ?? false) {
            $sql = "
                SELECT r.id, r.score, r.message, r.created_at, m.name AS movie_name
                FROM review r
                JOIN movie m ON r.movie_id = m.id
                WHERE r.user_id = $user_id
                ORDER BY r.created_at DESC;
            ";
            $result = mysqli_query($conn, $sql);
            $reviews = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $reviews[] = $row;
            }
            echo json_encode($reviews);
        } else {
            echo "Erro ao buscar reviews: usuário não autenticado.";
        }
    } else {
        echo "Método de requisição inválido.";
    }
    mysqli_close($conn);
?>