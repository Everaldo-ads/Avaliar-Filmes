<?php
    include_once("../db/config.inc.php");
    

    @readfile("topo.html");
    @readfile("menu.html");

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "<script>alert('ID não informado!'); window.location='actors.php';</script>";
        exit;
    }

    $id = (int)$_GET['id'];


    $sql = "SELECT * FROM actor WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $actor = mysqli_fetch_assoc($result);

    if (!$actor) {
        echo "<div class='content'><div class='alert alert-warning'>Ator com ID $id não encontrado. <a href='actors.php'>Voltar</a></div></div>";
        exit;
    }
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Editar Ator: <?php echo htmlspecialchars($actor['name']); ?></h2>
            <a href="actors.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="../api/actor/update.php" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" value="<?php echo $actor['id']; ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome Completo *</label>
                            <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($actor['name']); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" name="birthdate" class="form-control" value="<?php echo $actor['birthdate']; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">País *</label>
                            <input type="text" name="country" class="form-control" required value="<?php echo htmlspecialchars($actor['country']); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Biografia</label>
                        <textarea name="biography" class="form-control" rows="5"><?php echo htmlspecialchars($actor['biography']); ?></textarea>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-2 text-center">
                            <label class="form-label d-block fw-bold">Foto Atual</label>
                            <?php 
                                if($actor['profile_image']) {
                                    $img = base64_encode($actor['profile_image']);
                                    echo "<img src='data:image/jpeg;base64,{$img}' class='img-thumbnail rounded-circle' style='width: 100px; height: 100px; object-fit: cover;'>";
                                } else {
                                    echo "<div class='bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto' style='width:100px; height:100px;'><i class='bi bi-person fs-1'></i></div>";
                                }
                            ?>
                        </div>
                        <div class="col-md-10">
                            <label class="form-label">Trocar Foto (Opcional)</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <div class="form-text">Deixe em branco para manter a foto atual.</div>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save"></i> Salvar Alterações</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>