<?php
    include_once("../../db/config.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];

        if ($id) {

            
            $sql = "SELECT id FROM genre WHERE id=$id;";
            $select = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($select) > 0) {

                
                $sql = "DELETE FROM genre WHERE id=$id;";
                $delete = mysqli_query($conn, $sql);

                if ($delete) {
                    echo "Genero deletado com sucesso.";
                } else {
                    echo "Erro ao deletar o genero.";
                }

            } else {
                echo "Genero não encontrado";
            }

        } else {
            echo "Erro ao deletar Genero: id necessário.";
        }

    } else {
        echo "Método de requisição inválido.";
    }

    mysqli_close($conn);
?>
