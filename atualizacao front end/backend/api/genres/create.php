<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $required_params = array(
            "name"
        );
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo "Erro ao cadastrar filme: o valor de '$param' é necessário.";
            }
        }
        $name = $_REQUEST['name'];

        $sql = "
            INSERT INTO genre (name)
            VALUES ('$name');
        ";
        $insert = mysqli_query($conn, $sql);
       
        if ($insert) {
            echo "Filme criado com sucesso.";
        } else {
            echo "Erro ao criar filme";
        }
    } else {
        echo "Método de requisição inválido.";
    }
    mysqli_close($conn);
?>