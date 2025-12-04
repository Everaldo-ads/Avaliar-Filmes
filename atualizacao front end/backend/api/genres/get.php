<?php
  include_once("../../db/config.inc.php");
    if (!isset($conn)) {
        header("Content-Type: application/json");
        echo json_encode(["error" => "Erro: Conexão com o banco falhou."]);
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type: application/json");

        if (empty($_REQUEST['id'])) {
             $sql = "SELECT id, name FROM genre ORDER BY name ASC";
        } else {
             $id = intval($_REQUEST['id']);
             $sql = "SELECT id, name FROM genre WHERE id = $id";
        }

        $result = mysqli_query($conn, $sql);
        $data = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }

    } else {
        echo json_encode(["error" => "Método inválido."]);
    }

mysqli_close($conn);
?>