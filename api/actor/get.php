<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type", "application/json");

        $required_params = array("id");
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo "Erro ao buscar ator: o valor de '$param' é necessário.";
                exit;
            }
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
            FROM Actor
            WHERE id = $id;
        ";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

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
                "error" => "Ator não encontrado."
            ]);
        }

    } else {
        echo json_encode([
            "error" => "Método de requisição inválido."
        ]);
    }

    mysqli_close($conn);
?>
