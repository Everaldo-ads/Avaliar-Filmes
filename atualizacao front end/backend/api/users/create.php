<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $nickname = $_REQUEST['name'];
        $profileImage = $_FILES['profileImage'];

        if (!$email) {
            echo "Erro ao criar usuário: email necessário.";
        } else if (!$password) {
            echo "Erro ao criar usuário: senha necessária.";
        } else if (!$nickname) {
            echo "Erro ao criar usuário: nickname necessário.";
        } else {
            $binaryImageData = file_get_contents($profileImage["tmp_name"]);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "
                INSERT INTO user (email, password, nickname, profile_image) 
                VALUES ('$email', '$hashedPassword', '$nickname', '$binaryImageData');
            ";
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