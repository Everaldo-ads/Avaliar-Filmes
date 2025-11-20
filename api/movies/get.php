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
                Movie.id AS id,
                Movie.name,
                Movie.age_classification,
                Movie.status,
                Movie.release_date,
                Movie.country,
                Movie.duration,
                Movie.budget,

                MovieImage.id AS image_id,
                MovieImage.content
            FROM Movie
            INNER JOIN MovieImage
                ON MovieImage.movie_id = Movie.id
            WHERE Movie.id=$id
            ;
        ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $images = array();
            $hasMovieData = false;
            while($dados = mysqli_fetch_array($result)) {
                if (!$hasMovieData) {
                    $movieData = [
                        "id" => $dados["id"],
                        "age_classification" => $dados["age_classification"],
                        "name" => $dados["name"],
                        "status" => $dados["status"],
                        "release_date" => $dados["release_date"],
                        "country" => $dados["country"],
                        "duration" => $dados["duration"],
                        "budget" => $dados["budget"],
                    ];
                    $hasMovieData = !$hasMovieData;
                }
                $image = [
                    "id" => $dados["image_id"],
                    "content" => base64_encode($dados["content"])
                ];
                array_push($images, $image);
            }
            $movieData["images"] = $images;
            /*
                Formato dos dados retornados:
                {
                    id: int,
                    age_classification: 'L'|'10'|'12'|'14'|'16'|'18',
                    name: string,
                    status: string,
                    release_date: Date,
                    country: string,
                    duration: int,
                    budget: float,
                    images: [{
                        id: int,
                        content: string
                    }]
                }
            */
            echo json_encode($movieData);
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