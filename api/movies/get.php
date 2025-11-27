<?php

    include_once("../../db/config.inc.php");

    if (!isset($conn)) {
        header("Content-Type: application/json");
        echo json_encode(["error" => "Erro: Conexão com o banco falhou."]);
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type", "application/json");


        if (empty($_REQUEST['id'])) {
            echo json_encode(["error" => "Erro: É necessário informar o ID do filme (ex: ?id=1)."]);
            exit;
        }

        $id = $_REQUEST['id'];


        $sql = "
            SELECT 
                id,
                name,
                age_classification,
                status,
                release_date,
                country,
                duration,
                budget
            FROM movie
            WHERE id = $id;
        ";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $dados = mysqli_fetch_array($result);

            
            $movieData = [
                "id" => $dados["id"],
                "name" => $dados["name"],
                "age_classification" => $dados["age_classification"],
                "status" => $dados["status"],
                "release_date" => $dados["release_date"],
                "country" => $dados["country"],
                "duration" => $dados["duration"],
                "budget" => $dados["budget"]
            ];

            echo json_encode($movieData);

        } else {
            echo json_encode([
                "error" => "Filme não encontrado com o ID: " . $id
            ]);
        }

    } else {
        echo json_encode([
            "error" => "Método de requisição inválido."
        ]);
    }

    if (isset($conn)) {
        mysqli_close($conn);
    }
?>