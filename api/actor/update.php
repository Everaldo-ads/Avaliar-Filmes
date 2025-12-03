<?php
    include_once("../../db/config.inc.php");
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $birthdate = $_POST['birthdate'];
        $biography = $_POST['biography'];
        $country = $_POST['country'];

        if (!empty($_FILES['photo']['tmp_name'])) {
            
            $imageData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
            
            $sql = "UPDATE actor SET
                    name = '$name',
                    birthdate = '$birthdate',
                    biography = '$biography',
                    country = '$country',
                    profile_image = '$imageData'
                    WHERE id = '$id'";
                    
        } else {

            $sql = "UPDATE actor SET
                    name = '$name',
                    birthdate = '$birthdate',
                    biography = '$biography',
                    country = '$country'
                    WHERE id = '$id'";
        }

        
        if (mysqli_query($conn, $sql)) {
            echo "Dados atualizados com sucesso";
        } else {
            echo "Erro ao atualizar: " . mysqli_error($conn);
        }

    }

    mysqli_close($conn);
?>
