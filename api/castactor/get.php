<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json; charset=utf-8");

        $sql = "";

        if (!empty($_REQUEST['cast_id'])) {
            $cast_id = $_REQUEST['cast_id'];
            $sql = "SELECT * FROM castactor WHERE cast_id = $cast_id";
        }
        elseif (!empty($_REQUEST['actor_id'])) {
            $actor_id = $_REQUEST['actor_id'];
            $sql = "SELECT * FROM castactor WHERE actor_id = $actor_id";
        }
        elseif (!empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM castactor WHERE id = $id";
        }
        else {
            echo json_encode(["error" => "Erro: Informe 'cast_id', 'actor_id' ou 'id'."]);
            exit;
        }

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            
            $lista = [];
            
 
            while ($row = mysqli_fetch_assoc($result)) {
                $lista[] = $row;
            }

            echo json_encode($lista);

        } else {
            echo json_encode([]); 
        }

    } else {
        echo json_encode(["error" => "Método inválido."]);
    }

    mysqli_close($conn);
?>