<?php
    include_once("../db/config.inc.php"); 
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciar Gêneros</h2>
            <a href="genre_form.php" class="btn btn-success"><i class="bi bi-plus-lg"></i> Novo Gênero</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 100px;">ID</th>
                            <th>Nome do Gênero</th>
                            <th style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM genre ORDER BY name ASC";
                        $result = mysqli_query($conn, $sql);

                        if($result && mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>#{$row['id']}</td>";
                                echo "<td><strong>{$row['name']}</strong></td>";
                                
                                echo "<td>
                                        <div class='d-flex gap-2'>
                                            <a href='genre_edit.php?id={$row['id']}' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i></a>
                                            
                                            <form action='../api/genres/delete.php' method='POST' onsubmit='return confirm(\"Excluir este gênero?\");'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <button type='submit' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i></button>
                                            </form>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center text-muted'>Nenhum gênero cadastrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>