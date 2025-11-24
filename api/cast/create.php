<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cast_id = $_POST["cast_id"];
    $actor_id = $_POST["actor_id"];

    if (!$cast_id || !$actor_id) {
        echo "Erro: cast_id e actor_id são obrigatórios.";
        exit;
    }

    $sql = "INSERT INTO CastActor (cast_id, actor_id)
            VALUES ($cast_id, $actor_id)";

    $insert = mysqli_query($conn, $sql);

    if ($insert) {
        echo "Ator adicionado ao cast.";
    } else {
        echo "Erro ao adicionar ator ao cast.";
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>
