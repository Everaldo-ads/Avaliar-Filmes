<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];

        if ($id) {

            
            $sql = "SELECT id FROM castm WHERE id=$id;";
            $select = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($select) > 0) {

                
                $sql = "DELETE FROM castm WHERE id=$id;";
                $delete = mysqli_query($conn, $sql);

                if ($delete) {
                    echo "Ator deletado com sucesso.";
                } else {
                    echo "Erro ao deletar o ator.";
                }

            } else {
                echo "Ator não encontrado";
            }

        } else {
            echo "Erro ao deletar ator: id necessário.";
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>
