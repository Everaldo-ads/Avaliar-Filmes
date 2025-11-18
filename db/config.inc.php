<?php
    $conn = mysqli_connect("localhost:3306","root","");
    $db = mysqçli_select_db($conn, "database");

    if ($conn) {
        echo "Conexão com o banco de dados realizada com sucesso!";
    } else {
        echo "Falha na conexão com o banco de dados: ";
    }
?>
