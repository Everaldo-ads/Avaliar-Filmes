<?php
    
    function get_movie_images_sql($movieImagesDir, $movie_id) {
        $values = "";
        
        
        if (is_array($movieImagesDir)) {
            foreach ($movieImagesDir as $movieImage) {
                
                $imageContent = addslashes(file_get_contents($movieImage));
                $values .= "($movie_id, '$imageContent'),"; 
            }
            
            $values = substr($values, 0, -1); 
        }
        
        return $values;
    }

    function get_genres_from_request() {
        $genres = array();
        if (isset($_REQUEST['genres']) && is_array($_REQUEST['genres'])) {
            foreach ($_REQUEST['genres'] as $genre) {
                $genres[] = intval($genre);
            }
        }
        return $genres;
    }

    function get_genres_sql($genres, $movie_id) {
        $values = "";
        foreach ($genres as $genre_id) {
            $values .= "($movie_id, $genre_id),"; 
        }
        $values = substr($values, 0, -1); 
        return $values;
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
            if (empty($_REQUEST[$param])) {
                echo "Erro ao cadastrar filme: o valor de '$param' é necessário.";
                exit;
            }
        }

        $age_class = $_REQUEST['age_classification'];
        $name = $_REQUEST['name'];
        $status = $_REQUEST['status'];
        $release_date = $_REQUEST['release_date'];
        $country = $_REQUEST['country'];
        $duration = $_REQUEST['duration'];
        $budget = $_REQUEST['budget'];
        $genres = get_genres_from_request();

        
        $sql = "INSERT INTO movie (age_classification, name, status, release_date, country, duration, budget)
                VALUES ('$age_class', '$name', '$status', '$release_date', '$country', '$duration', '$budget')";

        $insert = mysqli_query($conn, $sql);
        
        if ($insert) {
            
            $movie_id = mysqli_insert_id($conn);

            $sql_cast = "INSERT INTO `cast` (movie_id) VALUES ('$movie_id')";
            mysqli_query($conn, $sql_cast);

            if (!empty($genres)) {
                $genres_sql_values = get_genres_sql($genres, $movie_id);
                $sql_genres = "INSERT INTO movie_genre (movie_id, genre_id) VALUES $genres_sql_values";
                mysqli_query($conn, $sql_genres);
            }
            
            if (isset($_FILES['images']) && !empty($_FILES['images']['tmp_name'][0])) {
                
                $values_sql = get_movie_images_sql($_FILES['images']['tmp_name'], $movie_id);
                
                if (!empty($values_sql)) {
                    $sql_images = "INSERT INTO movieimage (movie_id, content) VALUES $values_sql";
                    mysqli_query($conn, $sql_images);
                }
            }

            echo "Filme criado com sucesso!";
        } else {
            echo "Erro ao criar filme: " . mysqli_error($conn);
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>