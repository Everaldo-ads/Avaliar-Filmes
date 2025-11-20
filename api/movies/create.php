<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["method"] == "POST") {
        $required_params = array(
            "age_classification", 
            "name", 
            "status", 
            "release_date", 
            "country", 
            "duration", 
            "budget"
        );
        foreach ($required_params as $param) {
            if (!$_REQUEST[$param]) {
                echo "Erro ao cadastrar filme: o valor de '$param' é necessário.";
            }
        }
        $age_class = $_REQUEST['age_classification'];
        $name = $_REQUEST['name'];
        $status = $_REQUEST['status'];
        $release_date = $_REQUEST['release_date'];
        $country = $_REQUEST['country'];
        $duration = $_REQUEST['duration'];
        $budget = $_REQUEST['budget'];

        $sql = "
            INSERT INTO movie (age_classification, name, status, release_date, country, duration, budget)
            VALUES ('$age_class', '$name', '$status', '$release_date', '$country', '$duration', '$budget');
        ";
        $insert = mysqli_query($conn, $sql);

        $movie_id = mysqli_insert_id($conn);
        $movieImagesDir = $FILES["movieImages"]["tmp_name"];
        $imagesCreated = true;
        foreach ($movieImagesDir as $movieImage) {
            $imageContent = file_get_contents($movieImage);
            $sql = "INSERT INTO MovieImage (movie_id, content) VALUES ('$movie_id', '$imageContent')";
            $image_insert = mysqli_query($conn, $sql);
            if (!$image_insert) {
                $imagesCreated = false;
            }
        }

        if (!$imagesCreated) {
            echo "Erro ao cadastrar as imagens do filme.";
        } elseif (!$insert) {
            echo "Erro ao criar filme";
        } else {
            echo "Erro ao criar filme";
        }
    } else {
        echo "Método de requisição inválido.";
    }
    mysqli_close($conn);
?>