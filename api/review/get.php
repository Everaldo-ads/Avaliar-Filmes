<?php
    
    include_once("../../db/config.inc.php");

   if (!isset($conn))  header("Content-Type: application/json; charset=utf-8");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $where = "";
        if (!empty($_REQUEST['movie_id'])) {
            $id = intval($_REQUEST['movie_id']);
            $where = "WHERE r.movie_id = $id";
        } elseif (!empty($_REQUEST['user_id'])) {
            $id = intval($_REQUEST['user_id']);
            $where = "WHERE r.user_id = $id";
        }

        
        $sql = "
            SELECT 
                r.id,
                r.user_id,
                r.score,
                r.message,
                r.created_at,
                u.nickname as user_name,
                m.name as movie_name
            FROM review r
            JOIN users u ON r.user_id = u.id
            JOIN movie m ON r.movie_id = m.id
            $where
            ORDER BY r.created_at DESC
        ";

        if ($conn) {
            $result = mysqli_query($conn, $sql);
            $reviews = [];

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $reviews[] = $row;
                }
            }
            echo json_encode($reviews);
        } else {
            
            echo json_encode(["error" => "Erro de conexão com o banco de dados."]);
        }

    } else {
        echo json_encode(["error" => "Método inválido."]);
    }
    
  mysqli_close($conn);
?>