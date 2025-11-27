<?php
    include_once("../../db/config.inc.php");

    if (!isset($conn)) { header("Content-Type: application/json"); echo json_encode(["error" => "Conexão falhou."]); exit; }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-Type", "application/json");

        if (empty($_REQUEST['id'])) {
            echo json_encode(["error" => "Erro: ID do usuário necessário."]);
            exit;
        }

        $id = intval($_REQUEST['id']);

        $sql = "SELECT id, email, nickname, role, profile_image, created_at FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            
            if ($user['profile_image']) {
                $user['profile_image'] = base64_encode($user['profile_image']);
            }
            
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "Usuário não encontrado."]);
        }

    } else {
        echo json_encode(["error" => "Método inválido."]);
    }
    mysqli_close($conn);
?>