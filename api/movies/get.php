<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type", "application/json");
        $required_params = array("id");
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo "Erro ao cadastrar filme: o valor de '$param' é necessário.";
            }
        }
        $id = $_REQUEST['id'];
        $sql = "
            SELECT 
                Movie.*,
                AVG(Review.score) AS average_score,
                JSON_ARRAYAGG(
                    DISTINCT JSON_OBJECT(
                        'id', MovieImage.id,
                        'content', MovieImage.content
                    )
                ) AS images,
                JSON_ARRAYAGG(
                    DISTINCT Genre.name
                ) AS genres
            FROM Movie
            LEFT JOIN MovieImage ON MovieImage.movie_id = Movie.id
            LEFT JOIN Review ON Review.movie_id = Movie.id
            LEFT JOIN MovieGenre ON MovieGenre.movie_id = Movie.id
            LEFT JOIN Genre ON Genre.id = MovieGenre.genre_id  
            WHERE Movie.id=$id
            GROUP BY Movie.id;
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