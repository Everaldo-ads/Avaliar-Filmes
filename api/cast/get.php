<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json");

        if (empty($_REQUEST['movie_id'])) {
            echo json_encode(["error" => "Erro: É necessário informar o movie_id para listar o elenco."]);
            exit;
        }

        $movie_id = (int)$_REQUEST['movie_id'];


        $sql = "
            SELECT 
                ca.id as vinculo_id,
                a.id as actor_id,
                a.name as actor_name,
                a.profile_image
            FROM castm c
            INNER JOIN cast_actor ca ON c.id = ca.cast_id
            INNER JOIN actor a ON ca.actor_id = a.id
            WHERE c.movie_id = $movie_id
        ";

        $result = mysqli_query($conn, $sql);
        
        $castList = [];

        if ($result && mysqli_num_rows($result) > 0) {
            
            while ($row = mysqli_fetch_assoc($result)) {
                $castList[] = [
                    "id"             => $row['vinculo_id'],
                    "actor_id"       => $row['actor_id'],
                    "actor_name"     => $row['actor_name'],
                    "actor_image"    => $row['profile_image'] ? base64_encode($row['profile_image'])
                ];
            }
            
            echo json_encode($castList);

        } else {
            echo json_encode([]); 
        }

    } else {
        echo json_encode(["error" => "Método de requisição inválido."]);
    }

    mysqli_close($conn);
?>