<?php
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cadastrar Novo Gênero</h2>
            <a href="genres.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="col-md-6 mx-auto"> <div class="card shadow-sm">
                <div class="card-body">
                    <form action="../api/genres/create.php" method="POST">
                        
                        <div class="mb-4">
                            <label class="form-label">Nome do Gênero *</label>
                            <input type="text" name="name" class="form-control" required placeholder="Ex: Ficção Científica">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Salvar</button>
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