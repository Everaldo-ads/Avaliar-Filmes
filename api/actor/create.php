<?php
include_once("../config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $biography = $_POST['biography'];
    $country = $_POST['country']; 

    
    if (!$name) {
        echo "Erro: nome do ator é obrigatório.";
        exit;
    }

    if (!$country) {
        echo "Erro: país de nascimento é obrigatório.";
        exit;
    }

    
    $imageData = null;

    if (!empty($_FILES['photo']['tmp_name'])) {
        $imageData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    }

    
    $sql = "
        INSERT INTO Actor (name, birthdate, biography, country, profile_image)
        VALUES ('$name', '$birthdate', '$biography', '$country', '$imageData')
    ";

    $insert = mysqli_query($conn, $sql);

    if ($insert) {
        echo "Ator cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar ator.";
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>
