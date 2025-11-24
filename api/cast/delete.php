<?php
include_once("../../db/config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    if (!$id) {
        echo "Erro: id é obrigatório.";
        exit;
    }

    mysqli_query($conn, "DELETE FROM CastActor WHERE cast_id=$id");

    $sql = "DELETE FROM Cast WHERE id=$id";
    $delete = mysqli_query($conn, $sql);

    if ($delete) {
        echo "Cast deletado com sucesso.";
    } else {
        echo "Erro ao deletar cast.";
    }

} else {
    echo "Método inválido.";
}

mysqli_close($conn);
?>
