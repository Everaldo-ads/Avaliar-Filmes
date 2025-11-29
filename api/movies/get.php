<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type", "application/json");
        $required_params = array("id");
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo json_encode([
                    "error" => "Erro ao cadastrar filme: o valor de '$param' é necessário."
                ]);
            }
        }
        $id = $_REQUEST['id'];
        $sql = "
            SELECT 
                m.*,
                AVG(r.score) AS average_score,
                JSON_ARRAYAGG(
                    DISTINCT JSON_OBJECT(
                        'id', mi.id,
                        'content', mi.content
                    )
                ) AS images,
                JSON_ARRAYAGG(
                    DISTINCT g.name
                ) AS genres
            FROM movie m
            LEFT JOIN movieimage mi ON mi.movie_id = m.id
            LEFT JOIN review r ON r.movie_id = m.id
            LEFT JOIN movie_genre mg ON mg.movie_id = m.id
            LEFT JOIN genre g ON g.id = mg.genre_id  
            WHERE m.id=$id
            GROUP BY m.id;
        ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $dados = mysqli_fetch_array($result);
            $images = json_decode($dados["images"], true);
            for ($i=0; $i<count($images); $i++) {
                $images[$i]["content"] = base64_encode($images[$i]["content"]);
            }
            $dados["images"] = $images;
            echo json_encode($dados);
        } else {
            echo json_encode([
            "error" => "Filme não encontrado." 
        ]);
        }
    } else {
        echo json_encode([
            "error" => "Método de requisição inválido." 
        ]);
    }
    mysqli_close($conn);
?>