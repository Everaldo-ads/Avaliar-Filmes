<?php
    include_once("../../db/config.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];

        if ($id) {
            $sql = "SELECT id FROM users WHERE id=$id;";
            $select = mysqli_query($conn, $sql);
            
            if ($select) {
                $sql = "DELETE FROM user WHERE id=$id;";
                $delete = mysqli_query($conn, $sql);
                if ($delete) {
                    echo "Usuário deletado com sucesso.";
                }
                else {
                    echo "Erro ao deletar o usuário.";
                }
            } else {
                echo "Usuário não encontrado";
            }
        }
        else (!$id) {
            echo "Erro ao deletar usuário: id necessário."
        } 
    } else {
        echo "Método de requisição inválido.";
    }
    mysqli_close($conn);
?>