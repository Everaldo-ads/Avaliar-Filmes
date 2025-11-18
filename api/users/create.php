<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["method"] == "POST") {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $nickname = $_REQUEST['name'];

        if (!$email) {
            echo "Erro ao criar usuário: email necessário."
        } else if (!$password) {
            echo "Erro ao criar usuário: senha necessária."
        } else if (!$nickname) {
            echo "Erro ao criar usuário: nickname necessário."
        } else {
            $sql = "INSERT INTO users (email, password, nickname) VALUES ('$email', '$password', '$nickname', '$role')";
            $insert = mysqli_query($conn, $sql);
            if ($insert) {
                echo "Usuário criado com sucesso!";
            } else {
                echo "Erro ao criar usuário";
            }
        }
    } else {
        echo "Método de requisição inválido.";
    }
    mysqli_close($conn);
?>