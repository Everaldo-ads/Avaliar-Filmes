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
            echo json_encode(["error" => "Erro: É necessário informar o ID do ator (ex: ?id=1)."]);
            exit;
        }

        $id = $_REQUEST['id'];

        $sql = "
            SELECT 
                id,
                name,
                birthdate,
                country,
                biography,
                profile_image
            FROM actor
            WHERE id = $id;
        ";

        
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $dados = mysqli_fetch_array($result);

            $actorData = [
                "id" => $dados["id"],
                "name" => $dados["name"],
                "birthdate" => $dados["birthdate"],
                "country" => $dados["country"],
                "biography" => $dados["biography"],
                
                "profile_image" => $dados["profile_image"] 
                    ? base64_encode($dados["profile_image"]) 
                    : null
            ];

            echo json_encode($actorData);

        } else {
            echo json_encode([
                "error" => "Ator não encontrado com o ID: " . $id
            ]);
        }

    } else {
        echo json_encode([
            "error" => "Método de requisição inválido."
        ]);
    }

        mysqli_close($conn);
?>