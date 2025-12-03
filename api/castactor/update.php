<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $cast_id = $_POST['cast_id'];
    $actor_id = $_POST['actor_id'];

    if (!$id) {
        echo "Erro: ID é obrigatório.";
        exit;
    }

    $sql = "UPDATE castactor SET 
            cast_id = '$cast_id', 
            actor_id = '$actor_id' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Vínculo Ator-Elenco atualizado com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>