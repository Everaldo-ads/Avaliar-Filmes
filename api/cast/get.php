<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json; charset=utf-8");

        $sql = "";

        if (!empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM castm WHERE id = $id";
        } 
        elseif (!empty($_REQUEST['movie_id'])) {
            $movie_id = $_REQUEST['movie_id'];
            $sql = "SELECT * FROM castm WHERE movie_id = $movie_id";
        } 
        else {
            echo json_encode(["error" => "Erro: Informe 'id' ou 'movie_id'."]);
            exit;
        }

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            
            $dados = mysqli_fetch_assoc($result);
            
            echo json_encode($dados);

        } else {
            echo json_encode(["error" => "Elenco não encontrado."]);
        }

    } else {
        echo json_encode(["error" => "Método inválido."]);
    }

    mysqli_close($conn);
?>
