<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    
    $name = $_POST['name'];
    $age_classification = $_POST['age_classification'];
    $status = $_POST['status'];
    $release_date = $_POST['release_date'];
    $country = $_POST['country'];
    $duration = $_POST['duration'];
    $budget = $_POST['budget'];

    if (!$id) {
        echo "Erro: ID do filme é necessário para atualização.";
        exit;
    }

   
    $sql = "UPDATE movie SET
            name = '$name',
            age_classification = '$age_classification',
            status = '$status',
            release_date = '$release_date',
            country = '$country',
            duration = '$duration',
            budget = '$budget'
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Dados do filme atualizados com sucesso! ";

        
        if (isset($_FILES['images']) && !empty($_FILES['images']['tmp_name'][0])) {
            
            $values = "";
            
            
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if (!empty($tmp_name)) {
                    $imageContent = addslashes(file_get_contents($tmp_name));
                    $values .= "($id, '$imageContent'),"; 
                }
            }

            if ($values != "") {
                $values = substr($values, 0, -1); 
                $sql_images = "INSERT INTO movieimage (movie_id, content) VALUES $values";
                
                if (mysqli_query($conn, $sql_images)) {
                    echo "Novas imagens adicionadas.";
                } else {
                    echo "Erro ao adicionar imagens: " . mysqli_error($conn);
                }
            }
        }

    } else {
        echo "Erro ao atualizar filme: " . mysqli_error($conn);
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>