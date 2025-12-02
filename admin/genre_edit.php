<?php
    include_once("../db/config.inc.php");
    readfile("topo.html");
    readfile("menu.html");
    
    if (!isset($_GET['id'])) { echo "<script>window.location='genres.php';</script>"; exit; }
    $id = (int)$_GET['id'];


    $sql = "SELECT * FROM genre WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $genre = mysqli_fetch_assoc($result);

    if (!$genre) { echo "Gênero não encontrado."; exit; }
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Editar Gênero</h2>
            <a href="genres.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="../api/genres/update.php" method="POST">
                        
                        <input type="hidden" name="id" value="<?php echo $genre['id']; ?>">

                        <div class="mb-4">
                            <label class="form-label">Nome do Gênero *</label>
                            <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($genre['name']); ?>">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Salvar Alterações</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>