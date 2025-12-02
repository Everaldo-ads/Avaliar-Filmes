<?php
    include_once("../db/config.inc.php"); 
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciar Usuários</h2>
            <span class="text-muted">Total de registros: 
                <?php 
                    $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as t FROM users"));
                    echo $count['t'];
                ?>
            </span>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Apelido</th>
                                <th>Email</th>
                                <th>Nível</th>
                                <th>Data Cadastro</th>
                                <th style="width: 150px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM users ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);

                            if($result){
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>#{$row['id']}</td>";
                                    
                                    if (!empty($row['profile_image'])) {
                                        $img = base64_encode($row['profile_image']);
                                        echo "<td><img src='data:image/jpeg;base64,{$img}' width='40' height='40' class='rounded-circle object-fit-cover'></td>";
                                    } else {
                                        echo "<td><div class='bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center' style='width:40px; height:40px;'><i class='bi bi-person'></i></div></td>";
                                    }

                                    echo "<td><strong>{$row['nickname']}</strong></td>";
                                    echo "<td>{$row['email']}</td>";
                                    

                                    if($row['role'] == 'admin'){
                                        echo "<td><span class='badge bg-danger'>ADMIN</span></td>";
                                    } else {
                                        echo "<td><span class='badge bg-info text-dark'>USER</span></td>";
                                    }

                                    $dataCad = isset($row['created_at']) ? date('d/m/Y', strtotime($row['created_at'])) : '-';
                                    echo "<td><small class='text-muted'>{$dataCad}</small></td>";
                                    

                                    echo "<td>
                                            <div class='d-flex gap-2'>
                                                <a href='user_edit.php?id={$row['id']}' class='btn btn-sm btn-primary' title='Editar'><i class='bi bi-pencil'></i></a>
                                                
                                                <form action='../api/users/delete.php' method='POST' onsubmit='return confirm(\"Tem certeza que deseja excluir o usuário {$row['nickname']}?\");'>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <button type='submit' class='btn btn-sm btn-danger' title='Excluir'><i class='bi bi-trash'></i></button>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>