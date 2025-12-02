<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name'];

    if (!$id || !$name) {
        echo "Erro: ID e Nome são obrigatórios.";
        exit;
    }

    $sql = "UPDATE genre SET name = '$name' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Gênero atualizado com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>