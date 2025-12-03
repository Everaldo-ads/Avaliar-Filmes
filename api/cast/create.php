<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $movie_id = $_POST['movie_id'];

    if (!$movie_id) {
        echo "Erro: O ID do filme é obrigatório.";
        exit;
    }

    $sql = "
        INSERT INTO castm (movie_id)
        VALUES ('$movie_id')
    ";

    if (mysqli_query($conn, $sql)) {
        $novo_id = mysqli_insert_id($conn);
        echo "Elenco criado com sucesso! ID do Elenco: " . $novo_id;
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>
