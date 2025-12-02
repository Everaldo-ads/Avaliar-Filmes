<?php
    include_once("../db/config.inc.php"); 
    
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciar Atores</h2>
            <a href="actor_form.php" class="btn btn-success"><i class="bi bi-plus-lg"></i> Novo Ator</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>País</th>
                            <th style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
 
                        $sql = "SELECT * FROM actor ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);

                        if($result){
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>#{$row['id']}</td>";
                                

                                if (!empty($row['profile_image'])) {
                                    $img = base64_encode($row['profile_image']);
                                    echo "<td><img src='data:image/jpeg;base64,{$img}' width='50' height='50' class='rounded-circle object-fit-cover'></td>";
                                } else {
                                    echo "<td><div class='bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center' style='width:50px; height:50px;'><i class='bi bi-person'></i></div></td>";
                                }

                                echo "<td><strong>{$row['name']}</strong></td>";
                                

                                $dataNasc = $row['birthdate'] ? date('d/m/Y', strtotime($row['birthdate'])) : '-';
                                echo "<td>{$dataNasc}</td>";
                                
                                echo "<td>{$row['country']}</td>";
                                

                                echo "<td>
                                        <div class='d-flex gap-2'>
                                            <a href='actor_edit.php?id={$row['id']}' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i></a>
                                            
                                            <form action='../api/actor/delete.php' method='POST' onsubmit='return confirm(\"Tem certeza que deseja excluir?\");'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <button type='submit' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i></button>
                                            </form>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
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