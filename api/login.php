<?php
    include_once('../db/config.inc.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        if (!$email) {
            echo "Erro ao fazer login: email necessário.";
        } else if (!$password) {
            echo "Erro ao fazer login: senha necessária.";
        } else {
            $sql = "SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    echo "Login bem-sucedido!";
                } else {
                    echo "Erro ao fazer login: senha incorreta.";
                }
            } else {
                echo "Erro ao fazer login: usuário não encontrado.";
            }
        }
    } else {
        echo "Método de requisição inválido.";
    }
?>