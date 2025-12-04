<?php
    include_once("../../db/config.inc.php");
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];

        if ($id) {
            $sql = "SELECT id FROM review WHERE id=$id;";
            $select = mysqli_query($conn, $sql);
            
            if ($select && mysqli_num_rows($select) > 0) {

                $sql = "DELETE FROM review WHERE id=$id;";
                $delete = mysqli_query($conn, $sql);

                if ($delete) {
                    echo "Review deletado com sucesso.";
                } else {
                    echo "Erro ao deletar a review.";
                }

            } else {
                echo "Review não encontrada.";
            }

        } else {
            echo "Erro ao deletar review: id necessário.";
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>
