<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $id = $_POST['id'];
    $score = $_POST['score'];
    $message = $_POST['message'];

    if (!$id) {
        echo "Erro: ID da review é obrigatório.";
        exit;
    }

    if ($score < 0) $score = 0;
    
    $message = addslashes($message);

    $sql = "UPDATE review SET 
            score = '$score', 
            message = '$message' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Avaliação atualizada com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>