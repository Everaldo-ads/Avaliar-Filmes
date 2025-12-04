<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];

        if ($id) {

            
            $sql = "SELECT id FROM movie WHERE id=$id;";
            $select = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($select) > 0) {

                
                $sql = "DELETE FROM movie WHERE id=$id;";
                $delete = mysqli_query($conn, $sql);

                if ($delete) {
                    echo "Filme deletada com sucesso.";
                } else {
                    echo "Erro ao deletar o Filme.";
                }

            } else {
                echo "Filme não encontrado";
            }

        } else {
            echo "Erro ao deletar Filme: id necessário.";
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>
