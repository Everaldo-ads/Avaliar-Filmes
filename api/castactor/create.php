<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $cast_id = $_POST['cast_id'];
    $actor_id = $_POST['actor_id'];

    
    if (!$cast_id || !$actor_id) {
        echo "Erro: cast_id e actor_id são obrigatórios.";
        exit;
    }


    $sql = "
        INSERT INTO cast_actor (cast_id, actor_id)
        VALUES ('$cast_id', '$actor_id')
    ";

    
    if (mysqli_query($conn, $sql)) {
        echo "Ator vinculado ao elenco com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>
