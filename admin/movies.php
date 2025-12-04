<?php 
    include_once("../db/config.inc.php"); 
    
 
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciar Filmes</h2>
            <a href="movie_form.php" class="btn btn-success"><i class="bi bi-film"></i> Novo Filme</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Capa</th>
                                <th>Nome</th>
                                <th>Lançamento</th>
                                <th>Classificação</th>
                                <th>Status</th>
                                <th style="width: 150px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "
                                SELECT 
                                    m.id, m.name, m.release_date, m.age_classification, m.status,
                                    (SELECT content FROM movieimage WHERE movie_id = m.id LIMIT 1) as poster
                                FROM movie m 
                                ORDER BY m.id DESC
                            ";
                            
                            $result = mysqli_query($conn, $sql);

                            if($result){
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>#{$row['id']}</td>";
                                    
                                    
                                    if (!empty($row['poster'])) {
                                        $img = base64_encode($row['poster']);
                                        echo "<td><img src='data:image/jpeg;base64,{$img}' width='60' class='rounded shadow-sm' style='aspect-ratio: 2/3; object-fit: cover;'></td>";
                                    } else {
                                        
                                        echo "<td><div class='bg-light text-secondary rounded d-flex align-items-center justify-content-center' style='width:60px; height:90px;'><i class='bi bi-camera-video-off'></i></div></td>";
                                    }

                                    echo "<td><strong>{$row['name']}</strong></td>";
                                    
                                    
                                    $dataBr = date('d/m/Y', strtotime($row['release_date']));
                                    echo "<td>{$dataBr}</td>";
                                    
                                    
                                    $badgeColor = 'bg-secondary';
                                    if($row['age_classification'] == 'L') $badgeColor = 'bg-success';
                                    if($row['age_classification'] == '10') $badgeColor = 'bg-info';
                                    if($row['age_classification'] == '12') $badgeColor = 'bg-warning text-dark';
                                    if($row['age_classification'] == '14') $badgeColor = 'bg-warning';
                                    if($row['age_classification'] == '16') $badgeColor = 'bg-danger';
                                    if($row['age_classification'] == '18') $badgeColor = 'bg-dark';
                                    
                                    echo "<td><span class='badge {$badgeColor}'>{$row['age_classification']}</span></td>";
                                    
                                    echo "<td><small class='text-muted'>{$row['status']}</small></td>";
                                    
                                   
                                    echo "<td>
                                            <div class='d-flex gap-2'>
                                                <a href='movie_edit.php?id={$row['id']}' class='btn btn-sm btn-primary' title='Editar'><i class='bi bi-pencil'></i></a>
                                                
                                                <form action='../api/movies/delete.php' method='POST' onsubmit='return confirm(\"Tem certeza que deseja excluir o filme {$row['name']}?\");'>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <button type='submit' class='btn btn-sm btn-danger' title='Excluir'><i class='bi bi-trash'></i></button>
                                                </form>
                                            </div>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>Nenhum filme encontrado ou erro no SQL.</td></tr>";
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