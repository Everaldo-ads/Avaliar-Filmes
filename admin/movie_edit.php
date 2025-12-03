<?php
    include_once("../db/config.inc.php");
    readfile("topo.html");
    readfile("menu.html");

    if (!isset($_GET['id'])) { echo "<script>window.location='movies.php';</script>"; exit; }
    $id = (int)$_GET['id'];


    $sql = "SELECT * FROM movie WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $movie = mysqli_fetch_assoc($result);

    if (!$movie) { echo "Filme não encontrado."; exit; }

 
    $sql_img = "SELECT content FROM movieimage WHERE movie_id = $id LIMIT 1";
    $res_img = mysqli_query($conn, $sql_img);
    $image = mysqli_fetch_assoc($res_img);


    $sql_genres = "SELECT * FROM genre ORDER BY name ASC";
    $res_genres = mysqli_query($conn, $sql_genres);

 
    $my_genres = [];
    $sql_my_genres = "SELECT genre_id FROM movie_genre WHERE movie_id = $id";
    $res_my_genres = mysqli_query($conn, $sql_my_genres);
    while($g = mysqli_fetch_assoc($res_my_genres)){
        $my_genres[] = $g['genre_id'];
    }
?>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Editar Filme: <?php echo htmlspecialchars($movie['name']); ?></h2>
            <a href="movies.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="../api/movies/update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nome do Filme *</label>
                            <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($movie['name']); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-select" required>
                                <option value="Released" <?php echo ($movie['status'] == 'Released') ? 'selected' : ''; ?>>Lançado</option>
                                <option value="Post Production" <?php echo ($movie['status'] == 'Post Production') ? 'selected' : ''; ?>>Pós-produção</option>
                                <option value="In Production" <?php echo ($movie['status'] == 'In Production') ? 'selected' : ''; ?>>Em Produção</option>
                                <option value="Planned" <?php echo ($movie['status'] == 'Planned') ? 'selected' : ''; ?>>Planejado</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 p-3 bg-light rounded border">
                        <label class="form-label fw-bold mb-2">Gêneros</label>
                        <div class="row">
                            <?php 
                            if(mysqli_num_rows($res_genres) > 0) {
                                while($genre = mysqli_fetch_assoc($res_genres)) {
                                    $checked = in_array($genre['id'], $my_genres) ? "checked" : "";
                                    
                                    echo '
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="genres[]" value="'.$genre['id'].'" id="g_'.$genre['id'].'" '.$checked.'>
                                            <label class="form-check-label" for="g_'.$genre['id'].'">
                                                '.$genre['name'].'
                                            </label>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<div class="col-12 text-muted">Nenhum gênero cadastrado.</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Lançamento</label>
                            <input type="date" name="release_date" class="form-control" required value="<?php echo $movie['release_date']; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Classificação</label>
                            <select name="age_classification" class="form-select">
                                <?php
                                    $options = ['L', '10', '12', '14', '16', '18'];
                                    foreach ($options as $opt) {
                                        $selected = ($movie['age_classification'] == $opt) ? 'selected' : '';
                                        $label = ($opt == 'L') ? 'Livre (L)' : $opt . ' anos';
                                        echo "<option value='$opt' $selected>$label</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Duração (min)</label>
                            <input type="number" name="duration" class="form-control" required value="<?php echo $movie['duration']; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Orçamento ($)</label>
                            <input type="number" step="0.01" name="budget" class="form-control" required value="<?php echo $movie['budget']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">País de Origem</label>
                        <input type="text" name="country" class="form-control" required value="<?php echo htmlspecialchars($movie['country']); ?>">
                    </div>

                    <div class="row mb-4 align-items-center bg-light p-3 rounded">
                        <div class="col-md-2 text-center">
                            <label class="form-label d-block fw-bold">Capa Atual</label>
                            <?php 
                                if($image && $image['content']) {
                                    $imgBase64 = base64_encode($image['content']);
                                    echo "<img src='data:image/jpeg;base64,{$imgBase64}' class='img-thumbnail shadow-sm' style='max-height: 120px;'>";
                                } else {
                                    echo "<span class='text-muted'>Sem Capa</span>";
                                }
                            ?>
                        </div>
                        <div class="col-md-10">
                            <label class="form-label">Adicionar Imagens</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        </div>
                    </div>

                    <hr>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>