<?php
    include_once("../../db/config.inc.php");


if (!isset($conn)) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "Erro: Conexão com o banco falhou."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Content-Type", "application/json");


    if (empty($_REQUEST['movie_id'])) {
        echo json_encode(["error" => "Erro: É necessário informar o movie_id para listar o elenco."]);
        exit;
    }

    $movie_id = $_REQUEST['movie_id'];


    $sql = "
        SELECT 
            mc.id as cast_id,
            mc.character_name,
            a.id as actor_id,
            a.name as actor_name,
            a.profile_image
        FROM movie_cast mc
        INNER JOIN Actor a ON mc.actor_id = a.id
        WHERE mc.movie_id = $movie_id
    ";

    $result = mysqli_query($conn, $sql);
    
    $castList = [];

    if ($result && mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            $castList[] = [
                "cast_id"        => $row['cast_id'],
                "character_name" => $row['character_name'],
                "actor_id"       => $row['actor_id'],
                "actor_name"     => $row['actor_name'],
                "actor_image"    => $row['profile_image'] ? base64_encode($row['profile_image']) : null
            ];
        }
        
        
        echo json_encode($castList);

    } else {
       
        echo json_encode([]); 
    }

} else {
    echo json_encode(["error" => "Método de requisição inválido."]);
}


mysqli_close($conn);
?>