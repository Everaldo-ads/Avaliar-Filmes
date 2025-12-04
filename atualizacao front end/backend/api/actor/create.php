<?php
include_once("../../db/config.inc.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $biography = $_POST['biography'];
    $country = $_POST['country']; 

    if (!$name || !$country) {
        echo "Erro: Nome e País são obrigatórios.";
        exit;
    }

   
    $imageData = null;

    if (!empty($_FILES['photo']['tmp_name'])) {
        $imageData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    }
    

    $sql = "
        INSERT INTO actor (name, birthdate, biography, country, profile_image)
        VALUES ('$name', '$birthdate', '$biography', '$country', '$imageData')
    ";

    if (mysqli_query($conn, $sql)) {
        echo "Ator cadastrado com sucesso!";
    } else {
        echo "Erro MySQL: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}


    mysqli_close($conn);
?>