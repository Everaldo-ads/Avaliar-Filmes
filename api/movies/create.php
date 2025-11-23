<?php
    function get_movie_images_sql($movieImagesDir) {
        $values = ""
        foreach ($movieImagesDir as $movieImage) {
            $imageContent = file_get_contents($movieImage);
            $values .= "(@id, $imageContent),\n"
        }
        $values = substr($str, 0, -1);
        return $values . ";"
    }
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        $sql = "START TRANSACTION;

            INSERT INTO movie (age_classification, name, status, release_date, country, duration, budget)
            VALUES ('$age_class', '$name', '$status', '$release_date', '$country', '$duration', '$budget');

            SET @id := LAST_INSERT_ID();

            INSERT INTO MovieImage (movie_id, content) VALUES 
            " . get_movie_images_sql() . ";

            COMMIT;"
        ;
        $insert = mysqli_query($conn, $sql);
        
        if (!$insert) {
            echo "Erro ao criar filme";
        } else {
            echo "Erro ao criar filme";
        }
    } else {
        echo "Método de requisição inválido.";
    }
    mysqli_close($conn);
?>