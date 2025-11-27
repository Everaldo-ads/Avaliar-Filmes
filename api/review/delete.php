<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];

        if ($id) {

            
            $sql = "SELECT id FROM review WHERE id=$id;";
            $select = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($select) > 0) {

                
                $sql = "DELETE FROM review WHERE id=$id;";
                $delete = mysqli_query($conn, $sql);

                if ($delete) {
                    echo "Review deletada com sucesso.";
                } else {
                    echo "Erro ao deletar a review.";
                }

            } else {
                echo "Review não encontrado";
            }

        } else {
            echo "Erro ao deletar Review: id necessário.";
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>
