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
                Actor.id AS id,
                Actor.name,
                Actor.birthdate,
                Actor.country,
                Actor.biography,

                ActorImage.id AS image_id,
                ActorImage.content
            FROM Actor
            LEFT JOIN ActorImage
                ON ActorImage.actor_id = Actor.id
            WHERE Actor.id = $id;
        ";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            $images = array();
            $hasActorData = false;

            while ($dados = mysqli_fetch_array($result)) {

                if (!$hasActorData) {
                    $actorData = [
                        "id" => $dados["id"],
                        "name" => $dados["name"],
                        "birthdate" => $dados["birthdate"],
                        "country" => $dados["country"],
                        "biography" => $dados["biography"]
                    ];
                    $hasActorData = true;
                }

                if ($dados["image_id"]) {
                    $image = [
                        "id" => $dados["image_id"],
                        "content" => base64_encode($dados["content"])
                    ];
                    array_push($images, $image);
                }
            }

            $actorData["images"] = $images;

            /*
                Formato dos dados retornados:
                {
                    id: int,
                    name: string,
                    birthdate: Date,
                    country: string,
                    biography: string,
                    images: [{
                        id: int,
                        content: string
                    }]
                }
            */

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
