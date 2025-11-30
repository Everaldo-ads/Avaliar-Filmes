<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json");
        $required_params = array("id");
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo json_encode([
                    "error" => "Erro ao carregar filme: o valor de '$param' é necessário."
                ]);
            }
        }
        $id = $_REQUEST['id'];
        $sql = "
            SELECT 
                m.*,
                AVG(r.score) AS average_score,
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
                ) AS images,
                CONCAT(
                    '[', 
                    IFNULL(
                        GROUP_CONCAT(
                            DISTINCT CONCAT(
                                '\"', g.name, '\"'
                            )
                            SEPARATOR ','
                        ),
                    ''),
                    ']'
                ) AS genres,
                CONCAT(
                    '[', 
                    IFNULL(
                        GROUP_CONCAT(
                            DISTINCT CONCAT(
                                '{\"id\":', a.id,
                                ',\"name\":\"', a.name, '\"',
                                ',\"country\":\"', a.country, '\"',
                                ',\"profile_image\":\"', TO_BASE64(a.profile_image), '\"',
                                '}'
                            )
                            SEPARATOR ','
                        ),
                    ''),
                    ']'
                ) AS actors
            FROM movie m
            LEFT JOIN movieimage mi ON mi.movie_id = m.id
            LEFT JOIN review r ON r.movie_id = m.id
            LEFT JOIN movie_genre mg ON mg.movie_id = m.id
            LEFT JOIN genre g ON g.id = mg.genre_id  
            LEFT JOIN `cast` c ON c.movie_id = m.id
            LEFT JOIN cast_actor ca ON ca.cast_id = c.id
            LEFT JOIN actor a ON a.id = ca.actor_id
            WHERE m.id=$id
            GROUP BY m.id;
        ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $dados = mysqli_fetch_array($result);
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