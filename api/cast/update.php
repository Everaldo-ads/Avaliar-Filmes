<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $movie_id = $_POST['movie_id'];

    if (!$id || !$movie_id) {
        echo "Erro: ID e Movie_ID são obrigatórios.";
        exit;
    }

    $sql = "UPDATE castm SET movie_id = '$movie_id' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Elenco (Cast) atualizado com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>