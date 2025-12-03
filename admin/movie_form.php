<?php
    include_once("../db/config.inc.php");
    readfile("topo.html");
    readfile("menu.html");

    $sql_genres = "SELECT * FROM genre ORDER BY name ASC";
    $result_genres = mysqli_query($conn, $sql_genres);


    $sql_actors = "SELECT * FROM actor ORDER BY name ASC";
    $result_actors = mysqli_query($conn, $sql_actors);
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cadastrar Novo Filme</h2>
            <a href="movies.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="../api/movies/create.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nome do Filme *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Released">Lançado</option>
                                <option value="Post Production">Pós-produção</option>
                                <option value="Planned">Planejado</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-light fw-bold">Gêneros</div>
                                <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                                    <?php 
                                    if(mysqli_num_rows($result_genres) > 0) {
                                        while($g = mysqli_fetch_assoc($result_genres)) {
                                            echo '
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]" value="'.$g['id'].'" id="gen_'.$g['id'].'">
                                                <label class="form-check-label" for="gen_'.$g['id'].'">'.$g['name'].'</label>
                                            </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-light fw-bold">Elenco (Selecione os Atores)</div>
                                <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                                    <?php 
                                    if(mysqli_num_rows($result_actors) > 0) {
                                        while($a = mysqli_fetch_assoc($result_actors)) {
                                            echo '
                                            <div class="form-check d-flex align-items-center mb-1">
                                                <input class="form-check-input me-2" type="checkbox" name="actors[]" value="'.$a['id'].'" id="act_'.$a['id'].'">
                                                <label class="form-check-label" for="act_'.$a['id'].'">
                                                    '.$a['name'].'
                                                </label>
                                            </div>';
                                        }
                                    } else {
                                        echo "<small class='text-muted'>Cadastre atores primeiro.</small>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Lançamento</label>
                            <input type="date" name="release_date" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Classificação</label>
                            <select name="age_classification" class="form-select">
                                <option value="L">Livre</option>
                                <option value="10">10 anos</option>
                                <option value="12">12 anos</option>
                                <option value="14">14 anos</option>
                                <option value="16">16 anos</option>
                                <option value="18">18 anos</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Duração (min)</label>
                            <input type="number" name="duration" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Orçamento</label>
                            <input type="number" step="0.01" name="budget" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">País</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Imagens</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    </div>

                    <hr>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg">Salvar Filme</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>