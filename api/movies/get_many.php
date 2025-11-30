<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json");
        $required_params = array("limit");
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo json_encode([
                    "error" => "Erro ao listar os filmes: o valor de '$param' é necessário."
                ]);
            }
        }
        $limit = intval($_REQUEST['limit']);
        $offset = isset($_REQUEST['offset']) ? intval($_REQUEST['offset']) : 0;
        $sql = "
            SELECT 
                m.*,
                AVG(r.score) AS average_score,
                COUNT(r.id) AS review_count,
                CONCAT(
                    '[', 
                    IFNULL(
                        GROUP_CONCAT(
                            DISTINCT CONCAT(
                                '{\"id\":', mi.id,
                                ',\"content\":\"', TO_BASE64(mi.content), '\"}'
                            )
                            SEPARATOR ','
                        ),
                    ''),
                    ']'
                ) AS images
            FROM movie m
            LEFT JOIN movieimage mi ON mi.movie_id = m.id
            LEFT JOIN review r ON r.movie_id = m.id
            GROUP BY m.id
            ORDER BY review_count DESC
            LIMIT $limit OFFSET $offset;
        ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $filmes = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $filmes[] = $row;
            }
            echo json_encode($filmes);
        } else {
            echo json_encode([
                "error" => "Erro ao buscar filmes: nenhum filme encontrado."
            ]);
        }
    } else {
        echo json_encode([
            "error" => "Método de requisição inválido." 
        ]);
    }
    mysqli_close($conn);
?>