<?php
   include_once("../../db/config.inc.php");

    if (!isset($conn)) { header("Content-Type: application/json"); echo json_encode(["error" => "Conexão falhou."]); exit; }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json");

        if (empty($_REQUEST['user_id'])) {
            echo json_encode(["error" => "Erro: user_id é necessário."]);
            exit;
        }

        $user_id = intval($_REQUEST['user_id']);


        $sql = "
            SELECT 
                fi.id as item_id,
                m.id as movie_id,
                m.name as movie_name,
                m.release_date,
                fi.created_at
            FROM favorites f
            JOIN favorites_item fi ON f.id = fi.favorites_id
            JOIN movie m ON fi.movie_id = m.id
            WHERE f.user_id = $user_id
        ";

        $result = mysqli_query($conn, $sql);
        $favorites = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $favorites[] = $row;
            }
        }
        
        echo json_encode($favorites);

    } else {
        echo json_encode(["error" => "Método inválido."]);
    }

    mysqli_close($conn);
?>