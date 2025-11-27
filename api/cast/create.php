<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $movie_id = $_POST['movie_id'];
    $actor_id = $_POST['actor_id'];
    $character_name = $_POST['character_name'];

    
    if (!$movie_id || !$actor_id) {
        echo "Erro: É necessário informar o ID do Filme e o ID do Ator.";
        exit;
    }

    
    $sql = "
        INSERT INTO movie_cast (movie_id, actor_id, character_name)
        VALUES ('$movie_id', '$actor_id', '$character_name')
    ";

    // 5. Executa
    if (mysqli_query($conn, $sql)) {
        echo "Ator vinculado ao filme com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}


    mysqli_close($conn);
?>